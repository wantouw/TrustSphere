@extends('layouts.main-layout')


@section('title', 'Home')

@section('css-link')
    <link rel="stylesheet" href="css/project-card.css">
    <link rel="stylesheet" href="css/home.css">
@endsection

@section('content')
    <div class="left-container">
        @include('partials.search-bar')
        <div class="project-list-container">
            @forelse ($projects as $project)
                @include('partials.project-card', ['project' => $project])
            @empty
                @include('partials.empty-message', ['message' =>  __('project-card.empty-message')])
            @endforelse
        </div>
    </div>

@endsection
