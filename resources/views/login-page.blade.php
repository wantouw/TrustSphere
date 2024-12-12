@extends('layouts.form-layout')

@section('title', 'Login To TrustSphere')

@section('content')

    <div class="content">
        <section class="form-container">
            <h1 class="content-header">TrustSphere.</h1>
            <form class="form-section" action="{{ route('login') }}" method="POST">
                @csrf
                <h2 class="form-header">{{__('login.sign-in')}}</h2>
                <div class="form-group">
                    <label class="input-label" for="email">Email</label>
                    <div class="input-wrapper">
                        <i class="fa-regular fa-envelope icon"></i>
                        <input class="input-field" type="email" id="email" name="email" placeholder="{{__('login.email-placeholder')}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="input-label" for="password">{{__('login.password-label')}}</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-lock icon"></i>
                        <input class="input-field" type="password" id="password" name="password" placeholder="{{__('login.password-placeholder')}}">
                    </div>
                </div>

                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <button class="submit-button" type="submit">{{__('login.sign-in')}}</button>

                <div class="divider">
                    <span>{{__('login.or')}}</span>
                </div>

                <button class="register-button" type="button"
                    onclick="window.location.href='{{ route('register') }}'">{{__('login.register-redirect')}}</button>
            </form>
        </section>
        <section class="promotion-container">
            <p class="promo-header">{{__('login.promo-header')}}</p>
            <div class="promo-achievements">
                <div class="achievement">
                    <h3 class="achievement-value">100+</h3>
                    <p class="achievement-label">{{__('login.total-projects-label')}}</p>
                </div>
                <div class="separator">|</div>
                <div class="achievement">
                    <h3 class="achievement-value">$50,000+</h3>
                    <p class="achievement-label">{{__('login.projects-label-money')}}</p>
                </div>
            </div>
        </section>
    </div>

@endsection
