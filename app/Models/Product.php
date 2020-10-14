<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\Slug;

class Product extends Model {

    use HasFactory;
    
    use Slug;

    /*
     * Definindo quais campos da tabela receberão os valores
     * 
     * Obs: as chaves estrangeiras são referenciadas pelos métodos store() e categories()
     */

    protected $fillable = ['name', 'description', 'body', 'price', 'slug'];


    /* Definindo um 'Accessor'
     * 
     * Quando eu chamar o $product->thumb, tanto em single.blade, como em edit.blade, estarei chamando o método abaixo
     * Pois o Laravel coloca o 'get' e o 'Attribute' no método, criando assim, uma colona que não existe no model, 
     * mas que retorna um dado existente
     * Mais em: https://laravel.com/docs/8.x/eloquent-mutators#defining-an-accessor
     */

    public function getThumbAttribute() {

        return $this->photos->first()->image;
    }

    /**
     * Método que retorna a representação de que um Product pertence a uma Store
     * @param type $param
     */
    public function store() {

        return $this->belongsTo(Store::class);
    }

    /*
     * N:N -> Muitos para Muitos (Produtos e categorias) | belongsToMany
     */

    public function categories() {

        return $this->belongsToMany(Category::class);
    }

    /*
     * 1:N -> Um produto tem muitas imagens
     */

    public function photos() {

        return $this->hasMany(ProductPhoto::class);
    }

}
