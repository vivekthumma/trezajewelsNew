@extends('layouts.admin')

@section('title', 'Edit Product')

@section('style')
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<style>
    .dropzone { border: 2px dashed #007bff; border-radius: 10px; background: #f8f9fa; min-height: 120px; display: flex; align-items: center; justify-content: center; flex-direction: column; }
    .image-preview-container { width: 100%; height: 200px; border: 1px solid #dee2e6; border-radius: 8px; display: flex; align-items: center; justify-content: center; background-color: #f8f9fa; overflow: hidden; margin-bottom: 10px; }
    .image-preview-container img { max-width: 100%; max-height: 100%; object-fit: cover; }
    .existing-gallery-img { position: relative; display: inline-block; width: 100px; height: 100px; margin-right: 10px; margin-bottom: 10px; border-radius: 8px; overflow: hidden; border: 1px solid #dee2e6; }
    .existing-gallery-img img { width: 100%; height: 100%; object-fit: cover; }
    .remove-gallery-img { position: absolute; top: 0; right: 0; background: rgba(220, 53, 69, 0.9); color: white; cursor: pointer; border: none; padding: 2px 6px; border-radius: 0 0 0 8px; font-size: 12px; }
</style>
@endsection

@section('content')
<form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" id="product_form" novalidate>
    @csrf
    @method('PUT')
    <div class="row">
        <!-- Sidebar Column -->
        <div class="col-lg-4">
            <div class="card card-primary card-outline shadow-sm mb-4">
                <div class="card-header"><h3 class="card-title text-primary"><i class="fas fa-image me-2"></i>Main Product Image</h3></div>
                <div class="card-body text-center">
                    <div class="image-preview-container" id="main-image-preview">
                        <img src="{{ imgPath($product->main_image) }}" class="img-fluid" alt="Current Image">
                    </div>
                    <div class="mb-3">
                        <label for="main_image" class="btn btn-outline-primary btn-block w-100">
                            <i class="fas fa-sync me-1"></i> Replace Main Image
                        </label>
                        <input type="file" name="main_image" id="main_image" class="d-none" accept=".png, .jpg, .jpeg" onchange="previewMainImage(this)">
                        <div class="text-muted small mt-2">Leave blank to keep current image.</div>
                    </div>
                </div>
            </div>

            <div class="card card-secondary card-outline shadow-sm mb-4">
                <div class="card-header"><h3 class="card-title">Status & Options</h3></div>
                <div class="card-body">
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" name="status" id="status" value="1" {{ $product->status ? 'checked' : '' }}>
                        <label class="form-check-label fw-bold" for="status">Active Status</label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="featured" id="featured" value="1" {{ $product->featured ? 'checked' : '' }}>
                        <label class="form-check-label fw-bold" for="featured">Featured Product</label>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Main Column -->
        <div class="col-lg-8">
            <div class="card card-primary card-outline shadow-sm mb-4">
                <div class="card-header"><h3 class="card-title text-primary"><i class="fas fa-edit me-2"></i>Refine Product Details</h3></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label class="form-label fw-bold">Product Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $product->name) }}">
                             @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                         </div>
                         <div class="col-md-4 mb-3">
                             <label class="form-label fw-bold">SKU <span class="text-danger">*</span></label>
                             <input type="text" name="sku" class="form-control @error('sku') is-invalid @enderror" value="{{ old('sku', $product->sku) }}">
                             @error('sku') <div class="invalid-feedback">{{ $message }}</div> @enderror
                         </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Category <span class="text-danger">*</span></label>
                            <select name="category_id" class="form-control select2 @error('category_id') is-invalid @enderror">
                                 @foreach($categories as $category)
                                     <option value="{{ $category->id }}" {{ $category->id == old('category_id', $product->category_id) ? 'selected' : '' }}>{{ $category->name }}</option>
                                 @endforeach
                             </select>
                             @error('category_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                         </div>
                         <div class="col-md-6 mb-3">
                             <label class="form-label fw-bold">Stock Quantity <span class="text-danger">*</span></label>
                             <input type="number" name="quantity" class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity', $product->quantity) }}">
                             @error('quantity') <div class="invalid-feedback">{{ $message }}</div> @enderror
                         </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Price ($) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $product->price) }}">
                             @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                         </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Discount Price ($)</label>
                            <input type="number" step="0.01" name="discount_price" class="form-control" value="{{ old('discount_price', $product->discount_price) }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Making Charge ($)</label>
                            <input type="number" step="0.01" name="making_charge" class="form-control" value="{{ old('making_charge', $product->making_charge) }}">
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Metal Type</label>
                            <select name="metal_type" class="form-control select2">
                                <option value="Yellow Gold" {{ $product->metal_type == 'Yellow Gold' ? 'selected' : '' }}>Yellow Gold</option>
                                <option value="Rose Gold" {{ $product->metal_type == 'Rose Gold' ? 'selected' : '' }}>Rose Gold</option>
                                <option value="White Gold" {{ $product->metal_type == 'White Gold' ? 'selected' : '' }}>White Gold</option>
                                <option value="Platinum" {{ $product->metal_type == 'Platinum' ? 'selected' : '' }}>Platinum</option>
                                <option value="Silver" {{ $product->metal_type == 'Silver' ? 'selected' : '' }}>Silver</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Purity</label>
                            <select name="purity" class="form-control select2">
                                <option value="14K" {{ $product->purity == '14K' ? 'selected' : '' }}>14K</option>
                                <option value="18K" {{ $product->purity == '18K' ? 'selected' : '' }}>18K</option>
                                <option value="22K" {{ $product->purity == '22K' ? 'selected' : '' }}>22K</option>
                                <option value="PT950" {{ $product->purity == 'PT950' ? 'selected' : '' }}>PT950</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Weight (g)</label>
                            <input type="text" name="weight" class="form-control" value="{{ old('weight', $product->weight) }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Stone Type</label>
                            <select name="stone_type" class="form-control select2">
                                <option value="Diamond" {{ $product->stone_type == 'Diamond' ? 'selected' : '' }}>Diamond</option>
                                <option value="Emerald" {{ $product->stone_type == 'Emerald' ? 'selected' : '' }}>Emerald</option>
                                <option value="Ruby" {{ $product->stone_type == 'Ruby' ? 'selected' : '' }}>Ruby</option>
                                <option value="Sapphire" {{ $product->stone_type == 'Sapphire' ? 'selected' : '' }}>Sapphire</option>
                                <option value="None" {{ $product->stone_type == 'None' ? 'selected' : '' }}>None</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Stone Weight (ct)</label>
                            <input type="text" name="stone_weight" class="form-control" value="{{ old('stone_weight', $product->stone_weight) }}">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Product Gallery</label>
                        <div class="d-flex flex-wrap mb-3">
                            @foreach($product->gallery as $image)
                                <div class="existing-gallery-img" id="gallery-container-{{ $image->id }}">
                                    <img src="{{ imgPath($image->image) }}" alt="Gallery Image">
                                    <button type="button" class="remove-gallery-img" onclick="removeImageAjax({{ $image->id }})"><i class="fas fa-times"></i></button>
                                </div>
                            @endforeach
                        </div>
                        <div class="dropzone" id="gallery-dropzone">
                            <div class="dz-message">
                                <i class="fas fa-plus-circle fa-2x text-info mb-2"></i>
                                <h6>Add more images...</h6>
                            </div>
                        </div>
                        <textarea name="gallery_images_json" id="gallery_images_json" class="d-none">[]</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Short Description</label>
                        <textarea name="short_description" id="short_description" class="form-control" rows="2">{{ old('short_description', $product->short_description) }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Full Description</label>
                        <textarea name="description" id="full_description" class="form-control" rows="4">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div class="pt-3 border-top">
                        @include('includes.buttons', [
                            'type' => 'primary',
                            'text' => 'Save Product Changes',
                            'icon' => 'fas fa-save',
                            'submit' => true
                        ])
                        <a href="{{ route('products.index') }}" class="btn btn-default px-4 ms-2">Discard Changes</a>
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

        // Delete EXISTING images (already in DB)
        window.removeImageAjax = function(imageId) {
            if (confirm('Permanently delete this gallery image?')) {
                $.ajax({
                    url: "{{ route('products.remove-gallery-image') }}",
                    type: 'POST',
                    data: { 
                        _token: "{{ csrf_token() }}", 
                        image_id: imageId 
                    },
                    success: function() { 
                        $('#gallery-container-' + imageId).fadeOut(function() { $(this).remove(); }); 
                    },
                    error: function() { alert('Error removing image.'); }
                });
            }
        }

        // Dropzone initialization for NEW images
        var galleryPaths = [];
        var myDropzone = new Dropzone("#gallery-dropzone", {
            url: "{{ route('products.upload-gallery') }}",
            paramName: "file",
            maxFiles: 10,
            maxFilesize: 2,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            dictRemoveFile: "Cancel Upload",
            headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
            init: function() {
                this.on("success", function(file, response) {
                    if (response.success) {
                        file.serverPath = response.success;
                        galleryPaths.push({ uuid: file.upload.uuid, path: response.success });
                        $('#gallery_images_json').val(JSON.stringify(galleryPaths.map(img => img.path)));
                    }
                });
                this.on("removedfile", function(file) {
                    galleryPaths = galleryPaths.filter(img => img.uuid !== file.upload.uuid);
                    $('#gallery_images_json').val(JSON.stringify(galleryPaths.map(img => img.path)));
                    
                    // Clean up temp file on server if upload was successful
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
