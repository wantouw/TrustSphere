@extends('layouts.main-layout')


@section('title', 'Search')

@section('content')
    <div>
        <p>{{__('search.title')}} {{$search_query}}</p>
        <div>
            @forelse ($projects as $project)
                <p>{{$project->title}}</p>
            @empty
                <p>{{__('search.no_result')}}</p>
            @endforelse
        </div>
    </div>
@endsection
