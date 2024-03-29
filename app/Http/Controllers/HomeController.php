<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Product;
use App\Store;

class HomeController extends Controller
{
    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('auth'); //Verifica se o usuário está logado ou não
    // }
    
    private $product;
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = $this->product->limit(6)->orderBy('id', 'DESC')->get();
        $stores = Store::limit(3)->orderBy('id','DESC')->get();

        // return view('home');
        return view('welcome', compact('products', 'stores'));
    }

    public function single($slug)
    {
        $produto = $this->product->whereSlug($slug)->first();
            
        return view('single', compact('produto'));
    }
}

/* 
Middlewares: Dentro de aplicações web, ele é um código ou programa que é executado entre a requisição(Request) e 
a nossa aplicação (é a lógica executada pelo acesso a um determinada rota)

Request -> Middleware -> Aplicação (Acesso qualquer rota) <- Marketplace
*/
