<?php

namespace App\Payment\Pagseguro;


class CreditCard {

    private $items;
    private $user;
    private $cardInfo;
    private $reference;

    public function __construct($items, $user, $cardInfo, $reference) 
    {
        $this->items = $items;
        $this->user = $user;
        $this->cardInfo = $cardInfo;
        $this->reference = $reference;
    }

    public function doPayment()
    {

        $creditCard = new \PagSeguro\Domains\Requests\DirectPayment\CreditCard();

        // É possível pegar o ReceiverEmail utilizando a função env e passando como argumento a chave PAGSEGURO_EMAIL
        $creditCard->setReceiverEmail(env('PAGSEGURO_EMAIL'));

        // Variável reference que vai armazenar o código referência para poder identificar a transação futuramente
        $creditCard->setReference($this->reference);

        // Moeda utilizada
        $creditCard->setCurrency("BRL");

        // Adiciona os itens à transação
        foreach ($this->items as $item) {
            $creditCard->addItems()->withParameters(
                $this->reference,
                $item['name'],
                $item['amount'],
                $item['price']
            );
        }

        // Defina as informações do seu cliente.
        // Se você usa SANDBOX você deve usar um e-mail @sandbox.pagseguro.com.br

        // Informações do cliente

        // Pega o usuário autenticado
        $user = $this->user;
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

        $creditCard->setSender()->setHash($this->cardInfo['hash']);

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
        $creditCard->setToken($this->cardInfo['card_token']);

        list($quantity, $installmentAmount) = explode('|', $this->cardInfo['installment']);

        $installmentAmount = number_format($installmentAmount, 2, '.', '');

        // Defina a quantidade e o valor da parcela (pode ser obtido usando o service, que tem um exemplo aqui em \public\getInstallments.php)
        $creditCard->setInstallment()->withParameters($quantity, $installmentAmount);

        // Defina as informações do titular do cartão de crédito
        $creditCard->setHolder()->setBirthdate('01/10/1979');
        // Igual no cartão de crédito
        $creditCard->setHolder()->setName($this->cardInfo['card_name']);

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


        return $result;
    }
}