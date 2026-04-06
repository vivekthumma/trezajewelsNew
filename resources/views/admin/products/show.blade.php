@extends('layouts.admin')

@section('title', 'Product Details')

@section('style')
<style>
    .gallery-main-img { width: 100%; height: 400px; object-fit: cover; border-radius: 8px; border: 1px solid #dee2e6; }
    .thumb-img { width: 70px; height: 70px; object-fit: cover; border-radius: 4px; cursor: pointer; border: 2px solid transparent; transition: 0.2s; margin-right: 8px; margin-bottom: 8px; opacity: 0.7; }
    .thumb-img.active { border-color: var(--treza-gold); opacity: 1; }
    .thumb-img:hover { opacity: 1; }
    .table-metadata th { width: 40%; background-color: #f8f9fa; }
</style>
@endsection

@section('content')
<div class="row">
    <!-- Left Column: Media -->
    <div class="col-lg-5">
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="mb-3">
                    <img id="main-display-image" src="{{ imgPath($product->main_image) }}" class="gallery-main-img" alt="{{ $product->name }}">
                </div>
                
                <div class="d-flex flex-wrap" id="gallery-thumbs">
                    <img src="{{ imgPath($product->main_image) }}" class="thumb-img active" onclick="changeImage('{{ imgPath($product->main_image) }}', this)">
                    @foreach($product->gallery as $img)
                        <img src="{{ imgPath($img->image) }}" class="thumb-img" onclick="changeImage('{{ imgPath($img->image) }}', this)">
                    @endforeach
                </div>
                
                <hr>
                <h5 class="fw-bold mt-4"><i class="fas fa-info-circle me-1 text-primary"></i> Short Description</h5>
                <div class="text-muted prose prose-sm max-w-none">
                    {!! $product->short_description ?? 'No short description available.' !!}
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column: Info & Details -->
    <div class="col-lg-7">
        <div class="card shadow-sm mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title fw-bold">{{ $product->name }}</h3>
                <div>
                    @if($product->status)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-danger">Inactive</span>
                    @endif
                    @if($product->featured)
                        <span class="badge bg-warning ms-1">Featured</span>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <span class="text-muted me-3">Category: <strong class="text-primary">{{ $product->category->name }}</strong></span>
                    <span class="text-muted">SKU: <strong>{{ $product->sku }}</strong></span>
                </div>

                <div class="bg-light p-3 rounded mb-4 shadow-sm border">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <span class="h2 fw-bold mb-0 text-primary">₹{{ number_format($product->price, 2) }}</span>
                            @if($product->discount_price)
                                <span class="ms-2 text-danger text-decoration-line-through">₹{{ number_format($product->discount_price, 2) }}</span>
                            @endif
                        </div>
                        <div class="col-md-6 text-md-end">
                             <span class="fw-bold {{ $product->quantity > 0 ? 'text-success' : 'text-danger' }}">
                                <i class="fas fa-warehouse me-1"></i> {{ $product->quantity }} In Stock
                             </span>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-sm table-metadata">
                        <tbody>
                            <tr><th>Metal Type</th><td>{{ $product->metal_type ?? 'N/A' }}</td></tr>
                            <tr><th>Purity</th><td>{{ $product->purity ?? 'N/A' }}</td></tr>
                            <tr><th>Weight</th><td>{{ $product->weight ?? 'N/A' }}</td></tr>
                            <tr><th>Stone Type</th><td>{{ $product->stone_type ?? 'N/A' }}</td></tr>
                            <tr><th>Stone Weight</th><td>{{ $product->stone_weight ?? 'N/A' }}</td></tr>
                            <tr><th>Making Charge</th><td>₹{{ number_format($product->making_charge, 2) }}</td></tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    <h5 class="fw-bold"><i class="fas fa-align-left me-1 text-primary"></i> Full Description</h5>
                    <div class="text-muted p-2 prose prose-sm max-w-none" style="background: #fdfdfd; border-radius: 4px;">
                        {!! $product->description ?? 'No detailed description provided.' !!}
                    </div>
                </div>

                <div class="mt-5 pt-3 border-top">
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning px-4 me-2">
                        <i class="fas fa-edit me-1"></i> Edit Product
                    </a>
                    <a href="{{ route('products.index') }}" class="btn btn-default px-4">
                        <i class="fas fa-arrow-left me-1"></i> Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    window.changeImage = function(src, thumb) {
        $('#main-display-image').attr('src', src);
        $('.thumb-img').removeClass('active');
        $(thumb).addClass('active');
    }
</script>
@endsection
