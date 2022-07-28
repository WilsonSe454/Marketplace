<?php

use App\User;
use Illuminate\Database\Seeder;
use App\Store;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* \DB::table('users')->insert(
            [
                'name' => 'Administrador',
                'email' => 'adm@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ]
            ); */
            factory(User::class, 40)->create()->each(function($user){ // O método each vai fazer alguma coisa a cada execução. Ou seja, para cada usuário ele cria uma loja 
                // $user->store()->create(factory(Store::class)->make()); // O método create trabalha um arrays, por outro lado o método save, trabalha com objetos.
                $user->store()->save(factory(Store::class)->make()); // O método make vai criar um objeto Store com as informações fakes
            });
    }
}
