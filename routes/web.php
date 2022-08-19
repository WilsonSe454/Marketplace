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
use App\Store;
use App\User;
use App\Category;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\ProductController;

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
})->name('home');;

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

    // $user = User::find(1);
    /* 
        $user = $user->update([
            'name' => 'Atualizando com Mass Update',
            'email' => 'atualizado@teste.com'
        ]);
        dd($user); // O retorno vai ser um booleano pq o $user está recebendo o $user->update([]);. True se ele atualizar ou False para a falha.
    */
    /* $user->update([
        'name' => 'Atualizando com Mass Update',
        'email' => 'atualizado@teste.com'
    ]);
    dd($user); */

    // $user = user::find(5);
    // dd($user->store());//Chamando como método é retornado uma instancia de HasOne e não os dados em si.
    // dd($user->store()->count());// Para savar é nescessário chamar como método.
    // $store = $user->store; //O objeto único (Store) se for Collection de Dados(Objetos)
    // return $store->products; // Pega todos os produtos desta loja
    // dd($store->products()); // Retorna um objeto do tipo HasMany
    // return $store->products()->where('id', 195)->get(); // Retorna o produto onde o id é 195. Paga usar o where, você procisa chamar products como método.


// ******************************************************************************************************************
    // Criar uma loja para um usuário
        /* 
        $user = User::find(10);
        $store =$user->store()->create([
            'name' => 'Loja teste',
            'description' => 'Loja teste de produtos de informatica',
            'mobile_phone' => 'XX-XXXXX-XXXX',
            'phone' => 'XX-XXXXX-XXXX',
            'slug' => 'loja-teste'
        ]);

        dd($store); 
        */

// ******************************************************************************************************************
    // Criar uma produto para um loja
        /* 
        $store = Store::find(41);
        $product = $store->products()->create([
            'name' => 'Notebook Dell',
            'description' => 'CORE I5',
            'body' => 'Qualquer coisa',
            'price' => '2999.95',
            'slug' => 'notebook-dell',
        ]);

        dd($product); 
        */

// ******************************************************************************************************************
    // Criar uma categoria
        /* 
        Category::create([
            'name' => 'Games',
            'description' => null,
            'slug' => 'games',
        ]);
        Category::create([
            'name' => 'Notebooks',
            'description' => null,
            'slug' => 'notebooks',
        ]);

        return Category::all();
         */

// ******************************************************************************************************************         
    // Adicionar um produto para uma categoria ou vice-versa
        $product = Product::find(821);
        // dd($product->categories()->attach([2])); // Adiciona o id 
        // dd($product->categories()->detach([2])); // Remove o id
        dd($product->categories()->sync([2])); // O sync adiciona e remove a categoria Ex: sync([1,3]); ele vai adicionar a 1 e a 3, mas vai remover a 2


});

/* 

Route::get        Recuperar  | Suportado pelo form html
Route::post       Criar  | Suportado pelo form html
Route::put        Atualizar  | Não suportado pelo form html  
Route::patch      Atualizar  | Não suportado pelo form html
Route::delete     Remoção  | Não suportado pelo form html
Route::options    Dentro do http retorna quais cabeçalhos aquela rota especifica responde 

Controllers como Recurso (Resource) pega cada verbo http e usa como eles devem ser usado!
GET - /products | index
GET - /products/10 | show
GET - /products/10/edit | edit
GET - /products/create | create
POST - /products | store
PUT ou PATCH - /products/10 | update
DELETE - /product/10 | destroy

Route::resource('products', 'ProductController');

Conceitos também usados para criação de APIs | REST
*/




// Route::prefix('admin')->namespace('Admin')->group(function(){ Quando se faz a importação dos controllers torna-se opcional o uso do namespace, a não ser que use Controllers como Recurso, neste caso o namespace é necessário. 
/* Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function(){ // inclui o namespace já que estou usando Controllers como Recurso

    // Route::prefix('stores')->name('stores.')->group(function(){

    //     Route::get('/', [StoreController::class, 'index'])->name('index');
    //     Route::get('/create', 'StoreController@create')->name('create');
    //     Route::post('/store', [StoreController::class, 'store'])->name('store');
    //     Route::get('/{store}/edit', 'StoreController@edit')->name('edit');
    //     Route::post('/update/{store}', [StoreController::class, 'update'])->name('update');
    //     Route::get('/destroy/{store}', 'StoreController@destroy')->name('destroy'); // Você pode usar das duas formas

    // });

    Route::resource('stores', 'StoreController');
    Route::resource('products', 'ProductController');

    
}); */

