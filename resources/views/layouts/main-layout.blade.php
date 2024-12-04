<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{{ csrf_token() }}}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.3-dist/css/bootstrap.css') }}">
    <link rel="stylesheet" href={{asset('css/app.css')}}>
    <link rel="stylesheet" href={{asset('css/navbar.css')}}>
    @yield('css-link')

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="main-layout">
        <div class="nav-container">
            @include('partials.navigation-bar')
        </div>
        <div class="main-layout-container">
            @yield('content')
            
        </div>
    </div>
    {{-- @include('partials.footer') --}}
    @yield('scripts')
    <script src="{{ asset('bootstrap-5.3.3-dist/js/bootstrap.bundle.js') }}"></script>
    <script src="https://kit.fontawesome.com/f7c4eeb796.js" crossorigin="anonymous"></script>
    <script>


    </script>
</body>

</html>
