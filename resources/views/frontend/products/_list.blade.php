<div class="row row-mtm30">
    @forelse($products as $product)
    <div class="col-6 col-md-4 col-lg-4 mb-4 d-flex" data-animate="animate__fadeIn">
        <div class="single-product w-100">
            <div class="row single-product-wrap">
                <div class="product-image-col">
                    <div class="product-image-cat-variant">
                        <div class="product-image">
                            <a href="{{ route('products.show', $product->id) }}" class="pro-img">
                                <img src="{{ imgPath($product->main_image) }}"
                                    class="w-100 img-fluid img1" alt="{{ $product->name }}">
                                @if($product->gallery && $product->gallery->count() > 0)
                                    <img src="{{ imgPath($product->gallery->first()->image) }}"
                                        class="w-100 img-fluid img2" alt="{{ $product->name }}">
                                @else
                                    <img src="{{ imgPath($product->main_image) }}"
                                        class="w-100 img-fluid img2" alt="{{ $product->name }}">
                                @endif
                                @if($product->discount_price > 0)
                                    <span class="product-label product-label-new product-label-left">Sale</span>
                                @endif
                            </a>
                            <div class="product-action">
                                <a href="javascript:void(0)" class="add-to-wishlist" data-product-id="{{ $product->id }}">
                                    <span class="product-icon"><i
                                            class="ri-heart-line d-block icon-16 lh-1"></i></span>
                                    <span class="tooltip-text">wishlist</span>
                                </a>
                                <a href="javascript:void(0)" class="quick-view dynamic-quickview" data-product-id="{{ $product->id }}">
                                    <span class="product-icon"><i
                                            class="ri-eye-line d-block icon-16 lh-1"></i></span>
                                    <span class="tooltip-text">quickview</span>
                                </a>
                                <a href="javascript:void(0)" class="add-to-cart ajax-add-to-cart" data-product-id="{{ $product->id }}">
                                    <span class="product-icon">
                                        <span class="product-bag-icon icon-16"><i
                                                class="ri-shopping-cart-line d-block lh-1"></i></span>
                                        <span class="product-loader-icon icon-16"><i
                                                class="ri-loader-4-line d-block lh-1"></i></span>
                                        <span class="product-check-icon icon-16"><i
                                                class="ri-check-line d-block lh-1"></i></span>
                                    </span>
                                    <span class="tooltip-text">add to cart</span>
                                </a>
                            </div>
                        </div>
                        <div class="product-cat-variant">
                            <div class="pro-cat-variant">
                                <div class="product-cat">
                                    <span class="d-block">{{ $product->category->name ?? 'Jewelry' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-content">
                    <div class="pro-content">
                        <div class="product-title">
                            <span class="d-block heading-weight"><a href="{{ route('products.show', $product->id) }}"
                                    class="d-block w-100 dominant-link text-truncate">{{ $product->name }}</a></span>
                        </div>
                        <div class="product-price">
                            <div class="price-box heading-weight">
                                @if($product->discount_price > 0)
                                    <span class="new-price dominant-color">{{ number_format($product->discount_price, 2) }}</span>
                                    <span class="old-price ms-2 text-muted text-decoration-line-through">{{ number_format($product->price, 2) }}</span>
                                @else
                                    <span class="new-price dominant-color">{{ number_format($product->price, 2) }}</span>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center py-5">
        <div class="no-products-found">
            <i class="ri-search-line display-4 text-muted mb-3 d-block"></i>
            <h4 class="dominant-color">No products found matching your selection.</h4>
            <p class="text-muted">Try adjusting your filters or search terms.</p>
        </div>
    </div>
    @endforelse
</div>
