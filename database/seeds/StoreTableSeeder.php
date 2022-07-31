<?php

use App\Product;
use App\Store;
use Illuminate\Database\Seeder;

class StoreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* factory(Store::class, 40)->create()->each(function ($store) { // O método each vai fazer alguma coisa a cada execução. Ou seja, para cada usuário ele cria uma loja 
            // $user->store()->create(factory(Store::class)->make()); // O método create trabalha um arrays, por outro lado o método save, trabalha com objetos.
            $store->products()->save(factory(Product::class)->make()); // O método make vai criar um objeto Store com as informações fakes
        }); */
        $stores = Store::all();

        foreach($stores as $store)
        {
            $store->products()->save(factory(Product::class)->make());
        }
         
    }
}
