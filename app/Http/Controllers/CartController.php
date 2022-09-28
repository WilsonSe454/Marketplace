<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        // dd(session()->get('cart'));
        $cart = session()->has('cart') ? session()->get('cart') : [];

        return view('cart', compact('cart'));
        
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

    public function remove($slug)
    {
        // Verifica de está na session cart, se não tiver ele vai redirecionar para cart.index
        if(!session()->has('cart'))
            return redirect()->route('cart.index');
        
        // pega todos os produtos da sessão
        $produto = session()->get('cart');

        // usa o array_filter para percorrer do array de produtos
        $produto = array_filter($produto, function($line) use($slug){
            // retorna a falso quando a linha for igual ao slug
            return $line['slug'] != $slug;
        });

        session()->put('cart', $produto);
        
        flash('Produto removido com sucesso!')->success();
        return redirect()->route('cart.index');
    }

    public function cancel()
    {
        // tira da sessão o carrinha por meio desse método forget
        session()->forget('cart');

        flash('Compra cancelada!')->success();
        return redirect()->route('cart.index');
    }
}
