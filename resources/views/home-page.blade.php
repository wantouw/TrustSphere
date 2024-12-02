@extends('layouts.main-layout')


@section('title', 'Home')

@section('content')
    <div>

        <img src="{{ asset('storage/images/profile_pictures/' . Auth::user()->profile_picture) }}" alt="Profile Picture">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
        <form class="form-inline" action="{{route('search_project')}}" method="GET">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search_query">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
@endsection
