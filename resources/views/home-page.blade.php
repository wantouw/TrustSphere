@extends('layouts.main-layout')


@section('title', 'Home')

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
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"
                    name="search_query">
                {{-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> --}}
            </form>

        </div>

        <div class="project-list-container">
            @foreach ($projects as $project)
                @include('partials.project-card', ['project' => $project])
            @endforeach
        </div>
    </div>
    <div class="right-container">

    </div>
@endsection
