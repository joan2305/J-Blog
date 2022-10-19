@extends('layouts.app')
@section('title', 'Edit Category')

@section('content')
    <div class="container mt-4">
        <div class="col md-6 p-3 shadow rounded">
            <h4>Edit Category</h4>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. </p>
            <hr>

            {{-- CONTENT --}}
            {{-- {{ $categories }} --}}
            <form action="{{ route('updateCategory', $category->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="" class="mb-2">Category Title</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                        placeholder="Input Category Title"
                        value="{{ old('title') != 0 ? old('title') : $category->title }}">
                    @error('title')
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
