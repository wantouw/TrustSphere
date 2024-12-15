@extends('layouts.main-layout')


@section('title', 'Project Details')
@section('css-link')
    <link rel="stylesheet" href={{ asset('css/project-detail.css') }}>
@endsection
@section('content')
    <div class="project-detail-wrapper left-container">
        <div class="detail-container">
            <div class="owner-wrapper">
                <div class="owner-container">
                    <img class="owner-picture" src="{{ asset('storage/' . $project->user->profile_picture) }}"
                        alt="Profile Picture">
                    <a href="{{ route('user_profile_page', ['user_id' => $project->user->id]) }}">
                        <p class="owner-name">{{ $project->user->name }}</p>
                        <p class="owner-role">{{ Str::ucfirst($project->user->role->name) }}</p>
                    </a>
                </div>
                @if (Auth::user()->hasRole('admin'))
                    <form class="delete-btn-container" method="POST"
                        action="{{ route('delete_project', ['project_id' => $project->id]) }}">
                        @method('DELETE')
                        @csrf
                        <button type="submit">
                            <svg style="color: red !important" class="w-5 h-5 text-gray-800 dark:text-white"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                fill="none" viewBox="0 0 24 24" style="color: gray !important">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                            </svg>
                        </button>
                    </form>
                @else
                    @if ($is_liked)
                        <a href="https://api.whatsapp.com/send?phone={{ $project->user->phone_number }}"
                            class="whatsapp-btn">
                            Contact
                            <svg class="svgIcon" fill="#000000" height="800px" width="800px" version="1.1" id="Layer_1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                viewBox="0 0 308 308" xml:space="preserve">
                                <g id="XMLID_468_">
                                    <path id="XMLID_469_" d="M227.904,176.981c-0.6-0.288-23.054-11.345-27.044-12.781c-1.629-0.585-3.374-1.156-5.23-1.156
                               c-3.032,0-5.579,1.511-7.563,4.479c-2.243,3.334-9.033,11.271-11.131,13.642c-0.274,0.313-0.648,0.687-0.872,0.687
                               c-0.201,0-3.676-1.431-4.728-1.888c-24.087-10.463-42.37-35.624-44.877-39.867c-0.358-0.61-0.373-0.887-0.376-0.887
                               c0.088-0.323,0.898-1.135,1.316-1.554c1.223-1.21,2.548-2.805,3.83-4.348c0.607-0.731,1.215-1.463,1.812-2.153
                               c1.86-2.164,2.688-3.844,3.648-5.79l0.503-1.011c2.344-4.657,0.342-8.587-0.305-9.856c-0.531-1.062-10.012-23.944-11.02-26.348
                               c-2.424-5.801-5.627-8.502-10.078-8.502c-0.413,0,0,0-1.732,0.073c-2.109,0.089-13.594,1.601-18.672,4.802
                               c-5.385,3.395-14.495,14.217-14.495,33.249c0,17.129,10.87,33.302,15.537,39.453c0.116,0.155,0.329,0.47,0.638,0.922
                               c17.873,26.102,40.154,45.446,62.741,54.469c21.745,8.686,32.042,9.69,37.896,9.69c0.001,0,0.001,0,0.001,0
                               c2.46,0,4.429-0.193,6.166-0.364l1.102-0.105c7.512-0.666,24.02-9.22,27.775-19.655c2.958-8.219,3.738-17.199,1.77-20.458
                               C233.168,179.508,230.845,178.393,227.904,176.981z" />
                                    <path id="XMLID_470_" d="M156.734,0C73.318,0,5.454,67.354,5.454,150.143c0,26.777,7.166,52.988,20.741,75.928L0.212,302.716
                               c-0.484,1.429-0.124,3.009,0.933,4.085C1.908,307.58,2.943,308,4,308c0.405,0,0.813-0.061,1.211-0.188l79.92-25.396
                               c21.87,11.685,46.588,17.853,71.604,17.853C240.143,300.27,308,232.923,308,150.143C308,67.354,240.143,0,156.734,0z
                                M156.734,268.994c-23.539,0-46.338-6.797-65.936-19.657c-0.659-0.433-1.424-0.655-2.194-0.655c-0.407,0-0.815,0.062-1.212,0.188
                               l-40.035,12.726l12.924-38.129c0.418-1.234,0.209-2.595-0.561-3.647c-14.924-20.392-22.813-44.485-22.813-69.677
                               c0-65.543,53.754-118.867,119.826-118.867c66.064,0,119.812,53.324,119.812,118.867
                               C276.546,215.678,222.799,268.994,156.734,268.994z" />
                                </g>
                            </svg> </a>
                    @endif
                @endif
            </div>
            <div id="imageCarousel" class="carousel slide" data-bs-ride="carousel">
                @if (Auth::check() && Auth::user()->role->name!='admin')
                    <form action="{{ route('like_project') }}" method="POST">
                        @csrf
                        <button type="submit" class="like-btn-container">

                            <input type="hidden" value="{{ $project->id }}" name="project_id">

                            <img class="{{ $is_liked ? 'liked' : '' }}" src="{{ asset('images/Heart.png') }}"
                                alt="liked">

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
                            <p>{{ $category->name }}</p>
                        </div>
                    @endforeach
                </div>
                <div action="{{ route('vote') }}" method="POST" class="project-stats-container">
                    @if (Auth::user()->hasRole('admin'))
                        @php
                            $downvote = $project->votes()->wherePivot('type', 'negative')->count();
                            $upvote = $project->votes()->wherePivot('type', 'positive')->count();
                        @endphp

                        <div class="admin-vote-container">
                            <div class="admin-vote-wrapper">
                                <p>{{$upvote}}</p>
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M7 11c.889-.086 1.416-.543 2.156-1.057a22.323 22.323 0 0 0 3.958-5.084 1.6 1.6 0 0 1 .582-.628 1.549 1.549 0 0 1 1.466-.087c.205.095.388.233.537.406a1.64 1.64 0 0 1 .384 1.279l-1.388 4.114M7 11H4v6.5A1.5 1.5 0 0 0 5.5 19v0A1.5 1.5 0 0 0 7 17.5V11Zm6.5-1h4.915c.286 0 .372.014.626.15.254.135.472.332.637.572a1.874 1.874 0 0 1 .215 1.673l-2.098 6.4C17.538 19.52 17.368 20 16.12 20c-2.303 0-4.79-.943-6.67-1.475" />
                            </svg>

                            </div>
                            <div class="admin-vote-wrapper">
                                <p>{{$downvote}}</p>
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M17 13c-.889.086-1.416.543-2.156 1.057a22.322 22.322 0 0 0-3.958 5.084 1.6 1.6 0 0 1-.582.628 1.549 1.549 0 0 1-1.466.087 1.587 1.587 0 0 1-.537-.406 1.666 1.666 0 0 1-.384-1.279l1.389-4.114M17 13h3V6.5A1.5 1.5 0 0 0 18.5 5v0A1.5 1.5 0 0 0 17 6.5V13Zm-6.5 1H5.585c-.286 0-.372-.014-.626-.15a1.797 1.797 0 0 1-.637-.572 1.873 1.873 0 0 1-.215-1.673l2.098-6.4C6.462 4.48 6.632 4 7.88 4c2.302 0 4.79.943 6.67 1.475" />
                                    </svg>
                            </div>

                        </div>
                    @endif
                    <p>{{ $project->project_views->count() }} {{ __('project-detail.views') }}</p>
                    <p>{{ $project->user_likes->count() }} {{ __('project-detail.likes') }}</p>

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
                        <p>{{ __('project-detail.low-reliability') }}</p>

                    </div>
                    @if (!Auth::user()->hasRole('admin'))
                        <form action="{{ route('vote') }}" method="POST" class="vote-container">
                            @csrf
                            <span class="pr-3">{{ __('project-detail.agree-text') }}</span>
                            <input type="hidden" name="project_id" value="{{ $project->id }}">
                            <button type="submit" name="vote" value="positive"
                                class="vote-type-container positive-container">
                                @if ($vote_type == 'positive')
                                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" viewBox="0 0 24 24">
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
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" viewBox="0 0 24 24">
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
                        @else
                    @endif
                </div>

            @endif
            <div class="description-container">
                <h4 class="project-title" style="margin-bottom:1vh">{{ __('project-detail.overview-header') }}</h4>
                <p class="project-description">{{ $project->description }}</p>
            </div>
        </div>
    </div>
@endsection

@section('side-content')
    <div class="right-container">
        <div class="comment-container">
            <div>
                <h5>{{ __('project-detail.comments') }}</h5>
                <div class="comment-list-wrapper">
                    @forelse ($project->comments as $comment)
                        <div class="comment-wrapper">
                            <div class="sender-container">
                                <div class="sender-wrapper">
                                    <img class="sender-picture"
                                        src="{{ asset('storage/' . $comment->sender->profile_picture) }}"
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
                        <p style="font-size: 15px !important">{{ __('project-detail.empty-comment') }}.</p>
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
                                    placeholder="{{ __('project-detail.comment-placeholder') }}"
                                    value="{{ old('comment') }}">
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
@endsection
