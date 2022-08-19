@extends('layouts.app')
@section('content')
    <h1>Atualizar Categoria</h1>
    <form action="{{ route('admin.categories.update', ['category' => $category->id]) }}" method="POST">{{-- A função route espera como algumento o apelido da rota --}}
        {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}">  pode ser substituido por @csrf --}}
        @csrf
        {{-- <input type="hidden" name="_method" value="PUT"> Os formularios não aceitam esse verbo. Essa é uma forma que o laravel utiliza para usar outros verbos http, que não são padrões como get e post. --}}
        @method('PUT')
        <div class="form-group">
            <label for="">Nome Loja</label>
            <input type="text" name="name" class="form-control" value="{{ $category->name }}">
        </div>

        <div class="form-group">
            <label for="">Descrição</label>
            <input type="text" name="description" class="form-control" value="{{ $category->description }}">
        </div>

        <div class="form-group">
            <label for="">Slug</label>
            <input type="text" name="slug" class="form-control" value="{{ $category->slug }}">
        </div>

        <div>
            <button type="submit" class="btn btn-lg btn-success">Atualizar Categoria</button>
        </div>
    </form>
@endsection