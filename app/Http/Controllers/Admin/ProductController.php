<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use Illuminate\Validation\Rule;
use App\Traits\UploadTrait;

class ProductController extends Controller {

    /**
     * Para fazer o upload de imagens
     */
    use UploadTrait;


    /*
     * Variável que receberá um novo objeto do Model Product
     * Dessa forma não precisamos chamar 'use App\Models\Product' dentro de cada método 
     */

    private $product;

    /*
     * Instanciando um novo objeto da classe Model Product no construtor
     */

    public function __construct(Product $product) {

        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
       
        $user = auth()->user();
        
        /**
         * Se não existir uma loja para o user logado e ele clicar no menu 'Produtos' da navbar,
         * redirecionamos ele para a index de Stores
         */
        if (!$user->store()->exists()) {

            flash('Você precisa criar uma Loja para depois criar Produtos')->warning();
            return redirect()->route('admin.stores.index');
        }
        
        

        $products = $user->store->products()->paginate(5);


        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        $categories = \App\Models\Category::all(['id', 'name']);

        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request) {


        /*
         * Aplicando a validação para o input categories que é do tipo multiple
         */
        if (!$request->input('categories')) {

            $request->validate([
                'categories' => 'required',
            ]);
        }


        /*
         * Aplicando a validação para o input 'photos' que é do tipo multiple
         */
        if (!$request->file('photos')) {

            $request->validate([
                'photos' => 'required',
            ]);
        }


        $data = $request->all();
        
        $data['price'] = str_replace(',', '', $data['price']);
        
       

        /*
         * Recuperando a loja ($store) do Usuário a partir do objeto store definido no método store no Model User
         */
        $store = auth()->user()->store;

        /*
         * Recuperamos o produto ($product) criado para loja ($store) acima
         */
        $product = $store->products()->create($data);


        /*
         * Salvando na tabela 'category_product' a ligação do produto ($product) criado com as categorias vindas no POST $data()
         */
        $product->categories()->sync($data['categories']);



        /*
         * Salvando as rererências das imagens na tabela 'product_photos'
         */
        if ($request->hasFile('photos')) {

            $images = $this->imageUpload($request->file('photos'), 'image');

            $product->photos()->createMany($images);
        }


        flash('Produto criado com sucesso')->success();
        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($product) {

        $product = $this->product->findOrFail($product);


//        dd($product->photos);


        $categories = \App\Models\Category::all(['id', 'name']);


        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $product) {

        /*
         * Aplicando a validação para o input categories que é do tipo multiple
         */
        if (!$request->input('categories')) {

            $request->validate([
                'categories' => 'required',
            ]);
        }

        $data = $request->all();
        
        
        $data['price'] = str_replace(',', '', $data['price']);
        

        $product = $this->product->find($product);

        $product->update($data);


        /*
         * Salvando na tabela 'category_product' a ligação do produto ($product) criado com as categorias vindas no POST $data()
         */
        $product->categories()->sync($data['categories']);


        /*
         * Salvando as rererências das imagens na tabela 'product_photos'
         */
        if ($request->hasFile('photos')) {

            $images = $this->imageUpload($request->file('photos'), 'image');

            $product->photos()->createMany($images);
        }



        flash('Produto atualizado com sucesso!')->success();
        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($product) {

        $product = $this->product->findOrFail($product);

        $product->delete($product);

        flash('Produdo excluído com sucesso')->success();
        return redirect()->route('admin.products.index');
    }

}
