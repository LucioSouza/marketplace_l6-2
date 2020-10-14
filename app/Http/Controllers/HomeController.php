<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Store;

class HomeController extends Controller {
    /*
     * Variável que receberá um novo objeto do Model Product
     * Dessa forma não precisamos chamar 'use App\Models\Product' dentro de cada método 
     */

    private $product;

    /*
     * Variável que receberá um novo objeto do Model Stores
     */
    private $store;

    public function __construct(Product $product, Store $store) {

        $this->product = $product;

        $this->store = $store;
    }

    public function index() {

        $products = $this->product->limit(8)->orderBy('id', 'DESC')->get();

        $stores = $this->store->limit(4)->get();
        
        $categories = \App\Models\Category::all(['name', 'slug']);
        
        
        return view('welcome', compact('products', 'stores', 'categories'));
    }

    public function single($slug) {

        $product = $this->product->whereSlug($slug)->first();

        return view('single', compact('product'));
    }

}
