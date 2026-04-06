<div class="row row-mtm">
    @forelse($products->take(2) as $product)
    <div class="col-6">
        <a href="{{ route('products.show', $product->id) }}" class="d-block position-relative br-hidden banner-hover pro-img">
            <img src="{{ imgPath($product->main_image) }}" class="w-100 img-fluid border-radius" alt="{{ $product->name }}">
            <span class="collection-banner-label secondary-color position-absolute {{ $loop->first ? 'bottom-0' : 'top-0' }} end-0 width-80 height-80 d-flex flex-column align-items-center justify-content-center extra-bg ptb-5 plr-5 mer-15 mer-sm-30 mer-xxl-50 {{ $loop->first ? 'meb-15 meb-sm-30 meb-xl-50' : 'mst-15 mst-sm-30 mst-xl-50' }} text-center text-uppercase heading-weight lh-1 rounded-circle shadow-sm">
                Only<span class="dominant-color mst-6 text-uppercase">₹{{ number_format($product->effectivePrice(), 0) }}</span>
            </span>
        </a>
    </div>
    @empty
        <div class="col-12 text-center py-5">
            <p class="text-danger">No products found. Please ensure products are assigned to this category.</p>
        </div>
    @endforelse
</div>

<style>
.banner-hover img {
    transition: transform 0.5s ease;
}
.banner-hover:hover img {
    transform: scale(1.05);
}
</style>
