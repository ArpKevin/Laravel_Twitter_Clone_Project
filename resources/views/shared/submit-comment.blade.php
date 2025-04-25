@auth
    <form action=" {{ route('ideas.comments.store', $idea->id) }} " method="post">
        @csrf
        <div class="mb-3">
            <textarea name="comment_content" class="fs-6 form-control" rows="1"></textarea>
        </div>
        @error('comment_content')
            <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
        @enderror
        <div>
            <button class="btn btn-primary btn-sm" type="submit"> Post Comment </button>
        </div>
    </form>
@endauth
@guest
    <p class="text-center mt-4">
    <h4 class="center"><a href="{{ route('login') }}">Login to comment on this idea</a></h4>
    </p>
@endguest
