@extends('layouts.app')

@section('title', $product->name . ' - Treza Jewels')

@section('content')
<!-- breadcrumb-area start -->
<div class="breadcrumb-area ptb-15" data-bgimg="{{ asset('assets/images/other/breadcrumb-bgimg.jpg') }}">
    <div class="container">
        <span class="d-block extra-color">
            <a href="{{ url('/') }}" class="extra-color">Home</a> / 
            <a href="{{ route('products') }}" class="extra-color">Shop</a> / 
            {{ $product->name }}
        </span>
    </div>
</div>
<!-- breadcrumb-area end -->

<!-- main start -->
<main id="main">
    <!-- product-detail start -->
    <section class="product-detail section-pt">
        <div class="container">
            <div class="product-detail-area row row-mtm position-relative">
                <div class="product-detail-image col-12 col-lg-6 p-lg-sticky top-0" data-animate="animate__fadeIn">
                    <!-- product-detail-slider start -->
                    <div class="product-detail-slider per-xxl-10">
                        <div class="row ul-mt15">
                            <div class="col-12" data-animate="animate__fadeIn">
                                <!-- product-img-big start -->
                                <div class="product-img-big slider-big-h position-relative br-hidden">
                                    <div class="swiper" id="slider-big-h">
                                        <div class="swiper-wrapper product-swiper-wrapper">
                                            @if($product->gallery && $product->gallery->count() > 0)
                                                @foreach($product->gallery as $image)
                                                    <div class="swiper-slide product-swiper-slide">
                                                        <div class="product-item-img position-relative">
                                                            <a href="{{ imgPath($image->image) }}" class="full-view product-thumbnail heading-color position-absolute top-0 end-0 width-40 height-40 d-flex align-items-center justify-content-center body-bg z-1 mst-15 mer-15 rounded-circle box-shadow" aria-label="Image full view"><i class="ri-fullscreen-line d-block lh-1"></i></a>
                                                            <img src="{{ imgPath($image->image) }}" data-zoom="{{ imgPath($image->image) }}" class="w-100 img-fluid zoom" alt="{{ $product->name }}">
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="swiper-slide product-swiper-slide">
                                                    <div class="product-item-img position-relative">
                                                        @php
                                                            $mainImage = $product->main_image ? imgPath($product->main_image) : asset('assets/images/index/product/p-1.jpg');
                                                        @endphp
                                                        <a href="{{ $mainImage }}" class="full-view product-thumbnail heading-color position-absolute top-0 end-0 width-40 height-40 d-flex align-items-center justify-content-center body-bg z-1 mst-15 mer-15 rounded-circle box-shadow" aria-label="Image full view"><i class="ri-fullscreen-line d-block lh-1"></i></a>
                                                        <img src="{{ $mainImage }}" data-zoom="{{ $mainImage }}" class="w-100 img-fluid zoom" alt="{{ $product->name }}">
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="swiper-buttons">
                                        <button type="button" class="swiper-prev swiper-prev-big secondary-btn icon-16 width-40 height-40 position-absolute top-50 translate-middle-y z-1 rounded-circle" aria-label="Arrow previous"><i class="ri-arrow-left-line d-block lh-1"></i></button>
                                        <button type="button" class="swiper-next swiper-next-big secondary-btn icon-16 width-40 height-40 position-absolute top-50 translate-middle-y z-1 rounded-circle" aria-label="Arrow next"><i class="ri-arrow-right-line d-block lh-1"></i></button>
                                    </div>
                                </div>
                                <!-- product-img-big end -->
                            </div>
                            <div class="col-12" data-animate="animate__fadeIn">
                                <!-- product-img-small start -->
                                <div class="product-img-small slider-small-h">
                                    <div class="swiper" id="slider-small-h">
                                        <div class="swiper-wrapper">
                                            @if($product->gallery && $product->gallery->count() > 0)
                                                @foreach($product->gallery as $image)
                                                    <div class="swiper-slide product-swiper-slide">
                                                        <div class="product-item-img br-hidden">
                                                            <a href="javascript:void(0)" class="d-block product-thumbnail">
                                                                <img src="{{ imgPath($image->image) }}" class="w-100 img-fluid" alt="{{ $product->name }}">
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="swiper-slide product-swiper-slide">
                                                    <div class="product-item-img br-hidden">
                                                        <a href="javascript:void(0)" class="d-block product-thumbnail">
                                                            <img src="{{ $mainImage ?? asset('assets/images/index/product/p-1.jpg') }}" class="w-100 img-fluid" alt="{{ $product->name }}">
                                                        </a>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- product-img-small end -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6 p-lg-sticky top-0" data-animate="animate__fadeIn">
                    <div class="product-detail-info">
                        <div class="product-title meb-13">
                            <span class="d-inline-block product-vendor heading-color text-uppercase heading-weight meb-8"><a href="javascript:void(0)">{{ $product->category->name ?? 'Category' }}</a></span>
                            <h2 class="title heading-color font-24">{{ $product->name }}</h2>
                        </div>
                        
                        <div class="product-ratting mst-11">
                            <span class="review-ratting">
                                <span class="review-star icon-16">
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-half-fill"></i>
                                </span>
                            </span>
                            <span class="review-amount msl-4">5 reviews</span>
                        </div>
                        
                        <div class="product-price price-box mst-19 font-20 heading-weight">
                            <span class="new-price dominant-color">{{ number_format($product->price, 2) }}</span>
                            @if(false) <!-- Replace with old price logic if you have it -->
                                <span class="old-price"><span class="mer-3">~</span><span class="text-decoration-line-through">89.00</span></span>
                            @endif
                        </div>

                        <div class="product-desc mst-15">
                            <div>{!! $product->description !!}</div>
                        </div>
                        
                        <div class="product-availabile mst-15">
                            @if($product->quantity > 0)
                                <div class="stock">Availability: <span class="text-success heading-weight"><i class="ri-check-line icon-16 mr-1"></i>In stock ({{ $product->quantity }})</span></div>
                            @else
                                <div class="stock text-danger">Availability: <span class="heading-weight"><i class="ri-close-line icon-16 mr-1"></i>Out of stock</span></div>
                            @endif
                            <div class="sku mst-5">SKU: <span class="heading-weight">{{ $product->sku ?? 'N/A' }}</span></div>
                        </div>

                        @if($product->quantity > 0)
                        <div class="product-stock mst-25">
                            <p class="meb-8">Hurry up! only <span class="heading-weight text-danger">{{ $product->quantity }}</span> products left in stock!</p>
                            <span class="product-stock-bar d-block position-relative secondary-bg"><span class="product-stock-width d-block position-absolute top-0 bottom-0 start-0 dominant-bg" style="width: {{ min(100, max(5, $product->quantity)) }}%;"></span></span>
                        </div>
                        @endif

                        <form method="post" action="javascript:void(0)" class="product-form mst-25">
                            <div class="product-action-detail mst-30 pt-30 btt d-flex flex-wrap align-items-end">
                                <div class="product-quantity mt-15 mt-sm-0 me-3">
                                    <span class="d-inline-block text-uppercase heading-color heading-weight meb-11">Quantity:</span>
                                    <div class="js-qty-wrapper">
                                        <div class="js-qty-wrap d-flex extra-bg border-full br-hidden">
                                            <button type="button" class="js-qty-adjust js-qty-adjust-minus body-color icon-16" aria-label="Remove item"><i class="ri-subtract-line d-block lh-1"></i></button>
                                            <input type="number" name="quantity" class="js-qty-num qty-num p-0 text-center border-0" value="1" min="1" max="{{ $product->quantity > 0 ? $product->quantity : 1 }}" />
                                            <button type="button" class="js-qty-adjust js-qty-adjust-plus body-color icon-16" aria-label="Add item"><i class="ri-add-line d-block lh-1"></i></button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="product-action mt-15 mt-sm-0">
                                    <button type="button" class="btn-style secondary-btn add-to-cart ajax-add-to-cart @if($product->quantity <= 0) disabled @endif" data-product-id="{{ $product->id }}" @if($product->quantity <= 0) disabled @endif>
                                        <span class="product-bag-icon mer-5"><i class="ri-shopping-bag-3-line icon-16 lh-1"></i></span>
                                        <span class="product-loader-icon icon-16 lh-1 mer-5" style="display: none;"><i class="ri-loader-4-line"></i></span>
                                        <span class="product-check-icon icon-16 lh-1 mer-5" style="display: none;"><i class="ri-check-line"></i></span>
                                        Add to cart
                                    </button>
                                    <a href="javascript:void(0)" class="add-to-wishlist h-100 d-inline-flex align-items-center justify-content-center body-color ml-2" title="Add to Wishlist" data-product-id="{{ $product->id }}">
                                        <span class="product-icon"><i class="ri-heart-line d-block icon-16 lh-1"></i></span>
                                    </a>
                                </div>
                            </div>
                        </form>
                        
                        <div class="product-info mst-20" data-animate="animate__fadeIn">
                            <div class="product-border bst"></div>
                        </div>

                        <div class="product-info mst-15" data-animate="animate__fadeIn">
                            <div class="product-service">
                                <div class="ul-mt15 row">
                                    <div class="col-6 col-sm-3 d-flex">
                                        <div class="w-100 heading-color d-flex flex-column align-items-center ptb-15 plr-15 extra-bg text-center br-hidden">
                                            <span class="icon-24"><i class="ri-box-3-line d-block lh-1"></i></span>
                                            <span class="mst-12 text-sm">Return & exchange</span>
                                        </div>
                                    </div>
                                    <div class="col-6 col-sm-3 d-flex">
                                        <div class="w-100 heading-color d-flex flex-column align-items-center ptb-15 plr-15 extra-bg text-center br-hidden">
                                            <span class="icon-24"><i class="ri-hand-coin-line d-block lh-1"></i></span>
                                            <span class="mst-12 text-sm">Cash on delivery</span>
                                        </div>
                                    </div>
                                    <div class="col-6 col-sm-3 d-flex">
                                        <div class="w-100 heading-color d-flex flex-column align-items-center ptb-15 plr-15 extra-bg text-center br-hidden">
                                            <span class="icon-24"><i class="ri-truck-line d-block lh-1"></i></span>
                                            <span class="mst-12 text-sm">Free delivery</span>
                                        </div>
                                    </div>
                                    <div class="col-6 col-sm-3 d-flex">
                                        <div class="w-100 heading-color d-flex flex-column align-items-center ptb-15 plr-15 extra-bg text-center br-hidden">
                                            <span class="icon-24"><i class="ri-secure-payment-line d-block lh-1"></i></span>
                                            <span class="mst-12 text-sm">Safe payment</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product-detail end -->

    <!-- product-detail-tab start -->
    <section class="product-detail-tab section-ptb">
        <div class="container">
            <div class="product-tab horizontal-tab">
                <div class="product-tab-nav beb" data-animate="animate__fadeIn">
                    <ul class="nav nav-tabs ul-tab border-0" role="tablist">
                        <li>
                            <a href="#pro-desc-tab" class="d-block peb-11 heading-weight active mer-md-40 mer-20" data-bs-toggle="tab" role="tab" aria-selected="true">Description</a>
                        </li>
                        <li>
                            <a href="#pro-ai-tab" class="d-block peb-11 heading-weight mer-md-40 mer-20" data-bs-toggle="tab" role="tab" aria-selected="false">Additional Info</a>
                        </li>
                    </ul>
                </div>
                <div class="product-tab-info tab-content mst-30" data-animate="animate__fadeIn">
                    <div class="tab-pane fade active show" id="pro-desc-tab">
                        <div class="product-tab-description">
                            <div class="product-description-info">
                                <h6 class="font-18 meb-15">About this product</h6>
                                <div class="body-dominant-color line-height-2" style="white-space: pre-wrap;">{!! $product->description ?? 'No description available for this product.' !!}</div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pro-ai-tab">
                        <div class="product-tab-ai">
                            <table class="w-100 table-bordered">
                                <tbody>
                                    @if($product->metal_type)
                                    <tr>
                                        <th class="heading-color ptb-10 plr-15 heading-weight border-full" scope="row">Metal Type</th>
                                        <td class="ptb-10 plr-15 border-full">{{ $product->metal_type }}</td>
                                    </tr>
                                    @endif
                                    @if($product->purity)
                                    <tr>
                                        <th class="heading-color ptb-10 plr-15 heading-weight border-full" scope="row">Purity</th>
                                        <td class="ptb-10 plr-15 border-full">{{ $product->purity }}</td>
                                    </tr>
                                    @endif
                                    @if($product->weight)
                                    <tr>
                                        <th class="heading-color ptb-10 plr-15 heading-weight border-full" scope="row">Weight</th>
                                        <td class="ptb-10 plr-15 border-full">{{ $product->weight }}</td>
                                    </tr>
                                    @endif
                                    @if($product->stone_type)
                                    <tr>
                                        <th class="heading-color ptb-10 plr-15 heading-weight border-full" scope="row">Stone Type</th>
                                        <td class="ptb-10 plr-15 border-full">{{ $product->stone_type }}</td>
                                    </tr>
                                    @endif
                                    @if($product->stone_weight)
                                    <tr>
                                        <th class="heading-color ptb-10 plr-15 heading-weight border-full" scope="row">Stone Weight</th>
                                        <td class="ptb-10 plr-15 border-full">{{ $product->stone_weight }}</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                            @if(!$product->metal_type && !$product->purity && !$product->weight && !$product->stone_type && !$product->stone_weight)
                                <p>No additional information available.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product-detail-tab end -->

    <!-- related-product start -->
    @if($relatedProducts->count() > 0)
    <section class="related-area section-ptb">
        <div class="container">
            <div class="collection-category">
                <div class="section-capture text-center" data-animate="animate__fadeIn">
                    <div class="section-title">
                        <h2 class="section-heading">Related product</h2>
                    </div>
                </div>
                <div class="collection-wrap">
                    <div class="related-slider swiper" id="related-slider">
                        <div class="swiper-wrapper">
                            @foreach($relatedProducts as $relProduct)
                            <div class="swiper-slide h-auto d-flex" data-animate="animate__fadeIn">
                                <div class="single-product w-100">
                                    <div class="row single-product-wrap">
                                        <div class="product-image">
                                            <a href="{{ route('products.show', $relProduct->id) }}" class="pro-img">
                                                @if($relProduct->gallery->count() > 0)
                                                    <img src="{{ imgPath($relProduct->gallery[0]->image) }}" class="w-100 img-fluid img1" alt="{{ $relProduct->name }}">
                                                    @if($relProduct->gallery->count() > 1)
                                                        <img src="{{ imgPath($relProduct->gallery[1]->image) }}" class="w-100 img-fluid img2" alt="{{ $relProduct->name }}">
                                                    @endif
                                                @else
                                                    <img src="{{ asset('assets/images/index/product/p-1.jpg') }}" class="w-100 img-fluid img1" alt="Placeholder">
                                                @endif
                                            </a>
                                            <div class="product-action">
                                                <a href="#quickview-modal" data-bs-toggle="modal" class="quick-view" onclick="document.getElementById('quickview-content-body').innerHTML='<div class=\'text-center p-5\'><i class=\'ri-loader-4-line ri-spin fs-1\'></i></div>'; fetch('{{ route('products.quickview', $relProduct->id) }}').then(r=>r.text()).then(html=>{ document.getElementById('quickview-content-body').innerHTML=html; ST.quickviewSlider.init(); });">
                                                    <span class="product-icon">Quickview</span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <div class="pro-content">
                                                <div class="pro-content-action">
                                                    <div class="product-title">
                                                        <span class="d-block meb-8">{{ $relProduct->category->name ?? 'Category' }}</span>
                                                        <span class="d-block heading-weight"><a href="{{ route('products.show', $relProduct->id) }}" class="d-block w-100 dominant-link text-truncate">{{ $relProduct->name }}</a></span>
                                                    </div>
                                                    <div class="pro-price-action">
                                                        <div class="price-box heading-weight">
                                                            <span class="new-price dominant-color">{{ number_format($relProduct->price, 2) }}</span>
                                                        </div>
                                                        <div class="product-action">
                                                            <a href="{{ route('products.show', $relProduct->id) }}" class="add-to-cart">
                                                                <span class="product-icon">
                                                                    <span class="product-bag-icon icon-16"><i class="ri-eye-line d-block lh-1"></i></span>
                                                                </span>
                                                                <span class="tooltip-text">view details</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="swiper-buttons">
                            <div class="swiper-buttons-wrap">
                                <button type="button" class="swiper-prev swiper-prev-related" aria-label="Arrow previous"><i class="ri-arrow-left-line d-block lh-1"></i></button>
                                <button type="button" class="swiper-next swiper-next-related" aria-label="Arrow next"><i class="ri-arrow-right-line d-block lh-1"></i></button>
                            </div>
                        </div>
                        <div class="swiper-dots" data-animate="animate__fadeIn">
                            <div class="swiper-pagination swiper-pagination-related"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    <!-- related-product end -->
</main>
@endsection
