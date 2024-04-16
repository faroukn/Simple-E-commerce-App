<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
{{--    @vite(['resources/sass/app.scss', 'resources/js/app.js'])--}}
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    @stack('styles')
</head>
<body>

    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-body-secondary mb-7 fixed-top" >
            <div class="container-fluid">
                <a class="navbar-brand" href="{{route('app.index')}}">
                    LogoSite
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{route('app.index')}}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{route('shop.index')}}">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{route('cart.index')}}">Cart</a>
                        </li>

                    </ul>
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>

                    </form>

                        <li class="nav-item">
                            <a href="{{route('wishlist.index')}}" class="nav-link">
                                <i class="fa fa-heart position-relative">
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" >{{Cart::instance('wishlist')->content()->count()}}</span>
                                </i>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('cart.index')}}" class="nav-link">
                                <i class="fa fa-shopping-cart position-relative">
                                    <span class="bposition-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{Cart::instance('cart')->content()->count()}}</span>
                                </i>
                            </a>
                        </li>

                        @if (Route::has('login'))
                            @auth
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            {{ Auth::user()->name }}
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                            @if(Auth::user()->utype == "ADM")
                                                <a class="dropdown-item" href="{{ route('admin.index') }}" >Dashboard</a>
                                            @else
                                                <a class="dropdown-item" href="{{ route('user.index') }}" >My Account</a>
                                                <a class="dropdown-item" href="{{ route('order.index') }}" >My Orders</a>

                                            @endif
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>

                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                                @endauth
                            @endif
                    </ul>
                </div>
            </div>
        </nav>

{{--        <nav class="navbar" style="background-color: #e3f2fd;">--}}
{{--            <div class="container-fluid">--}}

{{--            <a class="navbar-brand" href="{{ url('/') }}">--}}
{{--                    {{ config('app.name', 'Laravel') }}--}}
{{--                </a>--}}
{{--                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">--}}
{{--                    <span class="navbar-toggler-icon"></span>--}}
{{--                </button>--}}

{{--                <div class="navbar-brand" id="navbarSupportedContent">--}}
{{--                    <!-- Left Side Of Navbar -->--}}
{{--                    <ul class="navbar-nav me-auto">--}}

{{--                    </ul>--}}

{{--                    <!-- Right Side Of Navbar -->--}}
{{--                    <ul class="navbar-nav ms-auto">--}}
{{--                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">--}}

{{--                    <!-- Authentication Links -->--}}
{{--                       --}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </nav>--}}

        <main class="py-4 main_content" style="margin-top: 50px;">
            @yield('content')
        </main>
    </div>

    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    @stack('scripts')
</body>
</html>
