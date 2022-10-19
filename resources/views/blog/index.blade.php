@extends('layouts.app')

@section('title')
    Manage Blog
@endsection

@section('content')
    <div class="container mt-4">
        <div class="col md-6 p-3 shadow rounded">
            <h4>Manage Blog</h4>
            <p>Here you can manage your blog (edit, update, or delete). </p>
            <hr>

            {{-- CREATE FORM MODAL --}}
            <!-- Button trigger modal -->
            @if (Auth::user()->role == 'Member')
                @include('blog.create')
                <button type="button" class="btn btn-primary btn-sm mb-4" data-bs-toggle="modal"
                    data-bs-target="#createBlogModal">
                    Create Blog
                </button>
            @endif


            {{-- SUCCESS MESSAGE --}}
            @if (session('pesan_sukses'))
                <div class="alert alert-success">
                    {{ session('pesan_sukses') }}
                </div>
            @endif
            {{-- CONTENT --}}
            {{-- {{ $blogs }} --}}
            @if ($blogs->count() == 0)
                <div class="alert alert-warning">There is no blog</div>
            @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Cover</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Description</th>
                            <th>Author</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($blogs as $blog)
                            <tr>
                                <td class="fw-bold" scope="row">{{ $loop->iteration }}</td>
                                <td style="width: 19%">
                                    <img src="{{ asset('storage/images/cover/' . $blog->cover) }}"
                                        alt="{{ $blog->title }} " class="w-100 rounded">
                                </td>
                                <td>
                                    <span class="d-block">
                                        {{ $blog->title }}
                                    </span>
                                    <span class="badge bg-info">
                                        {{ $blog->category->title }}
                                    </span>
                                </td>
                                <td>{{ $blog->status }}</td>
                                <td>{{ $blog->description }}</td>
                                <td>{{ $blog->user->name }}</td>
                                <td>
                                    @if (Auth::user()->role == 'Member')
                                        <a href="{{ route('editBlog', $blog->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    @else
                                        @if ($blog->status == 'Pending')
                                            <a href="#" class="btn btn-info btn-sm"
                                                onclick="event.preventDefault(); document.getElementById('updateBlog-{{ $blog->id }}').submit();">Accept</a>
                                            <form action="{{ route('acceptBlog', $blog->id) }}"
                                                id="updateBlog-{{ $blog->id }}" class="d-none" method="POST">
                                                @csrf
                                                @method('PUT');
                                            </form>
                                        @endif
                                    @endif
                                    <a href="{{ route('deleteBlog', $blog->id) }}" class="btn btn-danger btn-sm"
                                        onclick="event.preventDefault(); document.getElementById('deleteBlog-{{ $blog->id }}').submit()">Delete</a>

                                    <form action="{{ route('deleteBlog', $blog->id) }}"
                                        id="deleteBlog-{{ $blog->id }}" class="d-none" method="POST">
                                        @csrf
                                        @method('DELETE');
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
