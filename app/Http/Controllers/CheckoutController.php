<?php

namespace App\Http\Controllers;

use App\Payment\Pagseguro\CreditCard;
use Exception;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        // session()->forget('pagseguro_session_code');
        if(!auth()->check()){
            return redirect()->route('login');
        }
        // se não tiver o cart na sessão, direcione para home
        if(!session()->has('cart')) return redirect()->route('home');
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
        try {
            $dataPost = $request->all();

            // Defina um código de referência para esta solicitação de pagamento. É útil identificar este pagamento
            // em notificações futuras.


            // Pega o usuário autenticado
            $user = auth()->user();

            $reference = 'XPTO';

            // Pega os itens do carrinho
            $cartItems = session()->get('cart');

            $creditCardPayment = new CreditCard($cartItems, $user, $dataPost, $reference);

            $result = $creditCardPayment->doPayment();

            // var_dump($result);

            $userOrder = [
                'reference' => $reference,
                'pagseguro_code' => $result->getCode(),
                'pagseguro_status' => $result->getStatus(),
                'items' => serialize($cartItems),
                'store_id' => 50

            ];

            $user->orders()->create($userOrder);

            session()->forget('cart');
            session()->forget('pagseguro_session_code');

            return response()->json([
                'data' => [
                    'status' => true,
                    'message' => 'Pedido criado com sucesso!',
                    'order' => $reference
                ]
            ]);
        } catch (\Exception $e) {
            //A messagem com o erro só vai aparecer em ambiente de desenvolvimento
            $message = env('APP_DEBUG') ? $e->getMessage() : 'Erro ao processar pedido!';
            return response()->json([
                'data' => [
                    'status' => false,
                    'message' => $message
                ]
            ], 401);
        }
    }

    public function thanks()
    {
        return view('thanks');
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
