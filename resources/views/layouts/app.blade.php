<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'X COPA USMP 2025')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Bootstrap 5 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .bg-smtp {
            background-color: #bc1816;
        }

        .logo {
            position: absolute;
            width: 140px;
            top: 0;
            left: 8rem;
            background-color: white
        }

        .logo-xs {
            position: absolute;
            width: 60px;
            top: 0;
            left: 0.5rem;
            background-color: white;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-dark mb-4" style="background-color: #bc1816;">
        <div class="container-fluid">
            <img src="{{ asset('images/logo.png') }}"
                alt="Logo"
                class="me-2 bg-smtp logo d-none d-lg-block">

            <img src="{{ asset('images/logo.png') }}"
                alt="Logo"
                class="me-2 bg-smtp logo-xs d-lg-none">
            <span class="navbar-brand mb-0 m-auto h1" style="font-size: 3erm">X COPA USMP 2025</span>
        </div>
    </nav>

    <nav class="mb-4 navbar navbar-expand-lg">
        <div class="container">


            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="m-auto navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('fase.grupos') ? 'active' : '' }}" href="{{ route('fase.grupos') }}">
                            Fase de Grupos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('fase.semifinales') ? 'active' : '' }}" href="{{ route('fase.semifinales') }}">
                            Semifinales
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="container">
        @yield('content')
    </main>

    {{-- Bootstrap 5 JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>