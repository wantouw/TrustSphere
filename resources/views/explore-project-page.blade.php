@extends('layouts.main-layout')


@section('title', 'Explore')

@section('css-link')
    <link rel="stylesheet" href={{ asset('css/app.css') }}>
    <link rel="stylesheet" href={{ asset('css/project-card.css') }}>
    <link rel="stylesheet" href={{ asset('css/home.css') }}>
@endsection

@section('content')
    <div class="left-container">
        @include('partials.search-bar')

        <div class="project-list-container">
            @forelse ($projects as $project)
                @include('partials.project-card', ['project' => $project])
            @empty
                @include('partials.empty-message', ['message' => __('project-card.empty-message')])
            @endforelse
        </div>
    </div>
    <div class="filter-container">
        <div class="filter-section">
            <div class="filter-header-section">
                <h1 class="filter-header">{{ __('search.filter_title') }}</h1>
                <i class="fa-solid fa-arrow-right"></i>
            </div>
            <div class="filter-wrapper">
                <h3 class="filter-title">{{ __('search.category_title') }}</h3>
                <div class="categories-container">
                    @foreach ($categories as $category)
                        <div class="filter {{ in_array($category->id, $selectedCategories ?? []) ? 'selected' : '' }}"
                            data-category-id="{{ $category->id }}">
                            {{ $category->name }}
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="filter-wrapper">
                <h3 class="filter-title">{{ __('search.status_title') }}</h3>
                <div class="categories-container">
                    <div class="filter status-filter {{ request()->get('is_safe') === 'true' ? 'selected' : '' }}"
                        data-status="true">
                        {{ __('search.status.safe') }}
                    </div>
                    <div class="filter status-filter {{ request()->get('is_safe') === 'false' ? 'selected' : '' }}"
                        data-status="false">
                        {{ __('search.status.under_review') }}
                    </div>
                </div>
            </div>
        </div>
        <div class="filter-section">
            <div class="filter-header-section">
                <h1 class="filter-header">{{ __('search.sort_title') }}</h1>
                <i class="fa-solid fa-sort"></i>
            </div>
            <div class="sort-wrapper">
                <div class="sort-options">
                    <label class="sort-option">
                        {{ __('search.sort.relevance') }}
                        <input type="radio" name="sort" value="relevance" checked>
                    </label>
                    <label class="sort-option">
                        {{ __('search.sort.popularity') }}
                        <input type="radio" name="sort" value="popularity">
                    </label>
                    <label class="sort-option">
                        {{ __('search.sort.most_liked') }}
                        <input type="radio" name="sort" value="most-liked">
                    </label>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('side-content')

@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const categoryFilters = document.querySelectorAll('.filter[data-category-id]');
            const statusFilters = document.querySelectorAll('.status-filter');

            categoryFilters.forEach(filter => {
                filter.addEventListener('click', () => {
                    const categoryId = filter.dataset.categoryId;
                    const urlParams = new URLSearchParams(window.location.search);
                    let selectedCategories = urlParams.get('categories');

                    selectedCategories = selectedCategories ? selectedCategories.split(',') : [];

                    if (selectedCategories.includes(categoryId)) {
                        selectedCategories = selectedCategories.filter(id => id !== categoryId);
                        filter.classList.remove('selected');
                    } else {
                        selectedCategories.push(categoryId);
                        filter.classList.add('selected');
                    }

                    if (selectedCategories.length > 0) {
                        urlParams.set('categories', selectedCategories.join(','));
                    } else {
                        urlParams.delete(
                        'categories');
                    }

                    window.location.search = urlParams.toString();
                });
            });

            // Handle Status Filters (Toggle Group)
            statusFilters.forEach(filter => {
                filter.addEventListener('click', () => {
                    const statusValue = filter.dataset.status;
                    const urlParams = new URLSearchParams(window.location.search);

                    // Toggle selection
                    if (filter.classList.contains('selected')) {
                        filter.classList.remove('selected');
                        urlParams.delete('is_safe'); // Remove query if deselected
                    } else {
                        // Unselect other filters
                        statusFilters.forEach(f => f.classList.remove('selected'));

                        // Select the clicked filter
                        filter.classList.add('selected');
                        urlParams.set('is_safe', statusValue); // Set query param
                    }

                    // Reload the page with updated query parameters
                    window.location.search = urlParams.toString();
                });
            });
        });
    </script>
@endsection
