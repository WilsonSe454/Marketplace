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
    
    
    // Usando o Active Record
    

    //Inserindo dados
    /* 
    $user = new User;
    $user->name = 'Wilson';
    $user->email = 'wilson@teste.com.br';
    $user->password = bcrypt('123456789');
    $user->save();
    return $user->all(); 
    */


    //atualizando dados
    $user = User::find(1);//select * from usuario where id = ?
    $user->name = 'Wilson Editado';
    $user->email = 'wilson@teste.com.br';
    $user->password = bcrypt('123456789');
    $user->save();
    return $user->all();
    


});
