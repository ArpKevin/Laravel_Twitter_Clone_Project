@extends('shared.layout')

@section('title', 'Dashboard')

@section('content')

    <div class="main">
        <div class="main-container">
            @include('shared.right-sidebar')


            <div class="posts" style="overflow: auto; height: inherit">
                @include('shared.success-message')
                @include('shared.submit-idea')
                @include('shared.mobile-feed')
                <div class="idea-card">
                    @forelse($ideas as $idea)
                        @include('shared.idea-card')
                    @empty
                        <p class="text-center mt-4">No results found.</p>
                    @endforelse
                    {{ $ideas->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
