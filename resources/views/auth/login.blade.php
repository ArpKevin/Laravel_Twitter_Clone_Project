@extends('shared.layout')

@section('title', 'Login')

@section('loginform-css')
    <link rel="stylesheet" href="/css/loginform.css">
@endsection

@section('content')
    <div class="formDiv">

        <span class="header">Login</span>
        @include('shared.success-message')
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <span>Email</span>
            <input type="email" name="email" id="email">
            @error('email')
                <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
            @enderror
            <span>Password</span>
            <div class="password-container">
                <input type="password" name="password" id="password">
                <button class="password-btn" type="button"><img src="{{ asset('imgs/black/visibility.svg') }}"
                        alt="Show Password Button"></button>
            </div>
            @error('password')
                <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
            @enderror
            <input type="submit" value="Login">
        </form>

        <span id="register"><a href="{{ route('register') }}">Don't have an account yet?</a></span>
    </div>
@endsection