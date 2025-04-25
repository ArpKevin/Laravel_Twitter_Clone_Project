<span class="header">Most Active Posters</span>

<div class="feedDiv" id="recommendations">

    @forelse($topUsers as $topUser)
        <div class="user">
            <div class="feedPicture" style="background-image: url('{{ $topUser->getImageURL() }}')"></div>
            <div class="feedName">
                <p style="margin-bottom: 0"><a href="{{ route('users.show', $topUser->id) }}">{{ $topUser->name }} - {{ $topUser->ideas()->count() }} posts</a></p>
            </div>
        </div>
    @empty
        <p class="text-center" style="margin: 0">No results found.</p>
    @endforelse
</div>