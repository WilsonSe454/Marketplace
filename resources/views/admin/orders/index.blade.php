@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <h2>Pedidos Recebidos</h2>
            <hr>
        </div>
        <div class="col-12">
            <div class="accordion" id="accordionExample">
                @forelse ( $orders as $key => $order)
                    <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                                data-target="#collapse{{$key}}" aria-expanded="true" aria-controls="collapseOne">
                                Pedido n°: {{ $order->reference }}
                            </button>
                        </h2>
                    </div>

                    <div id="collapse{{$key}}" class="collapse @if($key ==0) show @endif" aria-labelledby="headingOne"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            Some placeholder content for the first accordion panel. This panel is shown by default, thanks
                            to the <code>.show</code> class.
                        </div>
                    </div>
                </div>
                @empty
                    <div class="alert alert-warning">Nenhum pedido recebido!</div>
                @endforelse
                
            </div>
        </div>
        <div class="col-12">
            <hr>
            {{ $orders->links() }}
        </div>
    </div>
@endsection
