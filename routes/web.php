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

Route::get('/', function () {
    $helloWorld = 'Hello World';

    // return view('welcome', ['helloWorld' => $helloWorld]);
    /* return view('welcome', [
        'helloWorld' => $helloWorld,
        'teste' => 'testando'
    ]); */ // vc pode passar várias chaves 
    // return view('welcome', compact('helloWorld'));// O compact cria um array associativo com a chave passada como argumento.
    // return view('welcome');
});
