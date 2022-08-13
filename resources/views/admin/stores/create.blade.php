@extends('layouts.app')
@section('content')
    <h1>Criar Loja</h1>
    <form action="{{ route('admin.stores.store')}}" method="POST">{{-- A função route espera como algumento o apelido da rota --}}
        {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> pode ser substituido por @csrf --}}
        @csrf
        
        <div class="form-group">
            <label for="">Nome Loja</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
            @error('name')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror

        </div>

        <div class="form-group">
            <label for="">Descrição</label>
            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}">
            @error('description')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">Telefone</label>
            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
            @error('phone')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">Celular/WhatsApp</label>
            <input type="text" name="mobile_phone" class="form-control @error('mobile_phone') is-invalid @enderror" value="{{ old('mobile_phone') }}">
            @error('mobile_phone')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">Slug</label>
            <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') }}">

            @error('slug')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <!-- <div class="form-group">
            <label for="">Usuário</label>
            <select name="user" class="form-control">
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div> -->

        <div>
            <button type="submit" class="btn btn-lg btn-success">Criar Loja</button>
        </div>
    </form>
@endsection