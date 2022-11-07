<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        // session()->forget('pagseguro_session_code');
        if(!auth()->check()){
            return redirect()->route('login');
        }

        $this->makePagSeguroSession();


        // usar o var_dump e não o dd
        // var_dump(session()->get('pagseguro_session_code'));


        // Remove a chave da sessão. Vc pode usar isso para forçar a geração de uma nova chave, ex: se a chave expirar.
        // session()->forget('pagseguro_session_code');


        $total = 0;

        // Multiplica o valor pela quantidade de produtos
        $cartItems = array_map(function($line){
            return $line['amount'] * $line['price'];
        },session()->get('cart'));

        // Soma o total a pagar
        $cartItems = array_sum($cartItems);

        return view('checkout', compact('cartItems'));
    }

    public function proccess(Request $request)
    {
        $dataPost = $request->all();

        // Defina um código de referência para esta solicitação de pagamento. É útil identificar este pagamento
        // em notificações futuras.
        $reference = 'XPTO';
        $creditCard = new \PagSeguro\Domains\Requests\DirectPayment\CreditCard();

        // É possível pegar o ReceiverEmail utilizando a função env e passando como argumento a chave PAGSEGURO_EMAIL
        $creditCard->setReceiverEmail(env('PAGSEGURO_EMAIL'));

        // Variável reference que vai armazenar o código referência para poder identificar a transação futuramente
        $creditCard->setReference($reference);

        // Moeda utilizada
        $creditCard->setCurrency("BRL");

        // Pega os itens do carrinho
        $cartItems = session()->get('cart');

        // Adiciona os itens à transação
        foreach($cartItems as $item) {
            $creditCard->addItems()->withParameters(
                $reference,
                $item['name'],
                $item['amount'],
                $item['price']
            );
        }

        // Defina as informações do seu cliente.
        // Se você usa SANDBOX você deve usar um e-mail @sandbox.pagseguro.com.br

        // Informações do cliente

        // Pega o usuário autenticado
        $user = auth()->user();
        // Se estiver em ambiente de test "quando a variável no .env estiver com sandbox" use o email test@sandbox.pagseguro.com.br. Caso contrario use o email do usuário.
        $email = env('PAGSEGURO_ENV') == 'sandbox' ? 'test@sandbox.pagseguro.com.br' : $user->email;

        $creditCard->setSender()->setName($user->name);
        $creditCard->setSender()->setEmail($email);

        $creditCard->setSender()->setPhone()->withParameters(
            11,
            56273440
        );

        $creditCard->setSender()->setDocument()->withParameters(
            'CPF',
            '87201383698'
        );

        $creditCard->setSender()->setHash($dataPost['hash']);

        $creditCard->setSender()->setIp('127.0.0.0');

        // Definir informações de envio para esta solicitação de pagamento
        $creditCard->setShipping()->setAddress()->withParameters(
            'Av. Brig. Faria Lima',
            '1384',
            'Jardim Paulistano',
            '01452002',
            'São Paulo',
            'SP',
            'BRA',
            'apto. 114'
        );

        // Definir informações de cobrança do cartão de crédito
        $creditCard->setBilling()->setAddress()->withParameters(
            'Av. Brig. Faria Lima',
            '1384',
            'Jardim Paulistano',
            '01452002',
            'São Paulo',
            'SP',
            'BRA',
            'apto. 114'
        );

        // Set credit card token
        $creditCard->setToken($dataPost['card_token']);

        list($quantity, $installmentAmount) = explode('|', $dataPost['installment']);

        $installmentAmount = number_format($installmentAmount, 2, '.', '');
        
        // Defina a quantidade e o valor da parcela (pode ser obtido usando o service, que tem um exemplo aqui em \public\getInstallments.php)
        $creditCard->setInstallment()->withParameters($quantity, $installmentAmount);

        // Defina as informações do titular do cartão de crédito
        $creditCard->setHolder()->setBirthdate('01/10/1979');
        // Igual no cartão de crédito
        $creditCard->setHolder()->setName($dataPost['card_name']); 

        $creditCard->setHolder()->setPhone()->withParameters(
            11,
            56273440
        );

        $creditCard->setHolder()->setDocument()->withParameters(
            'CPF',
            '87201383698'
        );

        // Defina o modo de pagamento para esta solicitação de pagamento
        $creditCard->setMode('DEFAULT');

        //Obtenha as credenciais e registre o pagamento com cartão de crédito
        $result = $creditCard->register(
            \PagSeguro\Configuration\Configure::getAccountCredentials()
        );

        // var_dump($result);

        $userOrder = [
            'reference' => $reference,
            'pagseguro_code' => $result->getCode(),
            'pagseguro_status' => $result->getStatus(),
            'items' => serialize($cartItems),
            'store_id' => 50

        ];

        $user->orders()->create($userOrder);

        return response()->json([
            'data' => [
                'status' => true,
                'message' => 'Pedido criado com sucesso!'
            ]
        ]);
    }


    private function makePagSeguroSession()
    {
        if(!session()->has('pagseguro_session_code')){
            $sessionCode = \PagSeguro\Services\Session::create(
                \PagSeguro\Configuration\Configure::getAccountCredentials()
            );

            session()->put('pagseguro_session_code', $sessionCode->getResult());
        }
    }
}
