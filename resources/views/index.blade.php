@extends('layouts.app')
@section('title')
    Home Page | Blog App
@endsection

@section('content')
    <div class="container-fluid p-5">
        <div class="container">
            <h3 class="text-center">Welcome to J-Blog</h3>
            <p class="text-center">Welcome to J-Blog. Here you can explore various blogs and articles by others!</p>
            <hr>
            <div class="col-12 text-center">
                <a href="{{ url('blog/all') }}" class="btn btn-outline-primary">
                    Explore All Blogs
                </a>
            </div>
        </div>
    </div>
    {{-- @guest
        <h1>Oke</h1>
    @else
        @if (Auth::user()->role == 'Admin')
            <h1>Halo Admin</h1>
        @else
            <h1>Halo Member</h1>
        @endif
    @endguest --}}
@endsection
