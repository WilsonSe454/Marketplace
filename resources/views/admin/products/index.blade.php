@extends('layouts.app')
@section('content')
    <a href="{{ route('admin.products.create') }}" class="btn btn-lg btn-success">Criar Produto</a>{{-- A função route espera como algumento o apelido da rota --}}
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Produto</th>
                <th>Loja</th>
                <th>Preço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->store->name }}</td>
                    <td>R$ {{ number_format($product->price, 2, ',', '.') }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('admin.products.edit', ['product' => $product->id]) }}" class="btn btn-sm btn-primary">Editar</a>{{-- A função route espera como algumento o apelido da rota --}}
                            <form action="{{ route('admin.products.destroy', ['product' => $product->id]) }}" method="POST">{{-- A função route espera como algumento o apelido da rota --}}
                                @csrf
                                @method('DELETE') {{-- É necessário para que o laravel interprete como uma requisição do tipo DELETE e mande para o método destroy --}}
                                <button type="submit" class="btn btn-sm btn-danger">Remover</button>
                            </form>
                        </div>                            
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $products->links() }}
@endsection
