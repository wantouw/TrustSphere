@extends('layouts.main-layout')

@section('css-link')
    <link rel="stylesheet" href="{{ asset('css/user-profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/project-card.css') }}">
@endsection

@section('content')
    <div class="reset-container">
        <div class="top-section">
            <div class="profile-image-container">
                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture">
            </div>
            <div class="profile-info">
                <h1 class="header-name">{{ $user->name }}</h1>
                <h3 class="header-role">{{ $user->role->name }}</h3>
                <h3 class="header-email">{{ $user->email }}</h3>
                <p class="header-bio">{{$user->bio}}</p>
            </div>
        </div>
        <div class="posts-section">
            <h2 class="posts-header">{{ $user->name }}'s posts</h2>
            <div class="divider"></div>
            <div class="project-list-container">
                @forelse ($user->projects as $project)
                    @include('partials.project-card', ['project' => $project])
                @empty
                    @include('partials.empty-message', ['message' =>  __('project-card.empty-message')])
                @endforelse
            </div>
        </div>
    </div>
@endsection

@section('side-content')
@endsection

@section('scripts')
@endsection
