<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserOrderController extends Controller {

    public function index() {


        /*
         * Recuperando os pedidos do usuário através da ligação orders() definida no model User
         */
        $userOrders = auth()->user()->orders;

        return view('users-orders', compact('userOrders'));
    }

}
