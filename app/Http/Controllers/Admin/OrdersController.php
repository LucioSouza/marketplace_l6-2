<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserOrder;

class OrdersController extends Controller {

    private $order;

    public function __construct(UserOrder $order) {

        $this->order = $order;
    }

    public function index() {

        /*
         * Recuperando os pedidos da loja do usuario logado
         */
        $orders = auth()->user()->store->orders;
        
        return view('admin.orders.index', compact('orders'));
    }

}
