<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function products()
    {
        return $this->belongsToMany(Product::class); //O laravel vai procura o nome da tabela pivo em ordem alfabetica ex: category_product
        // return $this->belongsToMany(Product::class, 'product_category'); // Caso não estiver em ordem alfabetica, usar o segundo parametro.
    }
}
