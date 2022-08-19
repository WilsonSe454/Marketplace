@extends('layouts.app')
@section('content')
    <a href="{{ route('admin.categories.create') }}" class="btn btn-lg btn-success">Criar Categoria</a>{{-- A função route espera como algumento o apelido da rota --}}
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Categoria</th>
                <th>Descrição</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('admin.categories.edit', ['category' => $category->id]) }}" class="btn btn-sm btn-primary">Editar</a>{{-- A função route espera como algumento o apelido da rota --}}
                            <form action="{{ route('admin.categories.destroy', ['category' => $category->id]) }}" method="POST">{{-- A função route espera como algumento o apelido da rota --}}
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

    {{ $categories->links() }}
@endsection
