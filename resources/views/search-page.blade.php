@extends('layouts.main-layout')


@section('title', 'Search')

@section('content')
    <div>
        <p>Showing results for {{$search_query}}</p>
        <div>
            @forelse ($projects as $project)
                <p>{{$project->title}}</p>
            @empty
                <p>No project matched</p>
            @endforelse
        </div>
    </div>
@endsection
