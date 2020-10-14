<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment\Pagseguro\CreditCard;
use App\Payment\Pagseguro\Notification;
use App\Models\Store;
use Ramsey\Uuid\Uuid;

class CheckoutController extends Controller {

    public function __construct() {

        if (!auth()->check()) {
            return redirect()->route('login');
        }
    }

    public function index() {

        /*
         * Se a sessão do Pagseguro não expirar, cai no try
         * Caso contrário, cai no catch, faz um forget no 'pagseguroSessionCode' e redireciona para o 'checkout.index' 
         * que fará a nova criação do 'pagseguroSessionCode' através do '$this->makePagseguroSession()'
         */
        try {

            if (session()->exists('cart')) {

                /*
                 * Chamando a função que joga na sessão atual o token de sessão gerado junto ao Pagseguro
                 */
                $this->makePagseguroSession();

                $cartItens = array_map(function($line) {
                    return $line['amount'] * $line['price'];
                }, session()->get('cart'));

                $cartSumItens = array_sum($cartItens);

                return view('checkout', compact('cartSumItens'));
            } else {

                return redirect()->route('cart.index');
            }
        } catch (Exception $exc) {

            session()->forget('pagseguroSessionCode');

            return redirect()->route('checkout.index');
        }
    }

    public function process(Request $request) {


        try {

            $dataPost = $request->all();

            $user = auth()->user();

            $cartItens = session()->get('cart');

            $stores = array_unique(array_column($cartItens, 'store_id')); //Recuperando o id das lojas sem suplicidade

            /*
             * Não esquecer de rodar o comando 'composer require ramsey/uuid'
             */
            $reference = Uuid::uuid4();

            $creditCardPayment = new CreditCard($cartItens, $user, $dataPost, $reference);

            $result = $creditCardPayment->doPayment();


            /**
             * @todo Mudar o valor estático do 'store_id'
             * Início do armazenamento das informações da transação no banco de dados
             */
            $userOrder = array(
                'reference' => $reference,
                'pagseguro_code' => $result->getCode(),
                'pagseguro_status' => $result->getStatus(),
                'items' => serialize($cartItens),
            );


            /*
             * Criando (salvando) o pedido na tabela 'user_orders'
             */
            $userOrder = $user->orders()->create($userOrder);


            /*
             * Criando (salvando) o pedido e a loja na tabela 'order_store'
             */
            $userOrder->stores()->sync($stores);


            /*
             * Notificando a loja (dono dela) que há um novo pedido através do método notificador 'notifyStoreOwners'
             */
            $store = (new Store())->notifyStoreOwners($stores);


            /*
             * Removendo da sessão o 'cart' e 'pagseguroSessionCode'
             */
            session()->forget('cart');
            session()->forget('pagseguroSessionCode');


            /*
             * Retornando um json
             */
            return response()->json([
                        'data' => [
                            'status' => true,
                            'message' => 'Pedido realizado com sucesso!',
                            'order' => $reference
                        ]
            ]);
        } catch (Exception $exc) {
            /*
             * Retornando um json
             */

            $message = env('APP_DEBUG') ? simplexml_load_string($exc->getMessage()) : 'Erro ao processar pedido';

            return response()->json([
                        'data' => [
                            'status' => false,
                            'message' => $message,
                        ]
                            ], 401); //Indica que houve um erro no backend
        }
    }

    public function success() {

        return view('success');
    }

    /*
     * Não esquecer de criar uma exceção dessa URL em 'Http\Middleware\VerifyCsrfToken.php'
     */

    public function notification() {

        try {


            $notification = new Notification();

            $notification = $notification->getTransaction();

            /*
             * Decodificando o código do pedido que foi salvo com o base64_encode na classe 'CreditCard'
             */
            $reference = base64_decode($notification->getReference());

            $userOrder = \App\Models\UserOrder::whereReference($reference);

            $userOrder->update([
                'pagseguro_status' => $notification->getStatus()
            ]);

            /*
             * Retorna para o Pagseguro o um array vazio com o status code 204
             * que representa uma resposta, mas sem conteúdo
             */
            return response()->json([], 204);
        } catch (Exception $ex) {

            $message = env('APP_DEBUG') ? $ex->getMessage() : '';

            return response()->json(['error' => $message], 500); //Erro no servidor (nosso lado)
        }
    }

    private function makePagseguroSession() {


        /*
         * Se não exitir na sessão a chave pagseguroSessionCode contendo o token da sessão do pagseguro,
         * geramos um novo token e fazemos a inserção na sessão
         */
        if (!session()->has('pagseguroSessionCode')) {
            $sessionCode = \PagSeguro\Services\Session::create(
                            \PagSeguro\Configuration\Configure::getAccountCredentials()
            );

            return session()->put('pagseguroSessionCode', $sessionCode->getResult());
        }
    }

}
