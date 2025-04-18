<div class="card">
    <div class="px-3 pt-4 pb-2">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img style="width:50px" class="me-2 avatar-sm rounded-circle"
                    src="{{$idea->user->getImageURL()}}" alt="{{ $idea->user->name }} Avatar">
                <div>
                    <h5 class="card-title mb-0"><a href="{{route('users.show', $idea->user->id)}}"> {{ $idea->user->name }}
                        </a></h5>
                </div>
            </div>

            {{-- potentially to be refactored --}}
            <form action="{{ route('ideas.destroy', $idea->id) }}" method="post">
                @csrf
                @method('delete')
                @if(auth()->check() && (auth()->id() === $idea->user_id || auth()->user()->is_admin))
                    <a class="mx-2" href="{{ route('ideas.edit', $idea->id) }}" style="text-decoration: none">Edit</a>
                @endif
                <a href="{{ route('ideas.show', $idea->id) }}" style="text-decoration: none">View</a>
                @if(auth()->check() && (auth()->id() === $idea->user_id || auth()->user()->is_admin))
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this idea?')">X</button>
                @endif
            </form>
        </div>
    </div>
    <div class="card-body">
        @if ($editing_idea ?? false)
        <form action="{{ route('ideas.update', $idea->id) }}" method="post">
            @csrf
            @method('put')
            <div class="mb-3">
                <textarea name="idea_content" class="form-control" id="idea_content" rows="3">{{ $idea->content }}</textarea>
                @error('idea_content')
                    <span class="d-block fs-6 text-danger mt-2">{{$message}}</span>
                @enderror
            </div>
            <div class="">
                <button type="submit" class="btn btn-dark btn-sm"> Update </button>
            </div>
        </form>
        @else
            <p class="fs-6 fw-light text-muted">
                {{ $idea->content }}
            </p>

            <div class="d-flex justify-content-between">
                @include('ideas.shared.like-button')
                <div>
                    <span class="fs-6 fw-light text-muted"> <span class="fas fa-clock"> </span>
                        {{ $idea->created_at->diffForHumans() }} </span>
                </div>
            </div>
            @if(Route::currentRouteName() === 'ideas.show')
                @include('ideas.shared.comments-box')
            @endif
        @endif
    </div>
</div>
