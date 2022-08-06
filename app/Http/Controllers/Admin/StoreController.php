<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Store;
use App\User;

class StoreController extends Controller
{
    public function index()
    {
        // $stores = Store::all();
        $stores = Store::paginate(10);
        //http://127.0.0.1:8000/admin/stores?page=2 para navegar para a página 2 ou use na view index o {{$stores->links()}}
        return view('admin.stores.index', compact('stores'));
    }

    public function create()
    {
        $users = User::all('id', 'name');
        return view('admin.stores.create', compact('users'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $user = User::find($data['user']);
        $store = $user->store()->create($data);

        flash('Loja Criada com Sucesso')->success();
        
        return redirect()->route('admin.stores.index');
    }

    public function edit($id)
    {
        $store = Store::find($id);

        return view('admin.stores.edit', compact('store'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $store = Store::find($id);
        $store->update($data);

        flash('Loja Atualizada com Sucesso!')->success();

        return redirect()->route('admin.stores.index');// Estou utilizadno o apelido da rota
    }

    public function destroy($id)
    {
        $store = Store::find($id);
        $store->delete();

        // return redirect('/admin/stores');

        flash('Loja Removida com Sucesso!')->success();
        return redirect()->route('admin.stores.index');// Estou utilizando o apelido da rota
    }
}
