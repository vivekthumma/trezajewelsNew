@extends('layouts.admin')

@section('title', 'Edit Category')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card card-info card-outline shadow">
            <div class="card-header">
                <h3 class="card-title">Edit Category: {{ $category->name }}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="category_name" class="form-label fw-bold">Category Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="category_name" 
                               class="form-control @error('name') is-invalid @enderror" 
                               placeholder="Enter Category Name" value="{{ old('name', $category->name) }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="category_slug" class="form-label fw-bold">Slug</label>
                        <input type="text" name="slug" id="category_slug" 
                               class="form-control @error('slug') is-invalid @enderror" 
                               placeholder="Category Slug" value="{{ old('slug', $category->slug) }}">
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label d-block fw-bold">Category Image</label>
                        @if($category->image)
                            <div class="mb-3">
                                <img src="{{ imgPath($category->image) }}" alt="Current Image" 
                                     class="img-thumbnail shadow-sm" style="max-width: 150px; height: auto;">
                                <div class="text-muted small mt-1">Current image preview</div>
                            </div>
                        @endif
                        <input type="file" name="image" id="image" 
                               class="form-control @error('image') is-invalid @enderror" 
                               accept=".png, .jpg, .jpeg">
                        <div class="form-text mt-1 text-muted">Leave blank to keep current image. Max: 2MB.</div>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label d-block fw-bold">Banner Image</label>
                        @if($category->banner_image)
                            <div class="mb-3">
                                <img src="{{ imgPath($category->banner_image) }}" alt="Current Banner" 
                                     class="img-thumbnail shadow-sm w-100" style="max-height: 200px; object-fit: cover;">
                                <div class="text-muted small mt-1">Current banner preview</div>
                            </div>
                        @endif
                        <input type="file" name="banner_image" id="banner_image" 
                               class="form-control @error('banner_image') is-invalid @enderror" 
                               accept=".png, .jpg, .jpeg">
                        <div class="form-text mt-1 text-muted">Leave blank to keep current banner. Max: 2MB. Recommended Size: 1920x500px</div>
                        @error('banner_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="status" id="status" value="1" {{ $category->status ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold ms-2" for="status">Active Status</label>
                        </div>
                        <div class="text-muted small">Set category as active or inactive</div>
                    </div>

                    <div class="card-footer px-0 bg-transparent border-top pt-4">
                        @include('includes.buttons', [
                            'type' => 'info',
                            'text' => 'Update Category',
                            'icon' => 'fas fa-sync',
                            'submit' => true
                        ])
                        <a href="{{ route('categories.index') }}" class="btn btn-default px-4 ms-2">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $(document).on('keyup', '#category_name', function() {
        let name = $(this).val();
        let slug = name.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
        $('#category_slug').val(slug);
    });
</script>
@endsection
