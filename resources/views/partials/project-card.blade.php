@php
    use App\Models\UserLike;
    $is_liked = false;
    if(Auth::check()) {
        $is_liked = UserLike::where('project_id', $project->id)->where('user_id', Auth::id())->exists();
    }

@endphp
<a href="{{route('project_detail_page', ['project_id' => $project->id])}}" class="project-card">

    <div class="project-img-container">
        <img src="{{asset('storage/' . $project->image_urls[0]->image_url)}}" alt="">
    </div>
    <div class="project-information-container">
        <div class="upper-container">
            <h4 class="project-title">{{$project->title}}</h4>
            <div class="project-category-wrapper">
                @foreach ($project->categories as $category)
                    <div class="category-wrapper">
                        <p>{{$category->name}}</p>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="bottom-information-container">
            <div>
                <div class="project-owner">
                    <img class="project-owner-picture"
                    src="{{ asset('storage/' . $project->user->profile_picture) }}"
                    alt="Owner Project Picture">
                    <div class="owner-timestamp-wrapper">
                        <div class="owner-name-wrapper">
                            <p class="project-owner-name">{{ $project->user->name }}</p>
                            <span class="circle"></span>

                        </div>
                        <p class="project-timestamp">{{ \Carbon\Carbon::parse($project->timestamp)->diffForHumans() }}</p>
                    </div>
                </div>
            </div>
            <div class="project-stats-information-container">
                <span>{{ $project->project_views->count() }} views</span>
                <span>{{ $project->user_likes->count() }} likes</span>
                <span>{{ $project->comments->count() }} comments</span>
            </div>

        </div>
    </div>
    @if (Auth::check())
    <form  action="{{ route('like_project') }}" method="POST">
        @csrf
        <button type="submit" class="like-btn-container">

            <input type="hidden" value="{{ $project->id }}" name="project_id">
            <img class="{{ $is_liked ? 'liked' : '' }}" src="{{asset('images/Heart.png')}}" alt="liked">
        </button>
    </form>
    @endif
</a>
