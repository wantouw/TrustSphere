@extends('layouts.main-layout')


@section('title', 'Project Details')
@section('css-link')
    <link rel="stylesheet" href={{ asset('css/project-detail.css') }}>
@endsection
@section('content')
    <div class="project-detail-wrapper">
        <div class="detail-container">
            <div class="owner-container">
                <img class="owner-picture"
                    src="{{ asset('storage/' . $project->user->profile_picture) }}"
                    alt="Profile Picture">
                <div>
                    <p class="owner-name">{{ $project->user->name }}</p>
                    <p class="owner-role">Software Engineer</p>
                </div>
            </div>
            <div id="imageCarousel" class="carousel slide" data-bs-ride="carousel">
                @if (Auth::check())
                    <form  action="{{ route('like_project') }}" method="POST">
                        @csrf
                        <button type="submit" class="like-btn-container">

                            <input type="hidden" value="{{ $project->id }}" name="project_id">

                            <img class="{{ $is_liked ? 'liked' : '' }}" src="{{asset('images/Heart.png')}}" alt="liked">

                        </button>
                    </form>
                @endif
                <div class="carousel-inner">
                    @foreach ($project->image_urls as $index => $img)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <img class="project-picture" src="{{ asset('storage/' . $img->image_url) }}"
                                alt="{{ $img->image_url . '_image' }}">
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
            <h4 class="project-title">{{ $project->title }}</h4>
            @php
                $vote =
                    Auth::check() && Auth::user()->project_votes
                        ? Auth::user()->project_votes->firstWhere('id', $project->id)
                        : null;
                $vote_type = $vote ? $vote->pivot->type : '';
            @endphp
            <div class="category-stats-wrapper">
                <div class="project-category-wrapper">
                    @foreach ($project->categories as $category)
                        <div class="category-wrapper">
                            <p>{{$category->name}}</p>
                        </div>
                    @endforeach
                </div>
                <div action="{{ route('vote') }}" method="POST" class="project-stats-container">
                    <p>{{ $project->project_views->count() }} views</p>
                    <p>{{ $project->user_likes->count() }} likes</p>
                </div>
            </div>
            @if (!$reliable)
                <div class="negative-project-confirmation-container">
                    <div class="esclamation-text-container">
                        <svg class="warning-icon w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 13V8m0 8h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <p>This project has low reliability</p>

                    </div>
                    <form action="{{ route('vote') }}" method="POST" class="vote-container">
                        @csrf
                        <span class="pr-3">Do you agree ?</span>
                        <input type="hidden" name="project_id" value="{{ $project->id }}">
                        <button type="submit" name="vote" value="positive"
                            class="vote-type-container positive-container">
                            @if ($vote_type == 'positive')
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M15.03 9.684h3.965c.322 0 .64.08.925.232.286.153.532.374.717.645a2.109 2.109 0 0 1 .242 1.883l-2.36 7.201c-.288.814-.48 1.355-1.884 1.355-2.072 0-4.276-.677-6.157-1.256-.472-.145-.924-.284-1.348-.404h-.115V9.478a25.485 25.485 0 0 0 4.238-5.514 1.8 1.8 0 0 1 .901-.83 1.74 1.74 0 0 1 1.21-.048c.396.13.736.397.96.757.225.36.32.788.269 1.211l-1.562 4.63ZM4.177 10H7v8a2 2 0 1 1-4 0v-6.823C3 10.527 3.527 10 4.176 10Z"
                                        clip-rule="evenodd" />
                                </svg>
                            @else
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M7 11c.889-.086 1.416-.543 2.156-1.057a22.323 22.323 0 0 0 3.958-5.084 1.6 1.6 0 0 1 .582-.628 1.549 1.549 0 0 1 1.466-.087c.205.095.388.233.537.406a1.64 1.64 0 0 1 .384 1.279l-1.388 4.114M7 11H4v6.5A1.5 1.5 0 0 0 5.5 19v0A1.5 1.5 0 0 0 7 17.5V11Zm6.5-1h4.915c.286 0 .372.014.626.15.254.135.472.332.637.572a1.874 1.874 0 0 1 .215 1.673l-2.098 6.4C17.538 19.52 17.368 20 16.12 20c-2.303 0-4.79-.943-6.67-1.475" />
                                </svg>
                            @endif
                        </button>
                        <div class="divider"></div>
                        <button type="submit" name="vote" value="negative"
                            class="vote-type-container negative-container">
                            @if ($vote_type == 'negative')
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M8.97 14.316H5.004c-.322 0-.64-.08-.925-.232a2.022 2.022 0 0 1-.717-.645 2.108 2.108 0 0 1-.242-1.883l2.36-7.201C5.769 3.54 5.96 3 7.365 3c2.072 0 4.276.678 6.156 1.256.473.145.925.284 1.35.404h.114v9.862a25.485 25.485 0 0 0-4.238 5.514c-.197.376-.516.67-.901.83a1.74 1.74 0 0 1-1.21.048 1.79 1.79 0 0 1-.96-.757 1.867 1.867 0 0 1-.269-1.211l1.562-4.63ZM19.822 14H17V6a2 2 0 1 1 4 0v6.823c0 .65-.527 1.177-1.177 1.177Z"
                                        clip-rule="evenodd" />
                                </svg>
                            @else
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M17 13c-.889.086-1.416.543-2.156 1.057a22.322 22.322 0 0 0-3.958 5.084 1.6 1.6 0 0 1-.582.628 1.549 1.549 0 0 1-1.466.087 1.587 1.587 0 0 1-.537-.406 1.666 1.666 0 0 1-.384-1.279l1.389-4.114M17 13h3V6.5A1.5 1.5 0 0 0 18.5 5v0A1.5 1.5 0 0 0 17 6.5V13Zm-6.5 1H5.585c-.286 0-.372-.014-.626-.15a1.797 1.797 0 0 1-.637-.572 1.873 1.873 0 0 1-.215-1.673l2.098-6.4C6.462 4.48 6.632 4 7.88 4c2.302 0 4.79.943 6.67 1.475" />
                                </svg>
                            @endif
                        </button>

                    </form>
                </div>

            @endif
            <div class="description-container">
                <h4 class="project-title" style="margin-bottom:1vh">Project Overview</h4>
                <p class="project-description">{{ $project->description }}</p>
            </div>
        </div>

        <div class="right-container">
            <div class="comment-container">
                <div>
                    <h5>Comments</h5>
                    <div class="comment-list-wrapper">
                        @forelse ($project->comments as $comment)
                            <div class="comment-wrapper">
                                <div class="sender-container">
                                    <div class="sender-wrapper">
                                        <img class="sender-picture"
                                            src="{{ asset('storage/' . $project->user->profile_picture) }}"
                                            alt="Profile Picture">
                                        <p class="sender-name">{{ $comment->sender->name }}</p>
                                    </div>
                                    @if ($comment->sender_id == auth()->id())
                                        <form action="{{ route('delete_comment', ['project_id' => $project->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">
                                                <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="none" viewBox="0 0 24 24" style="color: gray !important">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                                </svg>

                                            </button>
                                        </form>
                                    @endif
                                </div>
                                <p class="comment-description">{{ $comment->comment }}</p>
                            </div>

                        @empty
                            <p style="font-size: 15px !important">No comments yet.</p>
                        @endforelse
                    </div>
                </div>


                @if (auth()->check())
                    <form action="{{ route('create_comment') }}" method="POST" class="add-comment-container">
                        @csrf
                        <div class="comment-input-container">
                            <div class="form-group">
                                <div class="input-wrapper">

                                    <input class="input-field" type="text" id="text" name="comment"
                                        placeholder="Enter comment" value="{{ old('comment') }}">
                                </div>
                            </div>
                            <button type="submit" class="btn-primary add-comment-btn">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
                                </svg>

                            </button>
                        </div>
                        <input type="hidden" name="project_id" value="{{ $project->id }}">
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
