<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Surve</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/css.css') }}" rel="stylesheet">




</head>

<body id="overrides">
    <!-- Main Container -->
    <div class="main-container">
        <!-- Navigation -->
        <header class=""> <a href="">
                <h4 class="logo">Surve.ac</h4>
            </a>
            <nav class="">
                <ul>
                    <li><a href="/">HOME</a></li>
                    <li><a href="{{ route('about') }}">ABOUT</a></li>
                    @if (Route::has('login'))
                    @auth
                    <li> <a href="{{ route('market') }}">MARKET</a></li>
                    <li> <a href="{{ route('surveys.index') }}">SURVEYS</a></li>
                    <li> <a href="{{ route('profile') }}">{{Auth::User()->username}}</a></li>
                    @else
                    <li> <a href="{{ route('login') }}">LOGIN</a>
                    <li>
                        @endauth
                        @endif
                </ul>
            </nav>
        </header>
        @include('cookieConsent::index')
    </div>
    <!-- Main Container Ends -->
    @yield('content')
</body>

</html>
