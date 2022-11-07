<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Os atributos que podem ser atribuídos em massa.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * Os atributos que devem ser ocultados para arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Os atributos que devem ser convertidos em tipos nativos.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // 1:1 - Um pra um (Usuario e Loja) | hasOne e belongsTo
    // 1:N - Um pra Muitos (Loja e Produtos) | hasMany e belongsTo 
    // N:N - Muitos pra Muitos (Produtos e Categorias) | belongsToMany

    // hasOne: Tem um
    // hasMany: Tem muitos
    // belongsTo: Pretence para
    // belongsToMany: Muitos para Muitos

    public function store()
    {
        return $this->hasOne(Store::class); // Este model user tem um model store ou user tem uma store
        // return $this->hasOne(Store::class, 'usuario_id'); // Se o nome do campo não estiver nome do model_id
    }

    public function orders()
    {
        return $this->hasMany(UserOrder::class); // User tem muitas orders
    }

}
