<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller {

    public function index() {

        $cart = session()->has('cart') ? session()->get('cart') : [];

        return view('cart', compact('cart'));
    }

    public function add(Request $request) {

        /**
         * Pego a chave product[] que veio no post vindo da view 'single' e monto um objeto
         */
        $productPost = $request->get('product');


        if ($productPost['amount'] <= 0) {

            flash('Informe a quantidade maior que zero')->warning();
            return redirect()->route('product.single', ['slug' => $productPost['slug']]);
        }


        /*
         * A partir daqui, implementamos um controle para o caso de um usuário mnodificar os campos ocultos do form
         */

        /*
         * Recuperamos o produto a partir do slug do mesmo que vem como oculto no form
         * 
         */
        $product = \App\Models\Product::whereSlug($productPost['slug']);


        /*
         * Esse trecho verifica a existência do produto em questão
         * Se for alterado o slug oculto no form, não será encontrado o produto
         * Dessa forma, matamos a sessão e redirecionamos para Home
         */
        if (!$product->count()) {

            session()->forget('cart');

            return redirect()->route('home');
        }


        /*
         * Transformo o objeto $product em array para possibilitar o array_merge
         * 
         * Também coloco o 'store_id' para utilizar quando for salvar o pedido no controller CheckoutController
         */
        $product = $product->first(['id', 'name', 'price', 'store_id'])->toArray();


        /*
         * Com o array_merge eu sobrescrevo o array $productPost com o array $product,
         * Ou seja, os valores que possivelmente vieram alterados no POST serão corrigidos com os valores vindos do banco
         * Dessa forma garantimos que só será inserido no carrinho o array que esperamos que venha do front
         */
        $product = array_merge($productPost, $product);


        /*
         * Se caiu aqui é porque não houve tentativa de violação do sistema e podemos adicionar tranquilamente no carrinho
         */




        if (session()->has('cart')) {


            /*
             * Recuperando os itens do carrinho
             */
            $products = session()->get('cart');


            /*
             * Array que recebe dos os slugs do carrinho
             */
            $productsSlugs = array_column($products, 'slug');



            /*
             * Se existir no 'cart' o produto, incrementamos a quantidade desse produto
             */
            if (in_array($product['slug'], $productsSlugs)) {

                $products = $this->productIncrement($product['slug'], $product['amount'], $products);

                /*
                 * Sobrescrevemos a chave 'cart' com array $products que foi alterado (incrementado)
                 */
                session()->put('cart', $products);
            } else {


                /**
                 * Caso contrário, adicionamos no 'cart' o $product
                 */
                session()->push('cart', $product);
            }
        } else {

            /*
             * Não existe na sessão uma chave 'cart', então crio essa chave e adiciono o primeiro produto 
             */

            /*
             * Criamos um array $products[] vazio que receberá os produtos
             */
            $products[] = $product;

            session()->put('cart', $products);
        }

        flash('Produto adicionado no carrinho')->success();

        /*
         * Depois de adicionado, passamos como parâmetro da rota, 
         * o slug contido na chave $product['slug'] que veio no POST
         */
        return redirect()->route('product.single', ['slug' => $product['slug']]);
    }

    public function remove($slug) {

        /*
         * Se não tiver na sessão uma chave 'cart', redirecionamos para o carrinho, 
         * que nesse caso exibirá o carrinho vazio
         */
        if (!session()->has('cart')) {
            return redirect()->route('cart.index');
        }

        /*
         * Recuperando os produtos da sessão da chave 'cart'
         */
        $products = session()->get('cart');


        /*
         * O array_filter recebe o array $products e cria uma função anônima.
         * Nessa função anônima é criada uma variável $line que será utilizada para comparar com a variável $slug
         * Depois disso, o array $products receberá apenas os produtos cujos slug sejá != do $slug vindo como parâmetro
         * Ou seja, o que for igual será removido do array
         */
        $products = array_filter($products, function ($line) use($slug) {

            return $line['slug'] != $slug;
        });



        /*
         * Atualizamos a key 'cart' da sessão com o array $products sem o item que foi removido
         */
        session()->put('cart', $products);

        return redirect()->route('cart.index');
    }

    public function cancel() {

        /*
         * Remove da sessão a chave 'cart',
         * Ou seja, limpa o carrinho
         */
        session()->forget('cart');

        return redirect()->route('cart.index');
    }

    private function productIncrement($slug, $amount, $products) {


        $products = array_map(function($line) use($slug, $amount) {

            if ($line['slug'] == $slug) {

                $line['amount'] += $amount;
            }

            return $line;
        }, $products);

        return $products;
    }

}
