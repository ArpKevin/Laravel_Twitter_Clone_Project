<div class="userDiv">
    @include('shared.success-message')
    <div class="userProfile">
        <div class="backgroundImage">
            <div class="insideProfilePicture" style="background-image: url('{{ $user->getImageURL() }}')">
            </div>
        </div>
        <div class="profilePicture" style="background-image: url('{{ $user->getImageURL() }}')">
        </div>
        <div class="leftInformation">
            <div class="informationCenter">
                <img src="{{ asset('imgs/black/person.svg') }}" alt="" class="theme-icon"><span>{{ $user->followers()->count() }}</span>
            </div>
            <div class="informationCenter">
                <img src="{{ asset('imgs/black/lightbulb.svg') }}" alt="" class="theme-icon"><span>{{ $user->ideas()->count() }}</span>
            </div>
        </div>
        <div class="rightInformation">
            <div class="informationCenter">
                <img src="{{ asset('imgs/black/comment.svg') }}" alt="" class="theme-icon"><span>{{ $user->comments()->count() }}</span>
            </div>
            <div class="informationCenter">
                <img src="{{ asset('imgs/black/pin.svg') }}" alt="" class="theme-icon"><span style="color: {{ $user->pins()->count() === $totalPins ? 'green' : 'black' }}">{{ $user->pins()->count() }}/{{ $totalPins }}</span>
            </div>
        </div>
    </div>
    
    <span id="birthName">{{ $user->name }}</span>

    <p class="text-center mt-4">Bio: {{ $user->bio }}</p>

    @auth
    <div class="profileButtons">
        @if (auth()->check() && auth()->user()->id === $user->id)
            <button id="profileEdit"><a href="{{ route('users.edit', $user->id) }}">Edit profile</a></button>
        @else
            @if (auth()->user()->follows($user))
                <form action="{{ route('users.unfollow', $user->id) }}" method="POST">
                    @csrf
                    <button id="profileFollow" style="background-color: red;">Unfollow</button>
                </form>
            @else
                <form action="{{ route('users.follow', $user->id) }}" method="POST">
                    @csrf
                    <button id="profileFollow">Follow</button>
                </form>
            @endif
        @endif
    </div>
    @endauth

    <hr id="largeScreenHr">

    <div class="middleInformation">
        <div class="userStatistics">
            <img src="{{ asset('imgs/black/person.svg') }}" alt="" class="theme-icon"><span>{{ $user->followers()->count() }}</span>
            <img src="{{ asset('imgs/black/lightbulb.svg') }}" alt="" class="theme-icon"><span>{{ $user->ideas()->count() }}</span>
            <img src="{{ asset('imgs/black/comment.svg') }}" alt="" class="theme-icon"><span>{{ $user->comments()->count() }}</span>
            <img src="{{ asset('imgs/black/pin.svg') }}" alt="" class="theme-icon"><span style="color: {{ $user->pins()->count() === $totalPins ? 'green' : 'black' }}">{{ $user->pins()->count() }}/{{ $totalPins }}</span>
        </div>
    </div>

    <hr id="smallScreenHr">

    @include('shared.mobile-feed')

    <div class="idea-card">
        @forelse($ideas as $idea)
            @include('shared.idea-card')
        @empty
            <p class="text-center mt-4">No results found.</p>
        @endforelse
        {{ $ideas->withQueryString()->links() }}
    </div>

    <hr id="smallScreenHr">

    </div>
</div>