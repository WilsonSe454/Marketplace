<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        dd(session()->get('cart'));
    }

    public function add(Request $request)
    {
        $produto = $request->get('product');

        // verificar se existe sessão para os produtos
        if(session()->has('cart')){
            // existindo eu adiciono estes produtos na sessão existente
            session()->push('cart', $produto);
        } else {
            // não existindo eu crio esta sessão com o primeiro produto
            $produtos[] = $produto;
            session()->put('cart', $produtos);
        }

        flash('Produto Adicionado ao carrinho!')->success();
        return redirect()->route('product.single', ['slug' => $produto['slug']]);

    }
}
