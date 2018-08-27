<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Smart Farmer') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        .bg-dark {
            background-color: #00a65a!important;
            color: #FFF !important;
        }
        .navbar-light .navbar-brand, .navbar-light .navbar-brand:focus, .navbar-light .navbar-brand:hover {
            color: #FFF !important;
        }
        .navbar-light .navbar-nav .nav-link:focus, .navbar-light .navbar-nav .nav-link:hover {
            color: #FFF !important;
        }
        .navbar-light .navbar-nav .nav-link {
            color: #FFF !important;
        }
        .purchase-info {
            background: rgb(0,182,70);
            position: relative;
            color: #FFF;
        }
        .product-item:hover {
            box-shadow:  0px 2px 20px 6px rgba(0, 182, 70, 0.31);
            transition: all .3s;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel bg-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Smart Farmer') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item active">
                            <a class="nav-link" href="{{url('/')}}">
                                All Products
                            </a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="{{url('chemicals')}}">
                                Agro-Chemicals
                            </a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="{{url('fertilisers')}}">
                                Seeds
                            </a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="{{url('fertilisers')}}">
                                Machinery
                            </a>
                        </li>

                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @else
                            <li class="nav-item active">
                                <a class="nav-link" href="{{route('frontend.order.view-cart')}}">
                                    My Cart (
                                    @if(session()->exists('customer_cart'.auth()->user()->id))
                                        {{ count(session()->get('customer_cart'.auth()->user()->id)) }}
                                    @else
                                        0
                                    @endif

                                    )
                                    <span class="sr-only">(current)</span>
                                </a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="{{route('feedback')}}">
                                    Feedback
                                    <span class="sr-only">(current)</span>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if(auth()->user()->user_type==0)
                                    <a href="{{route('admin.dashboard')}}" class="dropdown-item">
                                        Admin Dashboard
                                    </a>
                                        @else
                                        <a href="{{url('home')}}" class="dropdown-item">
                                            My Dashboard
                                        </a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @if(session('status'))
            <div class="alert alert-primary alert-dismissible fade show" role="alert" style="position:fixed; z-index: 99999; left:40%;">
                {{ session()->get('status')}}
            </div>
        @endif
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
