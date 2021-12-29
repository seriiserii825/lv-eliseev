<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Scripts -->
    <script src="{{ mix('js/app.js', 'build') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('css/app.css', 'build') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="main-header navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <div class="main-header__top">
                <ul>
                    <li>
                        <a href="{{ url('/') }}">Adverts</a>
                    </li>
                </ul>

                <div class="main-header__menu">
                    @guest
                        <div class="my-select">
                            <div class="my-select__header">
                                <span>Select</span>
                                <span class="my-select__icon">
                                    @include('svg.caret-down')
                                </span>
                            </div>
                            <ul>
                                <li><a href="{{ route('register') }}">Register</a></li>
                                <li><a href="{{ route('login') }}">Login</a></li>
                            </ul>
                        </div>
                    @else
                        <div>{{ Auth::user()->email }}</div>
                        <div class="my-select">
                            <div class="my-select__header">
                                <span>Select</span>
                                <span class="my-select__icon">
                                    @include('svg.caret-down')
                                </span>
                            </div>
                            <ul>
                                <li><a href="{{ route('admin.index') }}">Admin</a></li>
                                <li><a href="{{ route('logout') }}">Logout</a></li>
                            </ul>
                        </div>
                    @endauth
                </div>
            </div>
    </nav>

    <main class="main py-4">
        <div class="container">
            @section('breadcrumbs', Breadcrumbs::render())
            @yield('breadcrumbs')
            @include('layouts.partials.flash')
            @yield('content')
        </div>
    </main>
    <div class="main-footer">
        <div class="container">
            <span>&copy; {{ date('Y') }} - Advertis</span>
        </div>
    </div>
</div>
<script {{ asset('js/bootstrap.js') }}></script>
<script {{ asset('js/app.js') }}></script>
</body>
</html>
