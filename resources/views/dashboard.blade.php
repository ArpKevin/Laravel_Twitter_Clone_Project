@extends('shared.app')

{{-- @section('title')
    Dashboard
@endsection --}}

@if(Route::currentRouteName() === 'feed')
    @section('title', "Feed")
@elseif(Route::currentRouteName() === 'dashboard')
    @section('title', 'Dashboard')
@endif



@section('content')
    <div class="row">
        <div class="col-3">
            @include('shared.left-sidebar')
        </div>
        <div class="col-6">
            @include('shared.success-message')
            @include('ideas.shared.submit-idea')
            <hr>
            @forelse ($ideas as $idea)
            <div class="mt-3">
                @include('ideas.shared.idea-card')
            </div>
            @empty
            <p class="text-center mt-4">No results found.</p>
            @endforelse
            <div class="mt-2">
                {{ $ideas->withQueryString()->links() }}
            </div>
        </div>
        <div class="col-3">
            @include('shared.search-bar')
            @include('shared.follow-box')
        </div>
    </div>
@endsection
