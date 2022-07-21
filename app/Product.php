<?php

namespace App;

use Illuminate\Database\Eloquent\Model;//O Eloquent é um ORM (Object–relational mapping "Mapeamento objeto-relacional") 

class Product extends Model
{
    //
}

/* 
O laravel vai sempre procurar o nome do model no plural no db, por exemplo, model: Product; banco de dados: products.

Caso da tabela esteja com o nome diferente o ideal é usar a propriedate protected $table = "nome da tabela" para modificar a propriedade $table do model
*/