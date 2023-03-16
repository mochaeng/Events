<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    @yield('extra-import')
    {{-- @vite(['resources/css/app.css']) --}}
    @vite(['resources/css/main.css', 'resources/js/app.js'])
    {{-- @vite(['resources/css/main.css']) --}}
</head>

<body>
    {{-- Header --}}
    <header>
        <nav class="navbar navbar-expand-lg main-nav-header">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">
                    <img id="logo-img" src="{{ Vite::asset('./resources/images/twice_logo.svg') }}"
                        class="d-inline-block align-text-middle">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                        <li class="nav-item ">
                            <a class="nav-link active" aria-current="page" href="/">Home</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link active" aria-current="page" href="#">Eventos</a>
                        </li>
                        @auth
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="/events/create">Criar
                                    Evento</a>
                            </li>
                        @endauth
                    </ul>
                    <form class="d-flex" role="search">
                        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                                @guest
                                    <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="/register">Criar Conta</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="/login">Login</a>
                                    </li>
                                @endguest
                                @auth
                                    <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="/dashboard">Meus Eventos</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="#">Profile</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="/logout">Logout</a>
                                    </li>
                                @endauth
                            </ul>
                        </div>

                    </form>
                </div>
            </div>
        </nav>
    </header>

    <main class="main-body-container">
        <div class="container-fluid">
            <div class="row">
                @if (@session('msg'))
                    <p class="msg">{{ @session('msg') }}</p>
                @endif
                @yield('content')
            </div>
        </div>
    </main>

    <footer>
        <p>HDC Events &copy; 2023</p>
    </footer>
</body>

</html>
