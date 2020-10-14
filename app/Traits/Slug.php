<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Traits;

use Illuminate\Support\Str; // The Str::slug method generates a URL friendly "slug" from the given string

/**
 *
 * @author ULASOU5
 */
trait Slug {
    /*
     * Criando o Slug a partir do Helper Str:: do Laravel
     * 
     * Ou seja, estamos definindo um 'Mutator'
     * 
     * Mais em: https://laravel.com/docs/8.x/eloquent-mutators#defining-a-mutator
     */

    public function setNameAttribute($value) {


        $slug = Str::slug($value);

        $matchs = $this->uniqueSlug($slug);

        /*
         * Aqui o Laravel entende que o atributo name receberá o que veio no POST no input name 'name'
         */
        $this->attributes['name'] = $value;

        /* E aqui o slug é criado a partir do value do input 'name'
         * 
         * O '$this' contém todos os atributos do Model na chave 'attributes'
         */
        $this->attributes['slug'] = $matchs ? $slug . '-' . $matchs : $slug; //Se der match, será adicionado ao final do slug o total de match
    }

    public function uniqueSlug($slug) {

        $matchs = $this->whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")->count();

        return $matchs;
    }

}
