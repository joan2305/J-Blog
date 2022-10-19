@extends('layouts.app')
@section('title')
    Home Page | Blog App
@endsection

@section('content')
    <div class="container-fluid p-5">
        <div class="container">
            <h3 class="text-center">Welcome to Blog App</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates quaerat ducimus doloremque itaque
                inventore
                soluta maiores in, deserunt incidunt ad velit quidem nobis rerum illum adipisci eligendi voluptatum aliquam
                vitae.</p>
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
