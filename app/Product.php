<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;//O Eloquent é um ORM (Object–relational mapping "Mapeamento objeto-relacional") 

class Product extends Model
{
    use Notifiable;

    /**
     * Os atributos que podem ser atribuídos em massa.
     *
     * @var array
     */
    protected $fillable = [
        
    ];

    /**
     * Os atributos que devem ser ocultados para arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    /**
     * Os atributos que devem ser convertidos em tipos nativos.
     *
     * @var array
     */
    protected $casts = [
        
    ];


    /* 
O laravel vai sempre procurar o nome do model no plural no db, por exemplo, model: Product; banco de dados: products.

Caso da tabela esteja com o nome diferente o ideal é usar a propriedate protected $table = "nome da tabela" para modificar a propriedade $table do model
*/

    // 1:1 - Um pra um (Usuario e Loja) | hasOne e belongsTo
    // 1:N - Um pra Muitos (Loja e Produtos) | hasMany e belongsTo 
    // N:N - Muitos pra Muitos (Produtos e Categorias) | belongsToMany

    // hasOne: Tem um
    // hasMany: Tem muitos
    // belongsTo: Pretence para
    // belongsToMany: Muitos para Muitos


    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function category()
    {
        return $this->belongsToMany(Category::class);
    }
}

