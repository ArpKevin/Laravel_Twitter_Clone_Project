@extends('shared.layout')

@section('title', 'Register')

@section('loginform-css')
    <link rel="stylesheet" href="/css/loginform.css">
@endsection

@section('content')
    <div class="formDiv">

        <span class="header">Register</span>

        <form action="{{ route('register') }}" method="POST">
            @csrf
            <span>Username</span>
            <input type="text" name="name" id="name">
            @error('name')
                <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
            @enderror
            <span>Email</span>
            <input type="email" name="email" id="email">
            @error('email')
                <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
            @enderror
            <span>Password</span>
            <div class="password-container">
                <input type="password" id="password" name="password" maxlength="20">
                <button class="password-btn" type="button"><img src="{{ asset('imgs/black/visibility.svg') }}" alt="Show Password Button"></button>
            </div>
            @error('password')
                <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
            @enderror
            <span>Confirm Password</span>
            <div class="password-confirmation-container">
                <input type="password" id="password_confirmation" name="password_confirmation" maxlength="20">
                <button class="password-confirmation-btn" type="button"><img src="{{ asset('imgs/black/visibility.svg') }}" alt="Show Password Button"></button>
            </div>
            @error('password')
                <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
            @enderror
            <input type="submit" value="Register">
        </form>

        <span id="login"><a href="{{ route('login') }}">Already have an account?</a></span>

    </div>
@endsection
