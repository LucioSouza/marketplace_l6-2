<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOrder extends Model {

    use HasFactory;

    protected $fillable = ['reference', 'pagseguro_code', 'pagseguro_status', 'store_id', 'items'];

    /*
     * Para saber a qual usuário o pedido pertence
     */

    public function user() {

        return $this->belongsTo(User::class);
    }

    /*
     * Para saber de qual loja o produto do pedido foi comprado
     */

    public function store() {

        return $this->belongsTo(Store::class);
    }

    
    /*
     * Retorna todas as lojas do pedido específico,
     * pois em um mesmo pedido, pode conter produtos de lojas distintas
     */
    public function stores() {

        /*
         * Indicando a tabela ('order_store'), pois sem isso o Laravel tentará encontrar a tabela 'store_user_order' que não existe
         * O 'order_id' é a coluna na tabela para que o laravel possa encontrá-la
         */
        return $this->belongsToMany(Store::class, 'order_store', 'order_id'); 
        
    }

}
