<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        
        if(!auth()->check()){
            return redirect()->route('login');
        }

        $this->makePagSeguroSession();

        // usar o var_dump e não o dd
        var_dump(session()->get('pagseguro_session_code'));

        // Remove a chave da sessão. Vc pode usar isso para forçar a geração de uma nova chave, ex: se a chave expirar.
        // session()->forget('pagseguro_session_code');
        return view('checkout');
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
