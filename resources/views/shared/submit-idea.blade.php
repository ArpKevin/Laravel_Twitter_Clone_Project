@auth
    <h4> Share your ideas </h4>
    <div class="row">
        <form action="{{ route('ideas.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <textarea name="idea_content" class="form-control" id="idea_content" rows="3" oninput="document.getElementById('charCount').innerText = `${this.value.length}/240`"></textarea>
                @error('idea_content')
                    <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
                @enderror
                <span id="charCount">0/240</span>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-dark"> Share </button>
            </div>
        </form>
    </div>
@endauth
@guest
    <h4><a href="{{ route('login') }}">Login to share your ideas</a> </h4>
@endguest