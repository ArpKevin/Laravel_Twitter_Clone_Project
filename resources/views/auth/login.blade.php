@extends('shared.app')

@section('title', 'Login')

@section('content')
    @auth
        <div>
            <h1 class="text-center">You are already logged in</h1>
            <h2>Continue browsing the website <b><i><a style="text-decoration: none" href="{{ route("dashboard") }}">here</a></i></b></h2>
        </div>
    @endauth
    @guest
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-8 col-md-6">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <form class="form mt-5" action="{{route('login')}}" method="post">
                    @csrf
                    <h3 class="text-center text-dark">Login</h3>
                    <div class="form-group">
                        <label for="email" class="text-dark">Email:</label><br>
                        <input type="email" name="email" id="email" class="form-control">
                        @error('email')
                        <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
                    @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="password" class="text-dark">Password:</label><br>
                        <input type="password" name="password" id="password" class="form-control">
                        @error('password')
                        <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
                    @enderror
                    </div>
                    <div class="form-group">
                        <label for="remember-me" class="text-dark"></label><br>
                        <input type="submit" name="submit" class="btn btn-dark btn-md" value="submit">
                    </div>
                    <div class="text-right mt-2">
                        <a href="/register" class="text-dark">Register here</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endguest

@endsection
