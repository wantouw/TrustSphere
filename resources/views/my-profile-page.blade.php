@extends('layouts.main-layout')

@section('title', __('my-profile.edit_profile'))
@section('css-link')
    <link rel="stylesheet" href="{{ asset('css/my-profile-page.css') }}">
@endsection

@section('content')
    <div class="reset-container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ __('my-profile.profile_updated') }}
            </div>
        @endif
        <div class="top-section">
            <div class="profile-image-container">
                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture">
            </div>
            <div class="profile-info" style="display: flex; flex-direction: column; gap: 5px; flex-grow: 1;">
                <h1 class="header-name">{{ $user->name }}</h1>
                <h3 class="header-role">{{ $user->role->name }}</h3>
                <h3 class="header-email">{{ $user->email }}</h3>
                <p class="header-bio">{{ $user->bio }}</p>
            </div>
        </div>
        <div class="profile-section">
            <div class="header-profile">
                <h1 class="profile-header">{{ __('my-profile.your_profile') }}</h1>
                <p class="profile-subheader">{{ __('my-profile.update_profile_info') }}</p>
            </div>
            <div class="divider"></div>
            <form class="form-container" style="margin: 0" action="{{ route('update_profile') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="profile-form-group">
                    <div class="group-header-section">
                        <h3 class="group-header">{{ __('my-profile.public_profile') }}</h3>
                        <p class="group-subheader">{{ __('my-profile.public_profile_description') }}</p>
                    </div>
                    <div class="group-form-section">
                        <div class="profile-input-wrapper">
                            <i class="fa-regular fa-user icon"></i>
                            <input class="input-field" type="text" id="username" name="name" value="{{ old('name', $user->name) }}" placeholder="{{ __('my-profile.name_placeholder') }}">
                        </div>
                        <div class="profile-input-wrapper">
                            <i class="fa-regular fa-envelope icon"></i>
                            <input class="input-field" type="email" id="email" name="email" value="{{ old('email', $user->email) }}" placeholder="{{ __('my-profile.email_placeholder') }}">
                        </div>
                    </div>
                </div>
                <div class="divider"></div>

                <div class="profile-form-group">
                    <div class="group-header-section">
                        <h3 class="group-header">{{ __('my-profile.profile_picture') }}</h3>
                        <p class="group-subheader">{{ __('my-profile.profile_picture_description') }}</p>
                    </div>
                    <div class="group-form-section">
                        <div class="profile-image-container preview-container">
                            <img id="profile-picture-preview" src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture Preview">
                        </div>
                        <div class="upload-field">
                            <label for="profile-picture" class="upload-label">
                                <i class="fa-regular fa-image icon"></i>
                                <span>{{ __('my-profile.profile_picture') }}</span>
                            </label>
                            <input class="input-field" type="file" id="profile-picture" name="profile_picture" accept="image/*" onchange="previewProfilePicture(event)">
                        </div>
                    </div>
                </div>
                <div class="divider"></div>

                <div class="profile-form-group">
                    <div class="group-header-section">
                        <h3 class="group-header">{{ __('my-profile.biography') }}</h3>
                        <p class="group-subheader">{{ __('my-profile.biography_description') }}</p>
                    </div>
                    <div class="group-form-section">
                        <div class="profile-input-wrapper biography-input-wrapper">
                            <textarea class="input-field biography-field" id="biography" name="bio" rows="4" placeholder="{{ __('my-profile.bio_placeholder') }}">{{ old('bio', $user->bio) }}</textarea>
                        </div>
                    </div>
                </div>
                <button class="submit-button">{{ __('my-profile.save_changes') }}</button>
            </form>
        </div>
    </div>
@endsection

@section('side-content')
@endsection


@section('scripts')
    <script>
        function previewProfilePicture(event) {
            const preview = document.getElementById('profile-picture-preview');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
