@extends('layouts.front')


@section('content')
    <div class="container">
        <div class="col-md-6">
            <form action="" method="POST">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label>Número do Cartão <span class="brand"></span></label>
                        <input type="text" class="form-control" name="card_number">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 form-group">
                        <label>Mês de Expiração</label>
                        <input type="text" class="form-control" name="card_month">
                    </div>
                    <div class="col-md-2 form-group">
                        <label>Ano de Expiração</label>
                        <input type="text" class="form-control" name="card_year">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label>Código de segurança</label>
                        <input type="text" class="form-control" name="card_cvv">
                    </div>
                </div>
                <button class="btn btn-success btn-lg">Efetuar Pagamento</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
    <script>
        const sessionId = '{{ session()->get('pagseguro_session_code') }}';

        PagSeguroDirectPayment.setSessionId(sessionId);
    </script>

    <script>
        let cardNumber = document.querySelector('input[name=card_number]');
        let spanBrand = document.querySelector('span.brand');
        cardNumber.addEventListener('keyup', function(){
            // console.log(cardNumber.value);

            if(cardNumber.value.length >= 6){
                PagSeguroDirectPayment.getBrand({
                    cardBin: cardNumber.value.substr(0, 6),
                    success: function(res){
                        // console.log(res);
                        let imgFlag = `<img src="https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/68x30/${res.brand.name}.png">`
                        spanBrand.innerHTML = imgFlag;
                    },
                    error: function(err){
                        console.log(err);
                    },
                    complete: function(res){ // é chamada quando a requisição for totalmente executada
                        // console.log('Complete: ', res);
                    }
                });
            }
        });
    </script>
@endsection