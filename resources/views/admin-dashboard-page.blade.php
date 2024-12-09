@extends('layouts.main-layout')


@section('title', 'Home')

@section('css-link')
<link rel="stylesheet" href={{ asset('css/admin-dashboard.css') }}>

@endsection

@section('content')
    <div class="left-container">
        <h5>Project Lists</h5>
    </div>

@endsection
