<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{{ csrf_token() }}}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.3-dist/css/bootstrap.css') }}">
</head>
<body>
    @include('partials.navigation-bar')
    <div class="p-5">
        @yield('content')
    </div>
    @include('partials.footer')
    @yield('scripts')
    <script src="{{ asset('bootstrap-5.3.3-dist/js/bootstrap.bundle.js') }}"></script>
</body>

</html>
