@extends('layouts.app')
@section('content')
    <h1>Atualizar Loja</h1>
    <form action="{{ route('admin.stores.update', ['store' => $store->id]) }}" method="POST" enctype="multipart/form-data">{{-- A função route espera como algumento o apelido da rota --}}
        {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> pode ser substituido por @csrf --}}
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="">Nome da Loja</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $store->name }}">
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">Descrição</label>
            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{ $store->description }}">
            @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">Telefone</label>
            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ $store->phone }}">
            @error('phone')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">Celular/WhatsApp</label>
            <input type="text" name="mobile_phone" class="form-control @error('mobile_phone') is-invalid @enderror" value="{{ $store->mobile_phone }}">
            @error('mobile_phone')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <p>
                <img src="{{ asset('storage/' . $store->logo) }}" alt="">
            </p>
            <label>Foto da Loja</label>
            <input type="file" class="form-control @error('logo') is-invalid @enderror" name="logo">
            @error('logo')
                <div class="invalid-feedback">
                    {{ $message }}    
                </div>                
            @enderror
        </div>

        {{-- O Slug foi dinamizado --}}
        
        {{-- <div class="form-group">
            <label for="">Slug</label>
            <input type="text" name="slug" class="form-control" value="{{ $store->slug }}">
        </div> --}}

        <div>
            <button type="submit" class="btn btn-lg btn-success">Atualizar Loja</button>
        </div>
    </form>
@endsection