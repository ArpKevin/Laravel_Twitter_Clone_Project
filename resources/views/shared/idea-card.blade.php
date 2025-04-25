<div class="post">
    <div class="postInfo">
        <div class="postPicture" style="background-image: url('{{ $idea->user->getImageURL() }}')"></div>
        <div class="postData">
            <span class="birthName"><a href="{{ route('users.show', $idea->user->id) }}">{{ $idea->user->name }}</a></span>
            <span class="time">{{ $idea->created_at->diffForHumans() }}</span>
        </div>
    </div>

    <div class="postText">
        {{ $idea->content }}
    </div>

    <button class="comments-toggle"><a href="{{ route('ideas.show', $idea->id) }}">View</a></button>
    
    @auth
    <!-- Információ a posztról -->
    <div class="postInformation">
        @if(auth()->check() && (auth()->id() === $idea->user_id || auth()->user()->is_admin))
            <form action="{{ route('ideas.edit', $idea->id) }}" method="GET">
                <button><span>Edit post</span></button>
            </form>
        @endif
        @if(auth()->check() && (auth()->id() === $idea->user_id || auth()->user()->is_admin))
            <form action="{{ route('ideas.destroy', $idea->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button style="background-color: red; color: white;" onclick="return confirm('Are you sure you want to delete this post?')"><span>Delete post</span></button>
            </form>
        @endif
        <div class="likeInformation">
            @include('ideas.shared.like-button')
        </div>
    </div>
    @endauth
</div>

