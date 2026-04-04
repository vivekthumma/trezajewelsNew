@extends('layouts.admin')

@section('title', 'Add New Setting')

@section('content')
<div class="row justify-content-center">
    <div class="col-8">
        <div class="card card-white shadow-sm border-0 rounded-4 overflow-hidden">
            <div class="card-header bg-white py-4 d-flex align-items-center justify-content-between border-bottom">
                <h5 class="card-title mb-0 fw-bold text-dark">Add New Setting</h5>
                <a href="{{ route('settings.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3 fs-8 fw-bold">
                    <i class="fas fa-arrow-left me-1"></i> Back to Settings
                </a>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('settings.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="slug" class="form-label fw-bold text-dark mb-1">Slug (Meta Key)</label>
                        <input type="text" name="slug" id="slug" class="form-control rounded-3 p-2 @error('slug') is-invalid @enderror" placeholder="e.g., site_logo, maintenance_mode" value="{{ old('slug') }}">
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="text-muted small mt-1 italic ms-1">No spaces allowed, use underscores.</div>
                    </div>

                    <div class="mb-4">
                        <label for="type" class="form-label fw-bold text-dark mb-1">Input Type</label>
                        <select name="type" id="type" class="form-select @error('type') is-invalid @enderror select2">
                            <option value="text">TEXT</option>
                            <option value="textarea">TEXTAREA</option>
                            <option value="file">FILE / IMAGE</option>
                            <option value="email">EMAIL</option>
                            <option value="number">NUMBER</option>
                            <option value="url">URL</option>
                        </select>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div id="value-container" class="mb-4">
                        <label id="value-label" class="form-label fw-bold text-dark mb-1">Value / Content</label>
                        <div id="dynamic-input">
                            <input type="text" name="value" id="value-input" class="form-control p-2 @error('value') is-invalid @enderror" value="{{ old('value') }}">
                        </div>
                        @error('value')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div id="preview-container" class="mb-4 d-none">
                        <label class="form-label fw-bold text-dark mb-1">File Preview</label>
                        <div class="border rounded p-3 text-center bg-light">
                            <img id="file-preview" src="#" alt="preview" class="d-none rounded shadow-sm" style="max-height: 150px; max-width: 100%;">
                            <div id="file-info" class="text-muted small d-none mt-2">No file selected.</div>
                        </div>
                    </div>

                    <div class="d-grid mt-4 pt-3">
                        <button type="submit" class="btn btn-primary rounded-pill p-2 fw-bold fs-7 shadow-sm">
                            <i class="fas fa-save me-2"></i> Save Setting
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
    $(document).ready(function() {
        $('#type').on('change', function() {
            let type = $(this).val();
            let container = $('#dynamic-input');
            let preview = $('#preview-container');
            
            container.empty();
            preview.addClass('d-none');

            switch(type) {
                case 'textarea':
                    container.append('<textarea name="value" id="value-input" class="form-control p-2" rows="4">{{ old('value') }}</textarea>');
                    break;
                case 'file':
                    container.append('<input type="file" name="file_value" id="file_value" class="form-control" onchange="previewFile(this)">');
                    preview.removeClass('d-none');
                    break;
                case 'email':
                    container.append('<input type="email" name="value" id="value-input" class="form-control p-2" value="{{ old('value') }}">');
                    break;
                case 'number':
                    container.append('<input type="number" name="value" id="value-input" class="form-control p-2" value="{{ old('value') }}">');
                    break;
                case 'url':
                    container.append('<input type="url" name="value" id="value-input" class="form-control p-2" value="{{ old('value') }}">');
                    break;
                default:
                    container.append('<input type="text" name="value" id="value-input" class="form-control p-2" value="{{ old('value') }}">');
            }
        });
        
        $('#type').trigger('change');
    });

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
