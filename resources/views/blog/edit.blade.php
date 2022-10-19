@extends('layouts.app')

@section('title')
    Edit Blog
@endsection

@section('content')
    <div class="container mt-4">
        <div class="col md-6 p-3 shadow rounded">
            <h4>Edit Blog</h4>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. </p>
            <hr>
            {{-- CONTENT --}}
            {{-- {{ $blog }} --}}
            <form action="{{ route('updateBlog', $blog->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="form-group mb-3">
                    <label for="" class="mb-2">Cover</label>
                    <input type="file" name="cover" class="form-control @error('cover') is-invalid @enderror">
                    @error('title')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="" class="mb-2">Title</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                        placeholder="Input Blog  Title" value="{{ old('title') != null ? old('title') : $blog->title }}">
                    @error('title')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="" class="mb-2">Blog Category</label>
                    <select name="category" class="form-control @error('category') is-invalid @enderror">
                        <option selected>Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach

                    </select>
                    @error('category')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="" class="mb-2">Description</label>
                    <input type="text" name="description" class="form-control @error('description') is-invalid @enderror"
                        placeholder="Input Blog description"
                        value="{{ old('description') != null ? old('description') : $blog->description }}">
                    @error('description')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="" class="mb-2">Content</label>
                    <textarea name="content" class="form-control @error('content') is-invalid @enderror" placeholder="Input Blog Content"
                        rows="5"> {{ old('content') != null ? old('content') : $blog->content }}</textarea>
                    @error('content')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <button class="btn btn-primary btn-sm" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
