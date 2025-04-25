<div class="underComments">
    @forelse ($idea->comments->sortByDesc('created_at') as $comment)
        <div class="post">
            <div class="postInfo">
                <div class="postPicture" style="background-image: url('{{ $comment->user->getImageURL() }}')"></div>
                <div class="postData">
                    <span class="birthName"><a href="{{ route('users.show', $comment->user->id) }}">{{ $comment->user->name }}</a></span>
                    <span class="time">{{ $comment->created_at->diffForHumans() }}</span>
                </div>
            </div>
        </div>
        <div class="postText">
            {{ $comment->content }}
        </div>
    </div>  
    @empty
        <p class="text-center mt-4">
            This post doesn't have any comments
        </p>
    @endforelse
</div>