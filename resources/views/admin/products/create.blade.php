@extends('layouts.admin')

@section('title', 'Add Product')

@section('style')
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<style>
    .dropzone {
        border: 2px dashed #007bff;
        border-radius: 10px;
        background: #f8f9fa;
        min-height: 150px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }
    .image-preview-container {
        width: 100%;
        height: 200px;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8f9fa;
        overflow: hidden;
        margin-bottom: 10px;
    }
    .image-preview-container img {
        max-width: 100%;
        max-height: 100%;
        object-fit: cover;
    }
</style>
@endsection

@section('content')
<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" id="product_form" novalidate>
    @csrf
    <div class="row">
        <!-- Sidebar Column -->
        <div class="col-lg-4">
            <div class="card card-primary card-outline shadow-sm mb-4">
                <div class="card-header"><h3 class="card-title">Main Image</h3></div>
                <div class="card-body text-center">
                    <div class="image-preview-container" id="main-image-preview">
                        <i class="fas fa-camera fa-3x text-muted"></i>
                    </div>
                    <div class="mb-3">
                        <label for="main_image" class="btn btn-outline-primary btn-block w-100">
                            <i class="fas fa-upload me-1"></i> Choose Image
                        </label>
                        <input type="file" name="main_image" id="main_image" class="d-none" accept=".png, .jpg, .jpeg" onchange="previewMainImage(this)">
                        <div class="text-muted small mt-2">Recommended: 800x800px</div>
                    </div>
                </div>
            </div>

            <div class="card card-secondary card-outline shadow-sm mb-4">
                <div class="card-header"><h3 class="card-title">Status & Options</h3></div>
                <div class="card-body">
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" name="status" id="status" value="1" checked>
                        <label class="form-check-label fw-bold" for="status">Active Status</label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="featured" id="featured" value="1">
                        <label class="form-check-label fw-bold" for="featured">Featured Product</label>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Main Column -->
        <div class="col-lg-8">
            <div class="card card-primary card-outline shadow-sm mb-4">
                <div class="card-header"><h3 class="card-title">Product Information</h3></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label class="form-label fw-bold">Product Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Product Name" value="{{ old('name') }}">
                             @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                         </div>
                         <div class="col-md-4 mb-3">
                             <label class="form-label fw-bold">SKU <span class="text-danger">*</span></label>
                             <input type="text" name="sku" class="form-control @error('sku') is-invalid @enderror" placeholder="SKU001" value="{{ old('sku') }}">
                             @error('sku') <div class="invalid-feedback">{{ $message }}</div> @enderror
                         </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Category <span class="text-danger">*</span></label>
                            <select name="category_id" class="form-control select2 @error('category_id') is-invalid @enderror">
                                 <option value="">Select Category</option>
                                 @foreach($categories as $category)
                                     <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                 @endforeach
                             </select>
                             @error('category_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                         </div>
                         <div class="col-md-6 mb-3">
                             <label class="form-label fw-bold">Stock Quantity <span class="text-danger">*</span></label>
                             <input type="number" name="quantity" class="form-control @error('quantity') is-invalid @enderror" placeholder="0" value="{{ old('quantity', 0) }}">
                             @error('quantity') <div class="invalid-feedback">{{ $message }}</div> @enderror
                         </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Price ($) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                 <input type="number" step="0.01" name="price" class="form-control @error('price') is-invalid @enderror" placeholder="0.00" value="{{ old('price') }}">
                             </div>
                             @error('price') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                         </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Discount Price ($)</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" step="0.01" name="discount_price" class="form-control" placeholder="0.00" value="{{ old('discount_price') }}">
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Making Charge ($)</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" step="0.01" name="making_charge" class="form-control" placeholder="0.00" value="{{ old('making_charge') }}">
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Metal Type</label>
                            <select name="metal_type" class="form-control select2">
                                <option value="">Select Metal</option>
                                <option value="Yellow Gold">Yellow Gold</option>
                                <option value="Rose Gold">Rose Gold</option>
                                <option value="White Gold">White Gold</option>
                                <option value="Platinum">Platinum</option>
                                <option value="Silver">Silver</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Purity</label>
                            <select name="purity" class="form-control select2">
                                <option value="">Select Purity</option>
                                <option value="14K">14K</option>
                                <option value="18K">18K</option>
                                <option value="22K">22K</option>
                                <option value="PT950">PT950</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Weight (g)</label>
                            <input type="text" name="weight" class="form-control" placeholder="e.g. 5.4g">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Stone Type</label>
                            <select name="stone_type" class="form-control select2">
                                <option value="">Select Stone</option>
                                <option value="Diamond">Diamond</option>
                                <option value="Emerald">Emerald</option>
                                <option value="Ruby">Ruby</option>
                                <option value="Sapphire">Sapphire</option>
                                <option value="None">None</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Stone Weight (ct)</label>
                            <input type="text" name="stone_weight" class="form-control" placeholder="e.g. 0.5ct">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Product Gallery</label>
                        <div class="dropzone" id="gallery-dropzone">
                            <div class="dz-message">
                                <i class="fas fa-images fa-3x text-primary mb-3"></i>
                                <h5>Drop files here or click to upload.</h5>
                                <span class="text-muted small">Max 10 files, 2MB each</span>
                            </div>
                        </div>
                        <textarea name="gallery_images_json" id="gallery_images_json" class="d-none">[]</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Short Description</label>
                        <textarea name="short_description" id="short_description" class="form-control" rows="2">{{ old('short_description') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Full Description</label>
                        <textarea name="description" id="full_description" class="form-control" rows="4">{{ old('description') }}</textarea>
                    </div>

                    <div class="pt-3 border-top">
                        @include('includes.buttons', [
                            'type' => 'primary',
                            'text' => 'Create Jewellery Piece',
                            'icon' => 'fas fa-plus-circle',
                            'submit' => true
                        ])
                        <a href="{{ route('products.index') }}" class="btn btn-default px-4 ms-2">Discard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('script')
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
<script>
    Dropzone.autoDiscover = false;
    
    $(document).ready(function() {
        // Initialize CKEditors
        ClassicEditor.create(document.querySelector('#short_description')).catch(error => { console.error(error); });
        ClassicEditor.create(document.querySelector('#full_description')).catch(error => { console.error(error); });

        // Main Image Preview
        window.previewMainImage = function(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#main-image-preview').html('<img src="' + e.target.result + '" class="img-fluid rounded shadow-sm">');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Dropzone initialization
        var galleryPaths = [];
        var myDropzone = new Dropzone("#gallery-dropzone", {
            url: "{{ route('products.upload-gallery') }}",
            paramName: "file",
            maxFiles: 10,
            maxFilesize: 2,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            dictRemoveFile: "Remove Image",
            headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
            init: function() {
                this.on("success", function(file, response) {
                    if (response.success) {
                        file.serverPath = response.success; // Store server path in file object
                        galleryPaths.push({ uuid: file.upload.uuid, path: response.success });
                        $('#gallery_images_json').val(JSON.stringify(galleryPaths.map(img => img.path)));
                    }
                });
                this.on("removedfile", function(file) {
                    // Update the JSON field
                    galleryPaths = galleryPaths.filter(img => img.uuid !== file.upload.uuid);
                    $('#gallery_images_json').val(JSON.stringify(galleryPaths.map(img => img.path)));
                    
                    // If file was uploaded, notify server to clean up temp file
                    if (file.serverPath) {
                        $.ajax({
                            url: "{{ route('products.remove-gallery-image') }}",
                            method: 'POST',
                            data: {
                                _token: "{{ csrf_token() }}",
                                path: file.serverPath
                            }
                        });
                    }
                });
            }
        });
    });
</script>
@endsection
