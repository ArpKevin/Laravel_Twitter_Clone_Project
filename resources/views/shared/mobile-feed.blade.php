<div class="mobileFeed">
    <div class="navSearchBar">
        <form action="{{ route('dashboard') }}" method="get" style="display: inherit;">
            <input value="{{ request('search', '') }}" placeholder="Search..." class="input" name="search" type="text">
            <button class="button" type="submit">
                <img src="{{ asset('imgs/black/search.svg') }}" alt="Search" class="theme-icon">
            </button>
        </form>
    </div>
    @include('shared.progress-bar')
    @include('shared.recommendations')
</div>