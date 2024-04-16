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
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{route('admin.index')}}">
                    <img src="" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
                    Admin Control Page
                </a>
            </div>
        </nav>
        <main class="py-1 main_content">
            <div class="row">
                <div class="col-2">
                    <div class="list-group">
                        <a href="{{route('admin.index')}}" class="list-group-item list-group-item-action @if($cur==0) bg-black active @endif "  style="color : aqua;">
                            Home
                        </a>
                        <a href="{{route('admin.users.index')}}" class="list-group-item list-group-item-action @if($cur==1) bg-black active @endif">Users</a>
                        <a href="{{route('admin.orders.index')}}" class="list-group-item list-group-item-action @if($cur==2) bg-black active @endif">Orders</a>
                        <a href="{{route('admin.products.index')}}" class="list-group-item list-group-item-action @if($cur==03) bg-black active @endif">Products</a>
                        <a href="#" class="list-group-item list-group-item-action @if($cur==04) bg-black active @endif" >Create Product</a>
                    </div>
                </div>
                <div class="col">
                    @yield('content')
                </div>

            </div>
        </main>
    </div>

    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    @stack('scripts')
</body>
</html>
