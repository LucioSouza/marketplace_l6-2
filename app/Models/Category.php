<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\Slug;

class Category extends Model {

    use HasFactory;

    use Slug;


    /*
     * Definindo quais campos da tabela receberão os valores
     * 
     * Obs: as chaves estrangeiras são referenciadas pelo método products()
     */

    protected $fillable = ['name', 'description', 'slug'];


    /*
     * N:N -> Muitos para Muitos (Produtos e categorias) | belongsToMany
     */

    public function products() {

        return $this->belongsToMany(Product::class);
    }

}
