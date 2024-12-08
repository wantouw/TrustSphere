@extends('layouts.main-layout')


@section('title', 'Explore')

@section('css-link')
    <link rel="stylesheet" href="css/project-card.css">
    <link rel="stylesheet" href="css/home.css">
@endsection

@section('content')
    <div class="left-container">
        <div class="search-container">
            <div>
                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" class="search-pp" alt="">
            </div>
            <form class="form-inline" action="{{ route('search_project') }}" method="GET">
                    <div class="input-wrapper">
                        <i class="fa-solid fa-search icon"></i>
                        <input class="input-field" type="text" id="search-query" name="search_query" placeholder="What awesome ideas do you have for your project?">
                    </div>
                {{-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> --}}
            </form>
            <a class="btn btn-primary create-post-btn" href="">
                Create Post
            </a>
        </div>

        <div class="project-list-container">
            @forelse ($projects as $project)
                @include('partials.project-card', ['project' => $project])
            @empty
                @include('partials.empty-message', ['message' => 'No projects yet'])
            @endforelse
        </div>
    </div>

@endsection

@section('side-content')

@endsection
