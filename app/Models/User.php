<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {

    use HasFactory,
        Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Mapeamento: 1:1 -> Um para um (Usuário e Loja) | hasOne e belongsTo
     * 
     * Não é priciso importar o model Store, pois eles estão no mesmo namespace
     * 
     * @return objeto do model Store a qual o usuário está ligado
     */
    public function store() {

        return $this->hasOne(Store::class);
    }

    /*
     * Um usuário pode ter muitos pedidos
     */

    public function orders() {

        return $this->hasMany(UserOrder::class);
    }

    /*
     * Método que retorna o número que será enviado o SMS pelo Nexmo
     */

    public function routeNotificationForNexmo($notification) {

        /*
         * Antes: (41) 99628 - 6883
         */
        $storeMobilePhone = trim(str_replace(['(', ')', ' ', '-'], '', $this->store->mobile_phone));

        /*
         * Depois: 996286883
         */

        return '55' . $storeMobilePhone;
    }

}

/*  
 *  Para cada uma das relações abaixo, precisaremos de uma tabela intermediária
 *  E para isso utilizaremos o Eloquent
 * 
 *  1:1 -> Um para um (Usuário e Loja) | hasOne e belongsTo
 *  1:N -> Um para Muitos (Loja e Produtos) | hasMany e belongsTo (Ou seja, a Loja tem muitos produtos. E um produto pertence a Loja)
 *  N:N -> Muitos para Muitos (Produtos e categorias) | belongsToMany
 */