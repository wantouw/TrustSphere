<div class="search-container">
    <div>
        <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" class="search-pp" alt="">
    </div>
    <form class="form-inline" action="{{ route('search_project') }}" method="GET">
            <div class="input-wrapper">
                <i class="fa-solid fa-search icon"></i>
                <input class="input-field" type="text" id="search-query" name="search_query" placeholder="Search for interesting projects!">
            </div>
        {{-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> --}}
    </form>
    <a class="btn btn-primary create-post-btn" href="">
        Search
    </a>
</div>
