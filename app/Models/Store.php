<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Notifications\StoreReceiveNewOrder;

use App\Traits\Slug;

/**
 * Esse model Store pertence a um User
 */
class Store extends Model {

    use HasFactory;

    use Slug;

    /*
     * Definindo quais campos da tabela receberão os valores
     * 
     * Obs: as chaves estrangeiras são referenciadas pelos métodos user() e products()
     */

    protected $fillable = ['name', 'description', 'phone', 'mobile_phone', 'slug', 'logo'];

    /**
     * Método que retorna um objeto User, que é dono dessa Store
     * @return type
     */
    public function user() {

        return $this->belongsTo(User::class);
    }

    /**
     * Método que representa o mapeamento 1:N -> Um para Muitos (Loja e Produtos) | hasMany e belongsTo 
     * (Ou seja, a Loja tem muitos produtos. E um produto pertence a Loja)
     */
    public function products() {

        return $this->hasMany(Product::class);
    }

    /*
     * Uma loja pode estar em vários pedidos, através da ligação no Model 'UserOrder' no método stores()
     */

    public function orders() {

        /*
         * Indicando a tabela ('order_store'), pois sem isso o Laravel tentará encontrar a tabela 'store_user_order' que não existe
         * O 'store_id' e 'order_id' são as colunas na tabela para que o laravel possa encontrar os pedidos da loja que é do usuário logado
         */
        return $this->belongsToMany(UserOrder::class, 'order_store', 'store_id', 'order_id');
    }

    /**
     * Notificando os donos das lojas
     * Lembrar que no pedido pode haver mais de uma loja
     * 
     * @param array $storesId com os IDs das lojas que o pedido contém
     * 
     */
    public function notifyStoreOwners(array $storesId = []) {

        /*
         * Recuperando as lojas de acordo com o array $storesId
         */
        $stores = $this->whereIn('id', $storesId)->get();

        /*
         * Para cada store_id, montaremos um array de objetos User que é o dono da loja.
         * E para cada objeto desse array (each abaixo) notificamos via 'StoreReceiveNewOrder'
         * 
         */
        return $stores->map(function ($store) {

                    return $store->user;
                    
                })->each->notify(new StoreReceiveNewOrder());
    }

}
