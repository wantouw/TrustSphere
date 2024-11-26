@extends('layouts.main-layout')


@section('title', 'Project Details')

@section('content')
    <div style="height: fit-content">
        <h3>{{ $project->title }}</h3>
        <div id="imageCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($project->image_urls as $index => $img)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        <img src="{{ asset('storage/' . $img->image_url) }}" alt="{{ $img->image_url . '_image' }}"
                            style="height: 500px;width:100%;object-fit: cover">
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#imageCarousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div>
            <p>{{ $project->description }}</p>
        </div>

        
    </div>
@endsection
