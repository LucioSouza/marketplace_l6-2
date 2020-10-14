<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;
use App\Traits\UploadTrait;
use \Illuminate\Support\Facades\Storage;

class StoreController extends Controller {

    use UploadTrait;

    public function __construct() {

        $this->middleware('user.has.store')->only(['create', 'store']);
    }

    public function index() {


        /*
         * Recuperando apenas um objeto Store que representa a loja do user logado.
         * Cada usuário só pode ter uma loja
         */
        $store = auth()->user()->store;
       

        return view('admin.stores.index', compact('store'));
    }

    public function create() {

        return view('admin.stores.create');
    }

    public function store(StoreRequest $requisicao) {

        $data = $requisicao->all();

        /*
         * Recuperando o usuário logado para ser atribuído à criação da loja
         */
        $user = auth()->user();


        if ($requisicao->hasFile('logo')) {

            $data['logo'] = $this->imageUpload($requisicao->file('logo'));
        }


        $store = $user->store()->create($data);

        flash('Loja criada com sucesso')->success();

        return redirect()->route('admin.stores.index');
    }

    public function edit($store) {


        $store = \App\Models\Store::find($store);

        return view('admin.stores.edit', compact('store'));
    }

    public function update(StoreRequest $requisicao, $store) {


        $data = $requisicao->all();

        $store = \App\Models\Store::find($store);


        /*
         * Se veio nova imagem no input, apagamos a antiga do file_system e atualizamos com a nova logo
         */
        if ($requisicao->hasFile('logo')) {

            if (Storage::disk('public')->exists($store->logo)) {
                Storage::disk('public')->delete($store->logo);
            }

            $data['logo'] = $this->imageUpload($requisicao->file('logo'));
        }

        $store->update($data);

        flash('Loja atualiza com sucesso')->success();
        return redirect()->route('admin.stores.index');
    }

    public function destroy($store) {


        $store = \App\Models\Store::find($store);

        $store->delete();

        flash('Loja excluída com sucesso')->success();

        return redirect()->route('admin.stores.index');
    }

}
