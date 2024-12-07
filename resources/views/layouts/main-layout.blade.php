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
            @section('side-content')
                <div class="right-container">
                    <div class="right-side-wrapper">

                        <div class="right-bubble-container">
                            <h5>Trending Categories</h5>
                            <div class="right-bubble-content-wrapper">
                                @foreach ($trending_categories as $category)
                                    <a href="" class="trending-category-wrapper">
                                        <div class="trending-category-name-wrapper">
                                            <p class="trending-category-text">{{$category->name}}</p>
                                            <p class="trending-category-post-text">{{$category->projects->count()}} posts</p>
                                        </div>
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                            </svg>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        @if (Auth::check())
                            <div class="right-bubble-container">
                                <h5>Suggested Users</h5>
                                <div class="right-bubble-content-wrapper">
                                    @foreach ($suggested_users as $suggested_user)
                                    <form action="{{route('follow_friend')}}" method="POST" class="suggested-user-card">
                                        @csrf
                                        <input type="hidden" name="friend_id" value="{{$suggested_user->id}}">
                                        <div class="left-suggested-user-container">
                                            <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="">
                                            <div class="trending-category-name-wrapper">
                                                <p class="trending-category-text">{{$suggested_user->name}}</p>
                                                <p class="trending-category-post-text">{{$suggested_user->projects->count()}} posts</p>
                                            </div>
                                        </div>
                                        <div class="right-suggested-user-container">
                                            <button type="submit" class="btn btn-primary follow-btn">Follow</button>
                                        </div>
                                    </form>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @show

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
