@php
    use App\Models\UserLike;
    $is_liked = false;
    if (Auth::check()) {
        $is_liked = UserLike::where('project_id', $project->id)
            ->where('user_id', Auth::id())
            ->exists();
    }

@endphp
<a href="{{ route('project_detail_page', ['project_id' => $project->id]) }}" class="project-card">

    <div class="project-img-container">
        <img src="{{ asset('storage/' . $project->image_urls[0]->image_url) }}" alt="">
    </div>
    <div class="project-information-container">
        <div class="upper-container">
            <h4 class="project-title">{{ $project->title }}</h4>
            <div class="project-category-wrapper">
                @foreach ($project->categories as $category)
                    <div class="category-wrapper">
                        <p>{{ $category->name }}</p>
                    </div>
                @endforeach
            </div>
        </div>
        @if (!$project->is_safe)
        <div class="esclamation-text-container">
            <svg class="warning-icon w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 13V8m0 8h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            <p>{{ __('project-card.low-reliability') }}</p>
        </div>
        @endif
        <div class="bottom-information-container">
            <div>
                <div class="project-owner">
                    <img class="project-owner-picture" src="{{ asset('storage/' . $project->user->profile_picture) }}"
                        alt="Owner Project Picture">
                    <div class="owner-timestamp-wrapper">
                        <div class="owner-name-wrapper">
                            <p class="project-owner-name">{{ $project->user->name }}</p>
                            <span class="circle"></span>

                        </div>
                        <p class="project-timestamp">{{ \Carbon\Carbon::parse($project->timestamp)->diffForHumans() }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="project-stats-information-container">
                <span>{{ $project->project_views->count() }} {{ __('project-card.views') }}</span>
                <span>{{ $project->user_likes->count() }} {{ __('project-card.likes') }}</span>
                <span>{{ $project->comments->count() }} {{ __('project-card.comments') }}</span>
            </div>

        </div>
    </div>
    @if (Auth::check() && Auth::user()->role->name!='admin')
        <form action="{{ route('like_project') }}" method="POST">
            @csrf
            <button type="submit" class="like-btn-container">

                <input type="hidden" value="{{ $project->id }}" name="project_id">
                <img class="{{ $is_liked ? 'liked' : '' }}" src="{{ asset('images/Heart.png') }}" alt="liked">
            </button>
        </form>
    @endif
</a>
