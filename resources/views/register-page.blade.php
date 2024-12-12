@extends('layouts.form-layout')

@section('title', __('register.register_title'))

@section('content')
    <div class="content">
        <section class="form-container">
            <h1 class="content-header">TrustSphere.</h1>
            <form class="form-section" action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h2 class="form-header">{{ __('register.form_header') }}</h2>
                <div class="form-group">
                    <label class="input-label" for="fullName">{{ __('register.full_name') }}</label>
                    <div class="input-wrapper">
                        <i class="fa-regular fa-user icon"></i>
                        <input class="input-field" type="text" id="fullName" name="name"
                            placeholder="{{ __('register.full_name') }}" value="{{ old('name') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="input-label" for="email">{{ __('register.email') }}</label>
                    <div class="input-wrapper">
                        <i class="fa-regular fa-envelope icon"></i>
                        <input class="input-field" type="email" id="email" name="email" placeholder="{{ __('register.email') }}"
                            value="{{ old('email') }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="input-label" for="password">{{ __('register.password') }}</label>
                        <div class="input-wrapper">
                            <i class="fa-solid fa-lock icon"></i>
                            <input class="input-field" type="password" id="password" name="password"
                                placeholder="{{ __('register.password') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="input-label" for="password_confirmation">{{ __('register.confirm_password') }}</label>
                        <div class="input-wrapper">
                            <i class="fa-solid fa-check icon"></i>
                            <input class="input-field" type="password" id="password_confirmation"
                                name="password_confirmation" placeholder="{{ __('register.confirm_password') }}">
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="input-label" for="dob">{{ __('register.dob') }}</label>
                        <div class="input-wrapper">
                            <i class="fa-regular fa-calendar icon"></i>
                            <input class="input-field" type="date" id="dob" name="dob"
                                value="{{ old('dob') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="input-label" for="profile_picture">{{ __('register.profile_picture') }}</label>
                        <div class="input-wrapper">
                            <input class="input-field" type="file" id="profile_picture" name="profile_picture">
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="input-label" for="phone_number">{{ __('register.phone_number') }}</label>
                        <div class="input-wrapper">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                            </svg>
                            <input class="input-field" type="text" id="phone_number" name="phone_number" placeholder="{{ __('register.phone_number') }}"
                                value="{{ old('phone_number') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="input-label" for="role">{{ __('register.role') }}</label>
                        <div class="input-wrapper">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="icon">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                            </svg>


                            <button class="input-field dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ __('register.select_role') }}
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                @foreach ($roles as $role)
                                    <a class="dropdown-item" href="#" data-value="{{$role->id}}">{{ $role->name }}</a>
                                @endforeach
                            </div>
                            <input type="hidden" name="role_id" id="selectedRole" value="">
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

                <button class="submit-button" type="submit">{{ __('register.submit_button') }}</button>

                <div class="divider">
                    <span>{{ __('register.or') }}</span>
                </div>

                <button class="register-button" type="button" onclick="window.location.href='{{ route('login') }}'">{{ __('register.sign_in') }}</button>
            </form>
        </section>

        <section class="promotion-container">
            <p class="promo-header">{{ __('register.promo_header') }}</p>
            <div class="promo-achievements">
                <div class="achievement">
                    <h3 class="achievement-value">100+</h3>
                    <p class="achievement-label">{{ __('register.projects_funded') }}</p>
                </div>
                <div class="separator">|</div>
                <div class="achievement">
                    <h3 class="achievement-value">$50,000+</h3>
                    <p class="achievement-label">{{ __('register.funded_to_projects') }}</p>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script>
        document.querySelectorAll('.dropdown-item').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                const selectedValue = this.getAttribute('data-value');
                const dropdownToggle = document.getElementById('dropdownMenuButton');
                dropdownToggle.innerText = this.innerText;
                document.getElementById('selectedRole').value = selectedValue;
            });
        });
    </script>

@endsection
