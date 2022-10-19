@extends('layouts.app')
@section('title', 'Manage Category')

@section('content')
    <div class="container mt-4">
        <div class="col md-6 p-3 shadow rounded">
            <h4>Manage Category</h4>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. </p>
            <hr>

            {{-- CREATE FORM MODAL --}}
            <!-- Button trigger modal -->
            @include('category.create')
            <button type="button" class="btn btn-primary btn-sm mb-4" data-bs-toggle="modal"
                data-bs-target="#createCategoryModal">
                Create Category
            </button>

            {{-- SUCCESS MESSAGE --}}
            @if (session('pesan_sukses'))
                <div class="alert alert-success">
                    {{ session('pesan_sukses') }}
                </div>
            @endif
            {{-- CONTENT --}}
            {{-- {{ $categories }} --}}
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Category Title</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $num = 1 @endphp
                    @foreach ($categories as $category)
                        <tr>
                            <td class="fw-bold" scope="row">{{ $num++ }}</td>
                            {{-- bisa begini, kalo mau pake yg dri laravel bisa juga kyk yg di bawah jadi gausah
                                ada tag php, pake $loop->iteration --}}
                            {{-- <td class="fw-bold" scope="row">{{ $loop->iteration }}</td> --}}
                            <td>{{ $category->title }}</td>
                            <td>
                                <a href="{{ route('editCategory', $category->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                <a href="{{ route('deleteCategory', $category->id) }}" class="btn btn-danger btn-sm"
                                    onclick="event.preventDefault(); document.getElementById('deleteCategory-{{ $category->id }}').submit()">Delete</a>

                                <form action="{{ route('deleteCategory', $category->id) }}"
                                    id="deleteCategory-{{ $category->id }}" class="d-none" method="POST">
                                    @csrf
                                    @method('DELETE');
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
