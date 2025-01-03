<div>
    @auth
        <form action=" {{ route('ideas.comments.store', $idea->id) }} " method="post">
            @csrf
            <div class="mb-3">
                <textarea name="comment_content" class="fs-6 form-control" rows="1"></textarea>
            </div>
            @error('comment_content')
                <span>{{ $message }}</span>
            @enderror
            <div>
                <button class="btn btn-primary btn-sm" type="submit"> Post Comment </button>

            </div>
        </form>
    @endauth

    <hr>
    @foreach ($idea->comments->sortByDesc('created_at') as $comment)
        <div class="d-flex align-items-start">
            <img style="width:35px" class="me-2 avatar-sm rounded-circle"
                src="https://api.dicebear.com/6.x/fun-emoji/svg?seed={{ $comment->user->name }}"
                alt="{{ $comment->user->name }} Avatar">
            <div class="w-100">
                <div class="d-flex justify-content-between">
                    <h6 class="">{{ $comment->user->name }}
                    </h6>
                    <small class="fs-6 fw-light text-muted"> {{ $comment->created_at }} </small>
                </div>
                <p class="fs-6 mt-3 fw-light">
                    {{ $comment->content }}
                </p>
            </div>
        </div>
    @endforeach
</div>
