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
            <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#imageCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div>
            <p>{{ $project->description }}</p>
        </div>

        <form action="{{ route('create_comment') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="comment">Comment</label>
                <input type="text" class="form-control" id="comment" aria-describedby="comment" name="comment"
                    placeholder="Enter comment" value="{{ old('comment') }}">
            </div>
            <input type="hidden" name="project_id" value="{{ $project->id }}">
            <button type="submit">Add Comment</button>
        </form>

        <div>
            @foreach ($project->comments as $comment)
                <p>{{ $comment->comment }} - {{ $comment->type }} - {{ $comment->sender->name }} </p>
                @if ($comment->sender_id == auth()->id())
                    <form action="{{ route('delete_comment', ['project_id' => $project->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete Comment</button>
                    </form>
                @endif
            @endforeach
            {{-- Bikin snackbar kali --}}
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>
        @php
            $vote = Auth::user()->project_votes->firstWhere('id', $project->id);
        @endphp
        @if (auth()->check())
            @if (!$vote)
                <p>Belum Vote</p>
            @else
                <p>{{ $vote->pivot->type }}</p>
            @endif
            <div>
                <form action="{{ route('vote') }}" method="POST">


                    @csrf
                    <input type="hidden" name="project_id" value="{{ $project->id }}">
                    <button type="submit" name="vote" value="positive" class="btn btn-success">Upvote</button>
                    <button type="submit" name="vote" value="negative" class="btn btn-danger">Downvote</button>
                </form>
            </div>
        @endif
    </div>
@endsection
