<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductPhotoController extends Controller {

    public function removePhoto(Request $request) {


        $photoName = $request->input('photoName');


        /**
         * Primeiro removemos a imagem do file_system
         */
//        if (Storage::disk('public')->exists($photoName)) {
//            Storage::disk('public')->delete($photoName);
//        }


        /**
         * Removo a imagem do banco de dados
         */
        $removePhoto = \App\Models\ProductPhoto::where('image', $photoName);

        /**
         * Recuperando o ID do produto para usar no redirect
         */
        $productId = $removePhoto->first()->product_id;


        $removePhoto->delete();

        flash('Imagem removida com sucesso!')->success();
        return redirect()->route('admin.products.edit', ['product' => $productId]);
    }

}
