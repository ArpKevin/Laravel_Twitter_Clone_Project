@extends('shared.layout')

@section('title', 'Admin Dashboard')

@section('content')

    <div class="main">
        <div class="container center">
            @include('admin.shared.pin-container')
            {{ $pins->withQueryString()->links() }}
        </div>
    </div>
@endsection
