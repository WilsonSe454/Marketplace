<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Store;
use App\Category;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function __construct(Product $product)
    {
        $this->product = $product;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $products = Product::paginate(10);
        // $products = $this->product->paginate(10);

        $store = auth()->user()->store;
        $products = $store->products()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $store = auth()->user()->store;
        // $store = Store::find($data['store']);
        $product = $store->products()->create($data);

        $product->categories()->sync($data['categories']);

        if($request->hasFile('photos')){
            $images = $this->imageUpload($request, 'image');
            //Inserção destas imagens/referência na base
            // $product->photos()->createMany(['image' => 'nome_da_foto.png'], ['image' => 'nome_da_foto.png']); nome da coluna e nome da foto. Igual ao que foi passado na função imageUpload
            $product->photos()->createMany($images);
        }

        flash('Produto Criado com Sucesso!')->success();

        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $product = Product::findOrFail($id);
        $product = $this->product->findOrFail($id);

        $categories = Category::all();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $data = $request->all();

        // $product = Product::find($id);
        $product = $this->product->findOrFail($id);
        $product->update($data);
        $product->categories()->sync($data['categories']);
        flash('Produto Atualizado com Sucesso!')->success();

        return redirect()->route('admin.products.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $product = Product::find($id);
        $product = $this->product->find($id);
        $product->delete();

        flash('Produto Removido com Sucesso!')->success();
        return redirect()->route('admin.products.index');
    }

    private function imageUpload(Request $request, $imageColumn)
    {

        // dd($request->file('photos')); //retorna objetos UploadedFile

        $images = $request->file('photos');

        $uploadedImages = [];

        foreach ($images as $image) {
            $uploadedImages[] = [$imageColumn => $image->store('products', 'public')];
        }

        return $uploadedImages;
    }
}
