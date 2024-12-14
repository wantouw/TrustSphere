@php
        $lang = [
        'en','id'
    ]
@endphp

<div class="btn-group lang-dropdown">
    <a class="" data-bs-toggle="dropdown" aria-haspopup="true">
        <div style="display: flex;gap:5px;align-items: center">
            <p style="color: gray; margin-bottom: 0">{{ App::getLocale() }}</p>
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
            </svg>

        </div>
    </a>
    <div class="dropdown-menu" >
        @foreach ($lang as $language)
            <form action="{{route('change_language')}}" method="GET">
                <input type="hidden" name="language" value="{{$language}}">
                <button type="submit" class="dropdown-item">{{Str::upper($language)}}</button>
            </form>
        @endforeach
    </div>
</div>
