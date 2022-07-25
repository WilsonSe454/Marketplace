<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Product;
use App\User;

Route::get('/', function () {
    $helloWorld = 'Hello World';

    // return view('welcome', ['helloWorld' => $helloWorld]);// eturn view('nome da view', ['chave' => $variável]);

    // vc pode passar várias chaves 
    return view('welcome', [
        'helloWorld' => $helloWorld,
        'teste' => 'testando'
    ]); 

    /* // O compact cria um array associativo com a chave passada como argumento.
    return view('welcome', compact('helloWorld')); */
    // return view('welcome');
});

Route::get('/model', function () {
    /* $products = Product::all(); //select * from products
    return $products; */
    
    
    // ************************ Usando o Active Record ************************
    
    // Inserindo dados
    /* 
    $user = new User;
    $user->name = 'Wilson';
    $user->email = 'wilson@teste.com.br';
    $user->password = bcrypt('123456789');
    $user->save();
    return $user->all(); 
    */


    //atualizando dados
    // $user = User::find(1);//select * from usuario where id = ?
    // $user->name = 'Wilson Editado';
    // $user->email = 'wilson@teste.com.br';
    // $user->password = bcrypt('123456789');
    // $user->save();

    // return $user->all(); //O laravel serializa os dados, ou sejá ele pega a estrutura do objeto e converte para JSON Retornado uma Collection.
    
    // return $user->where('name', 'Lillie Miller')->get(); // select * from users where name = 'Lillie Miller' 
    
    // return $user->where('name', 'Lillie Miller')->first(); // O first pega o primeiro que encontrar, não retorna uma Collection
    
    // return $user->paginate(10); // Retorna o resultado paginado 

    
    // ************************ Mass Assingnment(Atribuição em massa) ************************

    /* 
    $user = User::create([
        'name' => 'Jose Wilson',
        'email' => 'josewilson@teste.com',
        'password' => bcrypt('123456789')

    ]);
    dd($user); 
    */

    // ************************ Mass Update ************************

    $user = User::find(1);
    /* 
        $user = $user->update([
            'name' => 'Atualizando com Mass Update',
            'email' => 'atualizado@teste.com'
        ]);
        dd($user); // O retorno vai ser um booleano pq o $user está recebendo o $user->update([]);. True se ele atualizar ou False para a falha.
    */
    $user->update([
        'name' => 'Atualizando com Mass Update',
        'email' => 'atualizado@teste.com'
    ]);
    dd($user);
});
