@extends('layouts.main-layout')

@section('title', 'Edit Profile')
@section('css-link')
    <link rel="stylesheet" href="{{ asset('css/my-profile-page.css') }}">
@endsection

@section('content')
    <div class="reset-container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="top-section">
            <div class="profile-image-container">
                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture">
            </div>
            <div class="profile-info">
                <h1 class="header-name">{{ $user->name }}</h1>
                <h3 class="header-role">{{ $user->email }}</h3>
            </div>
        </div>
        <div class="profile-section">
            <div class="header-profile">
                <h1 class="profile-header">Your Profile</h1>
                <p class="profile-subheader">Update your profile information here.</p>
            </div>
            <div class="divider"></div>
            <form class="form-container" action="{{ route('update_profile') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="profile-form-group">
                    <div class="group-header-section">
                        <h3 class="group-header">Public Profile</h3>
                        <p class="group-subheader">This information will be displayed publicly.</p>
                    </div>
                    <div class="group-form-section">
                        <div class="profile-input-wrapper">
                            <i class="fa-regular fa-user icon"></i>
                            <input class="input-field" type="text" id="username" name="name" value="{{ old('name', $user->name) }}" placeholder="Enter your full name">
                        </div>
                        <div class="profile-input-wrapper">
                            <i class="fa-regular fa-envelope icon"></i>
                            <input class="input-field" type="email" id="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Enter your email">
                        </div>
                    </div>
                </div>
                <div class="divider"></div>

                <div class="profile-form-group">
                    <div class="group-header-section">
                        <h3 class="group-header">Profile Picture</h3>
                        <p class="group-subheader">Update your profile picture to personalize your profile and make it more engaging.</p>
                    </div>
                    <div class="group-form-section">
                        <div class="profile-image-container preview-container">
                            <img id="profile-picture-preview" src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture Preview">
                        </div>
                        <div class="upload-field">
                            <label for="profile-picture" class="upload-label">
                                <i class="fa-regular fa-image icon"></i>
                                <span>Upload New Profile Picture</span>
                            </label>
                            <input class="input-field" type="file" id="profile-picture" name="profile_picture" accept="image/*" onchange="previewProfilePicture(event)">
                        </div>
                    </div>
                </div>
                <div class="divider"></div>

                <div class="profile-form-group">
                    <div class="group-header-section">
                        <h3 class="group-header">Biography</h3>
                        <p class="group-subheader">Share a brief introduction to let others know more about you.</p>
                    </div>
                    <div class="group-form-section">
                        <div class="profile-input-wrapper biography-input-wrapper">
                            <textarea class="input-field biography-field" id="biography" name="bio" rows="4" placeholder="Write a short biography here...">{{ old('bio', $user->bio) }}</textarea>
                        </div>
                    </div>
                </div>
                <button class="submit-button">Save Changes</button>
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
