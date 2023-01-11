<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

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
        $produtoData = $request->get('product');

        $produto = Product::whereSlug($produtoData['slug']);

        /* 
        if(!$produto->count() || $produtoData['amount'] == 0) 
            return redirect()->route('product.single', ['slug' =>$produtoData['slug']]);
        */

        // Valida se o slug foi modificado e redireciona para a home, caso ele tenha sido modificado
        if(!$produto->count()) 
            return redirect()->route('home');

        // Valida se o amount é igual a zero, e direciona para a single do produto caso seja
        if ($produtoData['amount'] == 0)
            return redirect()->route('product.single', ['slug' => $produtoData['slug']]);
        
        // Faz um merge dos dados que vieram da request com os dados do banco
        $produto = array_merge($produtoData, $produto->first(['name', 'price'])->toArray());


        // verificar se existe sessão para os produtos
        if(session()->has('cart')){

            // Pego os itens da sessão
            $products = session()->get('cart');
            // Pego a coluna slug
            $productsSlugs = array_column($products, 'slug');

            // Se em array produto slug existir dentro de productsSlugs
            if(in_array($produto['slug'], $productsSlugs)){
                // Chamo o método productIncremente para incrementar o amount do produto. Ele vai retornar um array modificado
                $products = $this->productIncrement($produto['slug'], $produto['amount'], $products);

                // sobrescreve a sessão com o array modificado retornado pelo método productIncremente
                session()->put('cart', $products);

            } else { // Caso não aja duplicidade dos amounts

                // existindo eu adiciono estes produtos na sessão existente
                session()->push('cart', $produto);
            }

            
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

    private function productIncrement($slug, $amount, $products)
    {
        // Modifica o array products por meio do array_map
        $products = array_map(function($line) use($slug, $amount){

            // Se slug for igual a linha slug, soma o amount da linha com o amount do products
            if($slug == $line['slug']){
                $line['amount'] += $amount;
            }

            // retorna a linha modificada
            return $line;

        }, $products); 

        // retorna o array modificado
        return $products;
    }
}
