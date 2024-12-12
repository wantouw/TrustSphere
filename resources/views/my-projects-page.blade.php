@extends('layouts.main-layout')


@section('title', 'Search')

@section('css-link')
    <link rel="stylesheet" href="{{asset("css/my-projects.css")}}">
    <link rel="stylesheet" href="{{asset("css/project-card.css")}}">
@endsection

@section('content')
    <div class="left-container">
        <h1 class="page-title">{{__('my-projects.header')}}</h1>
        <div class="project-list">
            @forelse ($projects as $project)
                @include('partials.project-card', ['project' => $project])
            @empty
                @include('partials.empty-message', ['message' => 'No projects yet'])
            @endforelse
        </div>
        <div style="display: flex;justify-content: center">
            {{ $projects->links('pagination::bootstrap-4') }}

        </div>
    </div>
@endsection
