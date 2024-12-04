@extends('layouts.form-layout')

@section('title', 'Register To TrustSphere')

@section('content')
    <div class="content">
        <section class="form-container">
            <h1 class="content-header">TrustSphere.</h1>
            <form class="form-section" action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h2 class="form-header">Register Now</h2>
                <div class="form-group">
                    <label class="input-label" for="fullName">Full Name</label>
                    <div class="input-wrapper">
                        <i class="fa-regular fa-user icon"></i>
                        <input class="input-field" type="text" id="fullName" name="name"
                            placeholder="Enter Full Name" value="{{ old('name') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="input-label" for="email">Email</label>
                    <div class="input-wrapper">
                        <i class="fa-regular fa-envelope icon"></i>
                        <input class="input-field" type="email" id="email" name="email" placeholder="Enter Email"
                            value="{{ old('email') }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="input-label" for="password">Password</label>
                        <div class="input-wrapper">
                            <i class="fa-solid fa-lock icon"></i>
                            <input class="input-field" type="password" id="password" name="password"
                                placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="input-label" for="password_confirmation">Confirm Password</label>
                        <div class="input-wrapper">
                            <i class="fa-solid fa-check icon"></i>
                            <input class="input-field" type="password" id="password_confirmation"
                                name="password_confirmation" placeholder="Confirm Password">
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="input-label" for="dob">Date Of Birth</label>
                        <div class="input-wrapper">
                            <i class="fa-regular fa-calendar icon"></i>
                            <input class="input-field" type="date" id="dob" name="dob"
                                value="{{ old('dob') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="input-label" for="profile_picture">Profile Picture</label>
                        <div class="input-wrapper">
                            <input class="input-field" type="file" id="profile_picture" name="profile_picture">
                        </div>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="error-message">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <button class="submit-button" type="submit">Register</button>

                <div class="divider">
                    <span>Or</span>
                </div>

                <button class="register-button" type="button" onclick="window.location.href='{{ route('login') }}'">Sign
                    In</button>
            </form>
        </section>

        <section class="promotion-container">
            <p class="promo-header">Connecting ideas with opportunities, turning visions into reality.</p>
            <div class="promo-achievements">
                <div class="achievement">
                    <h3 class="achievement-value">100+</h3>
                    <p class="achievement-label">Projects Funded</p>
                </div>
                <div class="separator">|</div>
                <div class="achievement">
                    <h3 class="achievement-value">$50,000+</h3>
                    <p class="achievement-label">Funded to Projects</p>
                </div>
            </div>
        </section>
    </div>
@endsection
