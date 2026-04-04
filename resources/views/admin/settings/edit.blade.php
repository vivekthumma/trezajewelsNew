@extends('layouts.admin')

@section('title', 'Edit Setting')

@section('content')
<div class="row justify-content-center">
    <div class="col-8">
        <div class="card card-white shadow-sm border-0 rounded-4 overflow-hidden">
            <div class="card-header bg-white py-4 d-flex align-items-center justify-content-between border-bottom">
                <h5 class="card-title mb-0 fw-bold text-dark">Edit Setting: <span class="text-primary">{{ $setting->slug }}</span></h5>
                <a href="{{ route('settings.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3 fs-8 fw-bold">
                    <i class="fas fa-arrow-left me-1"></i> Back to Settings
                </a>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('settings.update', $setting->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="slug" class="form-label fw-bold text-dark mb-1">Slug (Meta Key)</label>
                        <input type="text" name="slug" id="slug" class="form-control rounded-3 p-2 @error('slug') is-invalid @enderror" value="{{ old('slug', $setting->slug) }}">
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark mb-1 d-block">Input Type</label>
                        <span class="badge bg-light text-secondary border rounded-pill px-3 py-2 fs-7">{{ strtoupper($setting->type) }}</span>
                        <input type="hidden" name="type" value="{{ $setting->type }}">
                        <div class="text-muted small mt-1">Input type cannot be changed after creation.</div>
                    </div>

                    <div id="value-container" class="mb-4">
                        <label id="value-label" class="form-label fw-bold text-dark mb-1">Value / Content</label>
                        <div id="dynamic-input">
                            @if($setting->type === 'textarea')
                                <textarea name="value" class="form-control p-2 @error('value') is-invalid @enderror" rows="4">{{ old('value', $setting->value) }}</textarea>
                            @elseif($setting->type === 'file')
                                <input type="file" name="file_value" id="file_value" class="form-control @error('file_value') is-invalid @enderror" onchange="previewFile(this)">
                                <div class="text-muted small mt-1">Leave empty to keep current file.</div>
                            @elseif($setting->type === 'email')
                                <input type="email" name="value" class="form-control p-2 @error('value') is-invalid @enderror" value="{{ old('value', $setting->value) }}">
                            @elseif($setting->type === 'number')
                                <input type="number" name="value" class="form-control p-2 @error('value') is-invalid @enderror" value="{{ old('value', $setting->value) }}">
                            @elseif($setting->type === 'url')
                                <input type="url" name="value" class="form-control p-2 @error('value') is-invalid @enderror" value="{{ old('value', $setting->value) }}">
                            @else
                                <input type="text" name="value" class="form-control p-2 @error('value') is-invalid @enderror" value="{{ old('value', $setting->value) }}">
                            @endif
                        </div>
                        @error('value')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @error('file_value')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div id="preview-container" class="mb-4 {{ $setting->type === 'file' ? '' : 'd-none' }}">
                        <label class="form-label fw-bold text-dark mb-1">Preview</label>
                        <div class="border rounded p-3 text-center bg-light">
                            @if($setting->type === 'file' && $setting->value)
                                <img id="file-preview" src="{{ imgPath('settings/'.$setting->value) }}" alt="preview" class="rounded shadow-sm" style="max-height: 150px; max-width: 100%; object-fit: contain;">
                                <div id="file-info" class="text-muted small mt-2">{{ $setting->value }}</div>
                            @else
                                <img id="file-preview" src="#" alt="preview" class="d-none rounded shadow-sm" style="max-height: 150px; max-width: 100%;">
                                <div id="file-info" class="text-muted small d-none mt-2">No file selected.</div>
                            @endif
                        </div>
                    </div>

                    <div class="d-grid mt-4 pt-3">
                        <button type="submit" class="btn btn-primary rounded-pill p-2 fw-bold fs-7 shadow-sm">
                            <i class="fas fa-sync-alt me-2"></i> Update Setting
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function previewFile(input) {
        let preview = $('#file-preview');
        let info = $('#file-info');
        
        if (input.files && input.files[0]) {
            let reader = new FileReader();
            reader.onload = function(e) {
                preview.attr('src', e.target.result).removeClass('d-none');
                info.text(input.files[0].name).removeClass('d-none');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
