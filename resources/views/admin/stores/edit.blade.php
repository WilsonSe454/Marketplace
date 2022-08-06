@extends('layouts.app')
@section('content')
    <h1>Atualizar Loja</h1>
    <form action="{{ route('admin.stores.update', ['store' => $store->id]) }}" method="POST">{{-- A função route espera como algumento o apelido da rota --}}
        {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
        @csrf
        
        <div class="form-group">
            <label for="">Nome Loja</label>
            <input type="text" name="name" class="form-control" value="{{ $store->name }}">
        </div>

        <div class="form-group">
            <label for="">Descrição</label>
            <input type="text" name="description" class="form-control" value="{{ $store->description }}">
        </div>

        <div class="form-group">
            <label for="">Telefone</label>
            <input type="text" name="phone" class="form-control" value="{{ $store->phone }}">
        </div>

        <div class="form-group">
            <label for="">Celular/WhatsApp</label>
            <input type="text" name="mobile_phone" class="form-control" value="{{ $store->mobile_phone }}">
        </div>

        <div class="form-group">
            <label for="">Slug</label>
            <input type="text" name="slug" class="form-control" value="{{ $store->slug }}">
        </div>

        <div>
            <button type="submit" class="btn btn-lg btn-success">Atualizar Loja</button>
        </div>
    </form>
@endsection