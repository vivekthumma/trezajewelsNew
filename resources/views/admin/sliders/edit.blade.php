@extends('layouts.admin')

@section('title', 'Edit Slider')

@section('content')
<div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="card card-primary card-outline shadow">
            <div class="card-header bg-white d-flex align-items-center justify-content-between">
                <h3 class="card-title fw-bold text-primary"><i class="ri-edit-circle-line me-2"></i>Edit Slider (#{{ $slider->id }})</h3>
                <span class="badge bg-light text-primary border rounded-pill">{{ $slider->created_at->format('M d, Y') }}</span>
            </div>
            
            <div class="card-body">
                <form action="{{ route('sliders.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <label for="title" class="form-label fw-bold small text-uppercase">Slider Title</label>
                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter headline title" value="{{ old('title', $slider->title) }}">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text small text-muted">A short, catchy headline for this slide.</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="sub_title" class="form-label fw-bold small text-uppercase">Sub Title</label>
                            <input type="text" name="sub_title" id="sub_title" class="form-control @error('sub_title') is-invalid @enderror" placeholder="Enter sub-headline" value="{{ old('sub_title', $slider->sub_title) }}">
                            @error('sub_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text small text-muted">Additional context or minor heading.</div>
                        </div>
                    </div>

                    <div class="row mb-4 border-top pt-4 bg-light p-3 rounded-2">
                        <div class="col-md-7 mb-3">
                            <label for="image" class="form-label fw-bold small text-uppercase">Replace Slider Image</label>
                            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" onchange="previewImage(event)">
                            <div class="form-text mt-1 text-muted">Keep blank to maintain the current image. Allowed: jpg, jpeg, png, webp.</div>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-5 mb-3 text-center">
                            <p class="small text-muted mb-2 fw-bold text-uppercase">Live Visual Preview</p>
                            <div class="image-preview border rounded p-1 bg-white d-flex align-items-center justify-content-center shadow-sm" style="height: 180px; overflow: hidden; position: relative;">
                                <img id="img-preview" src="{{ imgPath($slider->image) }}" alt="Current Slider" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4 border-top pt-4">
                        <div class="col-md-8 mb-3">
                            <label for="link" class="form-label fw-bold small text-uppercase">Redirect Link</label>
                            <input type="url" name="link" id="link" class="form-control @error('link') is-invalid @enderror" placeholder="https://example.com/products" value="{{ old('link', $slider->link) }}">
                            @error('link')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="order" class="form-label fw-bold small text-uppercase">Display Order Priority</label>
                            <input type="number" name="order" id="order" class="form-control @error('order') is-invalid @enderror" placeholder="0" value="{{ old('order', $slider->order) }}">
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4 border-top pt-4">
                        <div class="col-12 mb-3">
                            <div class="form-check form-switch p-0 ms-4">
                                <input class="form-check-input" type="checkbox" name="status" id="status" value="1" {{ $slider->status ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold ms-2 text-uppercase small" for="status">Slider Availability</label>
                                <div class="text-muted small">If deactivated, this slider will be skipped in the homepage carousel sequence.</div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer px-0 bg-transparent border-top pt-4 text-end">
                        <a href="{{ route('sliders.index') }}" class="btn btn-default px-4 me-2">Cancel Edit</a>
                        <button type="submit" class="btn btn-primary px-5 fw-bold shadow-sm"><i class="ri-refresh-line me-1"></i>Update & Publish</button>
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
            output.src = reader.result;
            output.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection
