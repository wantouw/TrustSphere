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
                        @if (isset($trending_categories))
                        <div class="right-bubble-container">
                            <h5>{{__('main-layout.category-header')}}</h5>
                            <div class="right-bubble-content-wrapper">
                                @foreach ($trending_categories as $category)
                                    <a href={{ route('explore_project_page', ['categories' => $category->id, 'locale' => App::getLocale()]) }} class="trending-category-wrapper">
                                        <div class="trending-category-name-wrapper">
                                            <p class="trending-category-text">{{$category->name}}</p>
                                            <p class="trending-category-post-text">{{$category->projects->count()}} {{__('main-layout.category-post')}}</p>
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
                        @endif
                        @if (Auth::check() && !Auth::user()->hasRole('admin') && isset($suggested_users))
                            <div class="right-bubble-container">
                                <h5>{{__('main-layout.user-header')}}</h5>
                                <div class="right-bubble-content-wrapper">
                                    @forelse ($suggested_users as $suggested_user)
                                    <form action="{{route('follow_friend')}}" method="POST" class="suggested-user-card">
                                        @csrf
                                        <input type="hidden" name="friend_id" value="{{$suggested_user->id}}">
                                        <div class="left-suggested-user-container">
                                            <img src="{{ asset('storage/' . $suggested_user->profile_picture) }}" alt="">
                                            <a href="{{ route('user_profile_page', ['user_id'=> $suggested_user->id]) }}" class="trending-category-name-wrapper">
                                                <p class="trending-category-text">{{$suggested_user->name}}</p>
                                                <p class="trending-category-post-text">{{$suggested_user->projects->count()}} {{__('main-layout.category-post')}}</p>
                                            </a>
                                        </div>
                                        <div class="right-suggested-user-container">
                                            <button type="submit" class="btn btn-primary follow-btn">{{__('main-layout.follow')}}</button>
                                        </div>
                                    </form>
                                    @empty
                                        <p style="text-align: center;font-size:15px">{{__('main-layout.empty-user')}}</p>
                                    @endforelse
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @show

        </div>
    </div>
    <div class="modal fade" id="friendsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">{{__('main-layout.friends')}}</h5>
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="my-friend-wrapper">
                @forelse (Auth::user()->friends as $friend)
                <form action="{{route('follow_friend')}}" method="POST" class="suggested-user-card">
                    @csrf
                    <input type="hidden" name="friend_id" value="{{$friend->id}}">
                    <a href="{{ route('user_profile_page', ['user_d'=> $friend->id]) }}"" class="left-suggested-user-container">
                        <img src="{{ asset('storage/' . $friend->profile_picture) }}" alt="">
                        <div class="trending-category-name-wrapper">
                            <p class="trending-category-text">{{$friend->name}}</p>
                            <p class="trending-category-post-text">{{$friend->projects->count()}} {{__('main-layout.category-post')}}</p>
                        </div>
                    </a>
                    <div class="right-suggested-user-container">
                        <button type="submit" class="btn btn-primary remove-btn">{{__('main-layout.remove')}}</button>
                    </div>
                </form>

                @empty
                    @include('partials.empty-message', ['message' => __('main-layout.empty-friend')])
                @endforelse
              </div>
            </div>
          </div>
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
