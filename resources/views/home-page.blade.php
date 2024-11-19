@extends('layouts.main-layout')


@section('title', 'Home')

@section('content')
    <div>

        <img src="{{ asset('storage/images/profile_pictures/' . Auth::user()->profile_picture) }}" alt="Profile Picture">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>
@endsection
