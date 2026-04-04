@extends('layouts.admin')

@section('title', 'Add New Slider')

@section('content')
<div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="card card-primary card-outline shadow">
            <div class="card-header bg-white">
                <h3 class="card-title fw-bold text-primary"><i class="ri-add-circle-line me-2"></i>Create New Slider</h3>
            </div>
            
            <div class="card-body">
                <form action="{{ route('sliders.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <label for="title" class="form-label fw-bold">Slider Title</label>
                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter headline title" value="{{ old('title') }}">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text small text-muted">A short, catchy title for the slider.</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="sub_title" class="form-label fw-bold">Sub Title</label>
                            <input type="text" name="sub_title" id="sub_title" class="form-control @error('sub_title') is-invalid @enderror" placeholder="Enter sub-headline" value="{{ old('sub_title') }}">
                            @error('sub_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text small text-muted">Additional context or minor heading.</div>
                        </div>
                    </div>

                    <div class="row mb-4 border-top pt-4">
                        <div class="col-md-8 mb-3">
                            <label for="image" class="form-label fw-bold">Slider Image <span class="text-danger">*</span></label>
                            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" onchange="previewImage(event)">
                            <div class="form-text mt-1 text-muted">Recommended resolution: 1920x800px. Max: 4MB.</div>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3 text-center">
                            <div class="image-preview border rounded p-2 bg-light d-flex align-items-center justify-content-center" style="height: 120px; overflow: hidden;">
                                <img id="img-preview" src="#" alt="Preview" style="display: none; max-width: 100%; max-height: 100%; object-fit: contain;">
                                <span id="preview-text" class="text-muted small"><i class="ri-image-line display-4 d-block"></i>Preview</span>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4 border-top pt-4">
                        <div class="col-md-8 mb-3">
                            <label for="link" class="form-label fw-bold">Redirect Link</label>
                            <input type="url" name="link" id="link" class="form-control @error('link') is-invalid @enderror" placeholder="https://example.com/products" value="{{ old('link') }}">
                            @error('link')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="order" class="form-label fw-bold">Display Order</label>
                            <input type="number" name="order" id="order" class="form-control @error('order') is-invalid @enderror" placeholder="0" value="{{ old('order', 0) }}">
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4 border-top pt-4">
                        <div class="col-12 mb-3">
                            <div class="form-check form-switch p-0 ms-4">
                                <input class="form-check-input" type="checkbox" name="status" id="status" value="1" checked>
                                <label class="form-check-label fw-bold ms-2" for="status">Slider Visibility</label>
                                <div class="text-muted small">Disable to hide this slider from the public homepage without deleting it.</div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer px-0 bg-transparent border-top pt-4 text-end">
                        <a href="{{ route('sliders.index') }}" class="btn btn-default px-4 me-2">Discard & Back</a>
                        <button type="submit" class="btn btn-primary px-5 fw-bold"><i class="ri-save-line me-1"></i>Publish Slider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('img-preview');
            var text = document.getElementById('preview-text');
            output.src = reader.result;
            output.style.display = 'block';
            text.style.display = 'none';
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection
