<div class="search-container">
    <div>
        <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" class="search-pp" alt="">
    </div>
    <form id="searchForm" class="form-inline" action="{{ route('explore_project_page') }}" method="GET">
        <div class="input-wrapper">
            <i class="fa-solid fa-search icon"></i>
            <input class="input-field" type="text" id="search-query" name="search"
                value="{{ $searchQuery ?? '' }}" placeholder="Search for interesting projects!">
        </div>
    </form>
    <a class="btn btn-primary create-post-btn" href="javascript:void(0);" onclick="document.getElementById('searchForm').submit();">
        Search
    </a>
</div>
