<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page-title') | {{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite('resources/js/app.js') <!-- Questo include il JS, ma potrebbe esserci un altro JS incluso più in basso -->
</head>

<body>
    <!-- Navbar principale -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-expand-md bg-body-tertiary">
            <div class="container d-flex justify-content-center">
                <a href="{{ env('FRONTEND_URL', 'http://localhost:5174') }}" class="">
                    <img src="/images/logo-deliveBoo.svg" class="logo" alt="deliveBooLogo">
                </a>
            </div>
        </nav>
    </header>

    <!-- Contenuto principale -->
    <main class="vh-100">
        <div class="container">
            @yield('main-content')
        </div>
    </main>

</body>

</html>


<style>
    main {
        background-image: url('{{ asset('/images/background-pattern-Login.png') }}');
        background-size: cover;
        background-repeat: repeat;
        background-position: center;
        width: 100%;
    }
</style>
