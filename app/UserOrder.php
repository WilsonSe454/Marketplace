<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserOrder extends Model
{
    protected $fillable = [
        'reference', 
        'pagseguro_code', 
        'pagseguro_status', 
        'items', 
        'store_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class); // UserOrders pertence a user
    }

    public function store()
    {
        return $this->belongsTo(Store::class); // UserOrders pertence a store
    }

    public function stores()
    {
        return $this->belongsToMany(Store::class);
    }
}