/* 
php artisan route:list

+--------+-----------+-------------------------------+------------------------+------------------------------------------------------+--------------+
| Domain | Method    | URI                           | Name                   | Action                                               | Middleware   |
+--------+-----------+-------------------------------+------------------------+------------------------------------------------------+--------------+
|        | GET|HEAD  | /                             |                        | Closure                                              | web          |
|        | GET|HEAD  | admin/products                | admin.products.index   | App\Http\Controllers\Admin\ProductController@index   | web          |
|        | POST      | admin/products                | admin.products.store   | App\Http\Controllers\Admin\ProductController@store   | web          |
|        | GET|HEAD  | admin/products/create         | admin.products.create  | App\Http\Controllers\Admin\ProductController@create  | web          |
|        | GET|HEAD  | admin/products/{product}      | admin.products.show    | App\Http\Controllers\Admin\ProductController@show    | web          |
|        | PUT|PATCH | admin/products/{product}      | admin.products.update  | App\Http\Controllers\Admin\ProductController@update  | web          |
|        | DELETE    | admin/products/{product}      | admin.products.destroy | App\Http\Controllers\Admin\ProductController@destroy | web          |
|        | GET|HEAD  | admin/products/{product}/edit | admin.products.edit    | App\Http\Controllers\Admin\ProductController@edit    | web          |
|        | GET|HEAD  | admin/stores                  | admin.stores.index     | App\Http\Controllers\Admin\StoreController@index     | web          |
|        | GET|HEAD  | admin/stores/create           | admin.stores.create    | App\Http\Controllers\Admin\StoreController@create    | web          |
|        | GET|HEAD  | admin/stores/destroy/{store}  | admin.stores.destroy   | App\Http\Controllers\Admin\StoreController@destroy   | web          |
|        | POST      | admin/stores/store            | admin.stores.store     | App\Http\Controllers\Admin\StoreController@store     | web          |
|        | POST      | admin/stores/update/{store}   | admin.stores.update    | App\Http\Controllers\Admin\StoreController@update    | web          |
|        | GET|HEAD  | admin/stores/{store}/edit     | admin.stores.edit      | App\Http\Controllers\Admin\StoreController@edit      | web          |
|        | GET|HEAD  | api/user                      |                        | Closure                                              | api,auth:api |
|        | GET|HEAD  | model                         |                        | Closure                                              | web          |
+--------+-----------+-------------------------------+------------------------+------------------------------------------------------+--------------+

Route com Resource trabalha com todos os verbos http

*/
Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home')->middleware('auth'); // pode ser passado um middleware direto na rota
// Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function(){

    Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function () {

        Route::resource('stores', 'StoreController');
        Route::resource('products', 'ProductController');
        Route::resource('categories', 'CategoryController');

    });
});


