@extends('layouts.main-layout')


@section('title', 'Login To TrustSphere')

@section('content')
    <div>
        <form action="{{ route('register')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="fullName">Full Name</label>
              <input type="text" class="form-control" id="fullName" aria-describedby="fullName" name="name" placeholder="Enter Full Name" value="{{ old('name') }}">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" aria-describedby="email" name="email" placeholder="Enter Email" value="{{ old('email') }}">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" >
              </div>
              <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" >
            </div>
            <div class="form-group">
                <label for="dob">Date Of Birth</label>
                <input id="dob" class="form-control" type="date" name="dob" value="{{ old('dob') }}"/>
            </div>
            
            <div class="mb-3">
                <label for="profile_picture" class="form-label">Profile Picture</label>
                <input class="form-control" type="file" id="profile_picture" name="profile_picture">
              </div>
            <button type="submit" class="btn btn-primary">Register</button>

          </form>
          @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endsection
