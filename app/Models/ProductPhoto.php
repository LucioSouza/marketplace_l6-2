<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPhoto extends Model {

    use HasFactory;
    
    protected $fillable = ['image'];

    /*
     * Uma imagem pertence a um produto
     */
    public function product() {

        return $this->belongsTo(Product::class);
    }

}
