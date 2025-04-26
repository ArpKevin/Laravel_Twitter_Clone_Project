@extends('shared.layout')

@section('title', 'Add Pin')

@section('loginform-css')
    <link rel="stylesheet" href="{{ asset('css/loginform.css') }}">
@endsection

@section('content')
    <div class="formDiv">

        <span class="header">Add Pin</span>
        @include('shared.success-message')
        <form action="{{ route('admin.pins.create') }}" method="POST">
            @csrf
            <span>Pin Name</span>
            <input type="text" name="pin_name" id="pin_name">
            @error('pin_name')
                <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
            @enderror
            <span>Pin Description</span>
            <textarea name="pin_description" id="pin_description" rows="4" class="form-control"></textarea>
            @error('pin_description')
                <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
            @enderror
            <span>Image Link</span>
            <input type="text" name="image_link" id="image_link">
            @error('image_link')
                <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
            @enderror
            <span>Latitude (48.059131 - 48.086029)</span>
            <input type="text" name="latitude" id="latitude">
            @error('latitude')
                <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
            @enderror
            <span>Longitude (19.262767 - 19.311605)</span>
            <input type="text" name="longitude" id="longitude">
            @error('longitude')
                <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
            @enderror
            <span>Pin Category</span>
            <select name="pin_category_id" id="pin_category_id" class="form-select">
                @foreach ($pinCategories as $pinCategory)
                    <option value="{{ $pinCategory->id }}">{{ $pinCategory->category_name }}</option>
                @endforeach
            </select>
            @error('pin_category_id')
                <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
            @enderror
            <input type="submit" value="Add Pin">
            <a href="{{ route('admin.dashboard') }}">Cancel</a>
        </form>
    </div>
@endsection