<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <title>Marketplace L6</title>
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin-bottom: 40px">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home')}}">Marketplace</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                @auth
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link @if(request()->is('admin/stores')) active @endif" href="{{ route('admin.stores.index') }}" aria-current="page">Lojas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(request()->is('admin/products')) active @endif" href="{{ route('admin.products.index') }}">Produtos</a>
                        </li>
                    </ul>
                    <div class="my-2 my-lg-0">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                {{-- use o event.preventDefault(); para evitar o comportamento padrão do link--}}
                                <a class="nav-link" href="#" onclick="event.preventDefault(); document.querySelector('form.logout').submit();" aria-current="page" >Sair</a>
                                <form action="{{ route('logout') }}" class="logout" method="POST" style="display:none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth
            </div>
        </div>
    </nav>
    
    <div class="container">
        @include('flash::message')
        @yield('content')
    </div>
</body>
</html>