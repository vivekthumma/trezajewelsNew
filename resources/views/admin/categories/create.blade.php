@extends('layouts.admin')

@section('title', 'Add Category')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card card-primary card-outline shadow">
            <div class="card-header">
                <h3 class="card-title">Create New Category</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
                    
                    <div class="mb-3">
                        <label for="category_name" class="form-label fw-bold">Category Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="category_name" 
                               class="form-control @error('name') is-invalid @enderror" 
                               placeholder="Enter Category Name" value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="category_slug" class="form-label fw-bold">Slug (Auto-generated)</label>
                        <input type="text" name="slug" id="category_slug" 
                               class="form-control @error('slug') is-invalid @enderror" 
                               placeholder="Slug will be auto-generated" value="{{ old('slug') }}">
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label fw-bold">Category Image</label>
                        <input type="file" name="image" id="image" 
                               class="form-control @error('image') is-invalid @enderror" 
                               accept=".png, .jpg, .jpeg">
                        <div class="form-text mt-1 text-muted">Allowed: png, jpg, jpeg. Max: 2MB.</div>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="banner_image" class="form-label fw-bold">Banner Image</label>
                        <input type="file" name="banner_image" id="banner_image" 
                               class="form-control @error('banner_image') is-invalid @enderror" 
                               accept=".png, .jpg, .jpeg">
                        <div class="form-text mt-1 text-muted">Allowed: png, jpg, jpeg. Max: 2MB. Recommended Size: 1920x500px</div>
                        @error('banner_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="status" id="status" value="1" checked>
                            <label class="form-check-label fw-bold ms-2" for="status">Active Status</label>
                        </div>
                        <div class="text-muted small">Set category as active or inactive</div>
                    </div>

                    <div class="card-footer px-0 bg-transparent border-top pt-4">
                        @include('includes.buttons', [
                            'type' => 'primary',
                            'text' => 'Save Category',
                            'icon' => 'fas fa-save',
                            'submit' => true
                        ])
                        <a href="{{ route('categories.index') }}" class="btn btn-default px-4 ms-2">Discard</a>
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
