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
                        <a href="{{ route('admin.stores.edit', ['store' => $store->id]) }}" class="btn btn-sm btn-primary">Editar</a>{{-- A função route espera como algumento o apelido da rota --}}
                        <a href="{{ route('admin.stores.destroy', ['store' => $store->id]) }}" class="btn btn-sm btn-danger">Remover</a>{{-- A função route espera como algumento o apelido da rota --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{$stores->links()}}
@endsection
