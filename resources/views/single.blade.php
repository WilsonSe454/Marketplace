@extends('layouts.front')

@section('content')
    <div class="row">
        <div class="col-6">
            @if ($produto->photos->count())
                <img src="{{ asset('storage/' . $produto->photos->first()->image) }}" alt="" class="card-img-top">
                <div class="row" style="margin-top:20px;">
                    @foreach ($produto->photos as $photo)
                        <div class="col-4">
                            <img src="{{ asset('storage/' . $photo->image) }}" alt="" class="img-fluid">
                        </div>
                    @endforeach
            </div>
            @else
                <img src="{{ asset('assets/img/no-photo.jpg') }}" alt="" class="card-img-top">                
            @endif
        </div>
        <div class="col-6">
            <div class="col-md-12">
                <h2>{{ $produto->name }}</h2>
                <p>
                    {{ $produto->description }}
                </p>
                <h3>
                    R$ {{ number_format($produto->price, '2', ',', '.') }}
                </h3>
                <span>
                    Loja: {{ $produto->store->name }}
                </span>
            </div>
            <div class="product-add col-md-12">
                <hr>
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product[name]" value="{{ $produto->name }}">
                    <input type="hidden" name="product[price]" value="{{ $produto->price }}">
                    <input type="hidden" name="product[slug]" value="{{ $produto->slug }}">
                    <div class="form-group">
                        <label>Quantidade</label>
                        <input type="number" name="product[amount]" class="form-control col-md-2" value="1">
                    </div>
                    <button class="btn btn-lg btn-danger">Comprar</button>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <hr>
            {{ $produto->body }}
        </div>
    </div>
@endsection