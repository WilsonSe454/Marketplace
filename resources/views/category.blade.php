@extends('layouts.front')

@section('content')
    <div class="row front">
        <div class="col-12">
            <h2>{{ $category->name }}</h2>
            <hr>
        </div>
        {{-- O forelse vai validar se tem algum produto na categoria escolhida, se tiver ele vai carregar os produtos, caso não tenha ele carrega o conteúdo dentro de @empty --}}
            @forelse ( $category->products as $key => $product )
                <div class="col-md-4">
                    <div class="card" style="width: 98%;">
                        @if( $product->photos->count())
                            <img src="{{ asset('storage/' . $product->photos->first()->image) }}" class="card-img-top" alt="">
                        @else
                            <img src="{{ asset('assets/img/no-photo.jpg') }}" class="card-img-top" alt="">
                        @endif
                        <div class="card-body">
                            <h2 class="card-title">{{ $product->name }}</h2>
                            <p class="card-text">
                                {{ $product->description }}
                            </p>
                            <h3>
                                R$ {{ number_format($product->price, '2', ',', '.') }}
                            </h3>
                            <a href="{{ route('product.single', ['slug' => $product->slug]) }}" class="btn btn-success">
                                Ver produto
                            </a>
                        </div>
                    </div>
                </div>
                @if(( $key + 1 ) % 3 == 0)
                    </div><div class="row front">
                @endif
            @empty
                <h3 class="alert alert-warning">Nunhum produto encontrado para esta categoria!</h3>
            @endforelse
    </div>
@endsection