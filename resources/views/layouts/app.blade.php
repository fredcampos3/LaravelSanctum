<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel Sanctum')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        #loadingOverlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1050;
        }

        .spinner-border {
            width: 3rem;
            height: 3rem;
        }
    </style>
</head>
<body>

    <header class="bg-light py-3">
        <div class="container">
            <h3 class="text-center">LaravelSanctum</h3>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item auth">
                            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('home') }}">
                                Home
                            </a>
                        </li>
                        <li class="nav-item auth">
                            <a class="nav-link" href="#" id="logoutBtn">
                                Sair
                            </a>
                        </li>
                        <li class="nav-item not_show">
                            <a class="nav-link {{ request()->is('login') ? 'active' : '' }}" href="{{ route('login') }}">
                                Login
                            </a>
                        </li>
                        <li class="nav-item not_show">
                            <a class="nav-link {{ request()->is('register') ? 'active' : '' }}" href="{{ route('register') }}">Criar conta</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>

    <main class="py-4">
        <div id="loadingOverlay" style="display: none;">
            <div class="spinner-border text-light" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12" id="alertPlaceholder">
                </div>
            </div>
            @yield('content')
        </div>
    </main>

    <footer class="bg-light py-3 mt-4">
        <div class="container text-center">
            <p>&copy; {{ date('Y') }} Frederico Campos. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>
