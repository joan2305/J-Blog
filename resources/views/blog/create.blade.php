<div class="modal fade" id="createBlogModal" tabindex="-1" aria-labelledby="createBlogModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCategoryModal">Create Blog</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('storeBlog') }}" method="POST" enctype="multipart/form-data">
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
                            placeholder="Input Blog  Title" value="{{ old('title') }}">
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
                        <input type="text" name="description"
                            class="form-control @error('description') is-invalid @enderror"
                            placeholder="Input Blog description" value="{{ old('description') }}">
                        @error('description')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="mb-2">Content</label>
                        <textarea name="content" class="form-control @error('content') is-invalid @enderror" placeholder="Input Blog Content"
                            rows="5"> {{ old('content') }}</textarea>
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
    </div>
</div>
