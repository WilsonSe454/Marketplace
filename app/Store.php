<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;//O Eloquent é um ORM (Object–relational mapping "Mapeamento objeto-relacional")
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Store extends Model
{
    use HasSlug;
    use Notifiable;

    /**
     * Os atributos que podem ser atribuídos em massa.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'phone',
        'mobile_phone',
        'slug',
        'logo',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
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
O laravel vai sempre procurar o nome do model no plural no db, por exemplo, model: Store; banco de dados: stores.

Caso da tabela esteja com o nome diferente o ideal é usar a propriedate protected $table = "nome da tabela" para modificar a propriedade $table do model
*/

    // 1:1 - Um pra um (Usuario e Loja) | hasOne e belongsTo
    // 1:N - Um pra Muitos (Loja e Produtos) | hasMany e belongsTo 
    // N:N - Muitos pra Muitos (Produtos e Categorias) | belongsToMany

    // hasOne: Tem um
    // hasMany: Tem muitos
    // belongsTo: Pretence para
    // belongsToMany: Muitos para Muitos


    public function user()
    {
        return $this->belongsTo(User::class); // Este model store pertence á o model user ou store pertence a user
        //return $this->belongsTo(User::class, 'usuario_id'); // Se o nome do campo não estiver nome do model_id
    }

    public function  products()
    {
        return $this->hasMany(Product::class); // Store tem muitos Products
    }

    public function orders()
    {
        // return $this->belongsToMany(UserOrder::class, 'order_store', 'store_id', 'order_id'); // O laravel vai pegar o nome da table e concatenar o id. Por isso você pode passar o valor como null
        return $this->belongsToMany(UserOrder::class, 'order_store', null, 'order_id'); 
    }
}

    