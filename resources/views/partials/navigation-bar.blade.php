@php
    $navItems = [
        [
            'name' => 'Home',
            'icon' =>
                '<svg aria-label="Home" class="x1lliihq x1n2onr6 x5n08af" fill="currentColor" height="24" role="img" viewBox="0 0 24 24" width="24"><title>Home</title><path d="M9.005 16.545a2.997 2.997 0 0 1 2.997-2.997A2.997 2.997 0 0 1 15 16.545V22h7V11.543L12 2 2 11.543V22h7.005Z" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="2"></path></svg>',
            'route' => route('home_page'),
            'active' => Request::is('/'),
        ],
        [
            'name' => 'Explore',
            'icon' =>
                '<svg aria-label="Search" class="x1lliihq x1n2onr6 x5n08af" fill="currentColor" height="24" role="img" viewBox="0 0 24 24" width="24"><title>Search</title><path d="M19 10.5A8.5 8.5 0 1 1 10.5 2a8.5 8.5 0 0 1 8.5 8.5Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path><line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x1="16.511" x2="22" y1="16.511" y2="22"></line></svg>',
            'route' => route('home_page'),
            'active' => Request::is('search'),
        ],
        [
            'name' => 'My Projects',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6" />
</svg>',
            'route' => route('my_projects_page'),
            'active' => Request::is('my-projects'),
        ],
        [
            'name' => 'Liked Projects',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
</svg>
',
            'route' => route('my_projects_page'),
            'active' => Request::is('projects/liked'),
        ],
        [
            'name' => 'Friends',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
</svg>
',
            'route' => route('friends_page'),
            'active' => Request::is('friends'),
        ],
    ];
@endphp
<nav class="sidebar-navbar">
    <h2 class="brand-logo">TrustSphere</h2>
    <div class="menu-wrapper">
        <ul class="nav-menu">
            @foreach ($navItems as $item)
                <li class="nav-list {{ $item['active'] ? 'active' : '' }}">
                    <a href="{{ $item['route'] }}">
                        {!! $item['icon'] !!}
                        <span>{{ $item['name'] }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
        <div class="dropup btn-group w-100">
            @if (Auth::check())
            <button class="profile-menu" type="button" class="dropdown-toggle w-100" data-bs-toggle="dropdown" aria-expanded="false">
                <img class="profile-picture"
                    src="{{ asset('storage/' . Auth::user()->profile_picture) }}"
                    alt="Profile Picture">
                <div class="username-wrapper">
                    <p class="profile-name">{{ Auth::user()->name }}</p>
                    <p class="profile-email">{{ Auth::user()->email }}</p>
                </div>
            </button>
            <ul class="dropdown-menu">
                <li class="dropdown-item" style="border-bottom: 0.5px solid rgba(216, 216, 216, 0.837)">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                      </svg>

                    <a href="">Profile</a>
                </li>
                <li class="dropdown-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-100" style="text-align: left">Log Out</button>
                    </form>
                </li>
              </ul>
            @else
              <a href="{{route('login_page')}}">Login Here</a>
            @endif
        </div>

    </div>
</nav>
