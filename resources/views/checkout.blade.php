@extends('layouts.front')


@section('content')
    <div class="container">
        <div class="col-md-6">
            <form action="" method="POST">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label>Número do Cartão</label>
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