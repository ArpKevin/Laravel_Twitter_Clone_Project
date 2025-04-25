@extends('shared.layout')

@section('title', 'Profile')

@section('content')
    <div id="SearchDiv">
        <div class="navSearchBar">
            <input placeholder="Search..." class="input" name="text" type="text">
            <button class="button">
                <img src="{{ asset('imgs/black/search.svg') }}" alt="Search" class="theme-icon">
            </button>
        </div> 
    </div>  
    <div class="main">
        <div class="main-container">
            @include('shared.right-sidebar')
            @include('users.shared.user-card')
        </div>
    </div>
@endsection