/* 

php artisan route:list
+--------+-----------+----------------------------------+--------------------------+------------------------------------------------------------------------+-------------------------+
| Domain | Method    | URI                              | Name                     | Action                                                                 | Middleware              |
+--------+-----------+----------------------------------+--------------------------+------------------------------------------------------------------------+-------------------------+
|        | GET|HEAD  | /                                | home                     | Closure                                                                | web                     |
|        | GET|HEAD  | admin/categories                 | admin.categories.index   | App\Http\Controllers\Admin\CategoryController@index                    | web,auth                |
|        | POST      | admin/categories                 | admin.categories.store   | App\Http\Controllers\Admin\CategoryController@store                    | web,auth                |
|        | GET|HEAD  | admin/categories/create          | admin.categories.create  | App\Http\Controllers\Admin\CategoryController@create                   | web,auth                |
|        | GET|HEAD  | admin/categories/{category}      | admin.categories.show    | App\Http\Controllers\Admin\CategoryController@show                     | web,auth                |
|        | PUT|PATCH | admin/categories/{category}      | admin.categories.update  | App\Http\Controllers\Admin\CategoryController@update                   | web,auth                |
|        | DELETE    | admin/categories/{category}      | admin.categories.destroy | App\Http\Controllers\Admin\CategoryController@destroy                  | web,auth                |
|        | GET|HEAD  | admin/categories/{category}/edit | admin.categories.edit    | App\Http\Controllers\Admin\CategoryController@edit                     | web,auth                |
|        | GET|HEAD  | admin/products                   | admin.products.index     | App\Http\Controllers\Admin\ProductController@index                     | web,auth                |
|        | POST      | admin/products                   | admin.products.store     | App\Http\Controllers\Admin\ProductController@store                     | web,auth                |
|        | GET|HEAD  | admin/products/create            | admin.products.create    | App\Http\Controllers\Admin\ProductController@create                    | web,auth                |
|        | GET|HEAD  | admin/products/{product}         | admin.products.show      | App\Http\Controllers\Admin\ProductController@show                      | web,auth                |
|        | PUT|PATCH | admin/products/{product}         | admin.products.update    | App\Http\Controllers\Admin\ProductController@update                    | web,auth                |
|        | DELETE    | admin/products/{product}         | admin.products.destroy   | App\Http\Controllers\Admin\ProductController@destroy                   | web,auth                |
|        | GET|HEAD  | admin/products/{product}/edit    | admin.products.edit      | App\Http\Controllers\Admin\ProductController@edit                      | web,auth                |
|        | GET|HEAD  | admin/stores                     | admin.stores.index       | App\Http\Controllers\Admin\StoreController@index                       | web,auth                |
|        | POST      | admin/stores                     | admin.stores.store       | App\Http\Controllers\Admin\StoreController@store                       | web,auth,user.has.store |
|        | GET|HEAD  | admin/stores/create              | admin.stores.create      | App\Http\Controllers\Admin\StoreController@create                      | web,auth,user.has.store |
|        | GET|HEAD  | admin/stores/{store}             | admin.stores.show        | App\Http\Controllers\Admin\StoreController@show                        | web,auth                |
|        | PUT|PATCH | admin/stores/{store}             | admin.stores.update      | App\Http\Controllers\Admin\StoreController@update                      | web,auth                |
|        | DELETE    | admin/stores/{store}             | admin.stores.destroy     | App\Http\Controllers\Admin\StoreController@destroy                     | web,auth                |
|        | GET|HEAD  | admin/stores/{store}/edit        | admin.stores.edit        | App\Http\Controllers\Admin\StoreController@edit                        | web,auth                |
|        | GET|HEAD  | api/user                         |                          | Closure                                                                | api,auth:api            |
|        | GET|HEAD  | login                            | login                    | App\Http\Controllers\Auth\LoginController@showLoginForm                | web,guest               |
|        | POST      | login                            |                          | App\Http\Controllers\Auth\LoginController@login                        | web,guest               |
|        | POST      | logout                           | logout                   | App\Http\Controllers\Auth\LoginController@logout                       | web                     |
|        | GET|HEAD  | model                            |                          | Closure                                                                | web                     |
|        | GET|HEAD  | password/confirm                 | password.confirm         | App\Http\Controllers\Auth\ConfirmPasswordController@showConfirmForm    | web,auth                |
|        | POST      | password/confirm                 |                          | App\Http\Controllers\Auth\ConfirmPasswordController@confirm            | web,auth                |
|        | POST      | password/email                   | password.email           | App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail  | web                     |
|        | GET|HEAD  | password/reset                   | password.request         | App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm | web                     |
|        | POST      | password/reset                   | password.update          | App\Http\Controllers\Auth\ResetPasswordController@reset                | web                     |
|        | GET|HEAD  | password/reset/{token}           | password.reset           | App\Http\Controllers\Auth\ResetPasswordController@showResetForm        | web                     |
|        | GET|HEAD  | register                         | register                 | App\Http\Controllers\Auth\RegisterController@showRegistrationForm      | web,guest               |
|        | POST      | register                         |                          | App\Http\Controllers\Auth\RegisterController@register                  | web,guest               |
+--------+-----------+----------------------------------+--------------------------+------------------------------------------------------------------------+-------------------------+


Middlewares: Dentro de aplicações web, ele é um código ou programa que é executado entre a requisição(Request) e 
a nossa aplicação (é a lógica executada pelo acesso a um determinada rota)

Request -> Middleware -> Aplicação (Acesso qualquer rota) <- Marketplace

*/