@extends('layouts.app')
@section('title', 'Explore Blogs')

@section('content')
    <div class="container mt-4">
        @if ($blogs->count() == 0)
            <div class="alert alert-warning">
                There is no blog
            </div>
        @else
            <h3>Explore All Blogs</h3>
            <p>Explore various blogs!</p>
            <hr>
            <form action="{{ route('searchBlog') }}" class="col-md-6 mb-4" method="POST">
                @csrf
                <input type="text" class="form-control" placeholder="Search blog" name="searchInput">
            </form>
            <div class="row">
                @foreach ($blogs as $blog)
                    <div class="col-md-3">
                        <div class="col-md-12 rounded shadow-sm p-3">
                            <img src="{{ '/storage/images/cover/' . $blog->cover }}" alt="{{ $blog->title }} "
                                class="w-100 rounded-top">

                            <div class="p-3">
                                <span class="badge bg-info">
                                    {{ $blog->category->title }}
                                </span>
                                <h4>{{ $blog->title }}</h4>
                                <p>{{ $blog->description }}</p>
                                <b>Author: <span>{{ $blog->user->name }}</span></b>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
