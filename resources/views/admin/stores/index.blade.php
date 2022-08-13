@extends('layouts.app')
@section('content')
    <a href="{{ route('admin.stores.create') }}" class="btn btn-lg btn-success">Criar Loja</a>{{-- A função route espera como algumento o apelido da rota --}}
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Loja</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stores as $store)
                <tr>
                    <td>{{ $store->id }}</td>
                    <td>{{ $store->name }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('admin.stores.edit', ['store' => $store->id]) }}" class="btn btn-sm btn-primary">Editar</a>{{-- A função route espera como algumento o apelido da rota --}}
                            <form action="{{ route('admin.stores.destroy', ['store' => $store->id]) }}" method="POST">{{-- A função route espera como algumento o apelido da rota --}}
                                @csrf
                                @method('DELETE')
                                <button type="submit"class="btn btn-sm btn-danger">Remover</button>
                            </form>    
                        </div>                            
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{$stores->links()}}
@endsection