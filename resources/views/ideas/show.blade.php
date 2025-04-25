@extends('shared.layout')

@section('title', 'Idea ' . $idea->id)

@section('content')

    <div class="main">
        <div class="main-container">
            @include('shared.right-sidebar')


            <div class="posts" style="overflow: auto; height: inherit">
                @include('shared.success-message')
                @include('shared.mobile-feed')
                <div class="idea-card">
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
                                <button type="button" class="btn btn-secondary btn-sm"  style="background-color: red;" onclick="window.location.href='{{ route('ideas.show', $idea->id) }}'"> Cancel </button>
                            </div>
                        </form>
                    @else
                        @include('shared.idea-card')
                        <hr class="mainHr">
                        @include('shared.submit-comment')
                        @include('ideas.shared.comments-box')
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
