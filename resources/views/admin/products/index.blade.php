@extends('layouts.app')
@section('content')
    <a href="{{ route('admin.products.create') }}" class="btn btn-lg btn-success">Criar Produto</a>{{-- A função route espera como algumento o apelido da rota --}}
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Produto</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td>
                        <a href="{{ route('admin.products.edit', ['product' => $product->id]) }}" class="btn btn-sm btn-primary">Editar</a>{{-- A função route espera como algumento o apelido da rota --}}
                        <a href="{{ route('admin.products.destroy', ['product' => $product->id]) }}" class="btn btn-sm btn-danger">Remover</a>{{-- A função route espera como algumento o apelido da rota --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{$products->links()}}
@endsection
