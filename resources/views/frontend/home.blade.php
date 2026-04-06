@extends('layouts.app')

@section('title', 'Treza Jewels - Modern Premium Jewelry Store')


@push('styles')

@endpush

@push('css')
<style>
    .category-product .trend-grid {
        display: grid !important;
        grid-template-columns: repeat(5, minmax(0, 1fr)) !important;
        gap: 28px !important;
        align-items: start;
    }

    .category-product .trend-grid-item {
        display: block !important;
        min-width: 0;
    }

    .category-product .trend-grid .single-product,
    .category-product .trend-grid .single-product-wrap {
        height: 100%;
    }

    .category-product .trend-grid .product-image-cat-variant {
        background: #fff;
        border-radius: 24px;
        overflow: hidden;
        border: 1px solid rgba(201, 169, 97, 0.16);
        box-shadow: 0 18px 40px rgba(59, 43, 31, 0.08);
    }

    .category-product .trend-grid .product-image a.pro-img {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 100% !important;
        height: 320px !important;
        aspect-ratio: 1 / 1.08 !important;
        padding: 18px !important;
        background: #fff !important;
    }

    .category-product .trend-grid .product-image a.pro-img img {
        width: 100% !important;
        height: 100% !important;
        max-width: 100% !important;
        max-height: 100% !important;
        object-fit: contain !important;
        object-position: center !important;
    }

    .category-product .trend-grid .product-content {
        padding: 18px 14px 0 !important;
        text-align: center;
    }

    .category-product .trend-grid .product-title a {
        font-size: 16px !important;
        min-height: 48px;
        white-space: normal !important;
    }

    .category-product .trend-grid .price-box {
        justify-content: center !important;
    }

    @media (max-width: 1199.98px) {
        .category-product .trend-grid {
            grid-template-columns: repeat(4, minmax(0, 1fr)) !important;
        }

        .category-product .trend-grid .product-image a.pro-img {
            height: 290px !important;
        }
    }

    @media (max-width: 991.98px) {
        .category-product .trend-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
            gap: 22px !important;
        }

        .category-product .trend-grid .product-image a.pro-img {
            height: 260px !important;
        }
    }

    @media (max-width: 767.98px) {
        .category-product .trend-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
            gap: 18px !important;
        }

        .category-product .trend-grid .product-image a.pro-img {
            height: 210px !important;
            padding: 12px !important;
        }
    }
</style>
@endpush

@section('content')
    <main id="main">
        <!-- main-slider start -->
        <section class="slider-content bg-img" data-bgimg="{{ asset('assets/images/index2/slider-bgimg.png') }}">
            <div class="home-slider swiper" id="home-slider">
                <div class="swiper-wrapper">
                    @forelse($sliders as $slider)
                    <div class="swiper-slide">
                        <div class="d-flex flex-wrap align-items-center">
                            <div class="col-12 col-md-6">
                                <div class="slider-image">
                                    <img src="{{ imgPath($slider->image) }}" class="w-100 img-fluid"
                                        alt="{{ $slider->title }}" style="min-height: 450px; object-fit: cover;">
                                </div>
                            </div>
                            <div class="col-12 col-md-6 section-ptb bg-transparent">
                                <div
                                    class="col-xl-11 col-xxl-10 mx-xl-auto d-md-flex flex-md-column align-items-md-start justify-content-md-center plr-15 plr-md-30 slider-text-info">
                                    @if($slider->sub_title)
                                    <div class="slider-sub-title dominant-color font-18 text-uppercase mb-3">{{ $slider->sub_title }}</div>
                                    @endif
                                    <h2 class="font-32 font-sm-40 font-xl-64 font-xxl-72 section-heading-family section-heading-text section-heading-weight section-heading-lh">
                                        {{ $slider->title }}
                                    </h2>
                                    @if($slider->link)
                                    <a href="{{ $slider->link }}" class="btn-style dominant-btn mt-5">Shop collection</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <!-- Fallback Slider if none exist in DB -->
                    <div class="swiper-slide">
                        <div class="d-flex flex-wrap">
                            <div class="col-12 col-md-6">
                                <div class="slider-image">
                                    <img src="{{ asset('assets/images/index2/slider-1.jpg')}}" class="w-100 img-fluid"
                                        alt="slider-1" style="min-height: 400px; object-fit: cover;">
                                </div>
                            </div>
                            <div class="col-12 col-md-6 section-ptb bg-transparent">
                                <div
                                    class="col-xl-11 col-xxl-10 mx-xl-auto d-md-flex flex-md-column align-items-md-start justify-content-md-center plr-15 plr-md-30 slider-text-info">
                                <div class="slider-sub-title dominant-color font-18 text-uppercase mb-3">Best starting price 4,500.00</div>
                                <h2 class="font-32 font-sm-40 font-xl-64 font-xxl-72 section-heading-family section-heading-text section-heading-weight section-heading-lh">Luxury Rings that feel timeless</h2>
                                    <a href="{{ route('home.frontend') }}" class="btn-style dominant-btn mt-5">Shop collection</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforelse
                </div>
                <div class="swiper-buttons">
                    <div class="swiper-buttons-wrap">
                        <button type="button" class="swiper-prev swiper-prev-homeslider" aria-label="Arrow previous"><i
                                class="ri-arrow-left-line d-block lh-1"></i></button>
                        <button type="button" class="swiper-next swiper-next-homeslider" aria-label="Arrow next"><i
                                class="ri-arrow-right-line d-block lh-1"></i></button>
                    </div>
                </div>
                <div class="swiper-dots position-absolute bottom-0 start-50 translate-middle-x z-1 mb-4">
                    <div class="swiper-pagination swiper-pagination-homeslider"></div>
                </div>
            </div>
        </section>
        <!-- main-slider end -->
        <!-- category-slider start -->
        <section class="category-slider section-ptb extra-bg">
            <div class="container">
                <div class="cat-block position-relative">
                    <div class="cat-dot position-absolute start-0 width-16 height-16 rounded-circle"></div>
                    <div class="cat-dot position-absolute end-0 width-16 height-16 rounded-circle"></div>
                    <div class="cat-block-wrap">
                        <div class="cat-category">
                            <div class="section-capture text-center" data-animate="animate__fadeIn">
                                <div class="section-title">
                                    <h2 class="section-heading">Shop by categories</h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-10 mx-auto">
                                    <div class="cat-wrap">
                                        <div class="cat-slider swiper" id="cat-slider">
                                            <div class="swiper-wrapper">
                                                @foreach($categories as $category)
                                                    <div class="swiper-slide" data-animate="animate__fadeIn">
                                                        <div class="cat-content text-center">
                                                            <a href="{{ route('products', ['category' => $category->slug]) }}"
                                                                class="d-block cat-content-img position-relative pbp-100">
                                                                <span
                                                                    class="cat-img position-absolute top-0 end-0 bottom-0 start-0 d-flex flex-column align-items-center justify-content-center body-bg mtb-xl-25 mlr-xl-25 rounded-circle">
                                                                    @if($category->image)
                                                                        <img src="{{ imgPath($category->image) }}"
                                                                            class="width-64 img-fluid" alt="{{ $category->name }}">
                                                                    @else
                                                                        <img src="{{ asset('assets/images/index2/cat-1.png') }}"
                                                                            class="width-64 img-fluid" alt="{{ $category->name }}">
                                                                    @endif
                                                                </span>
                                                                <div
                                                                    class="cat-link position-absolute top-0 end-0 bottom-0 start-0 z-1 d-xl-flex align-items-center justify-content-center rounded-circle overflow-hidden">
                                                                    <span
                                                                        class="cat-link-btn extra-color text-uppercase heading-weight">Shop
                                                                        now</span>
                                                                </div>
                                                            </a>
                                                            <h6 class="font-18 mst-26"><a
                                                                    href="{{ route('products', ['category' => $category->slug]) }}"
                                                                    class="dominant-link">{{ $category->name }}</a></h6>
                                                            <a href="{{ route('products', ['category' => $category->slug]) }}"
                                                                class="d-inline-block d-xl-none dominant-link text-uppercase heading-weight mst-12"><span
                                                                    class="d-inline-block cat-link-btn">Shop now</span></a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="swiper-buttons">
                                            <div class="swiper-buttons-wrap">
                                                <button type="button" class="swiper-prev swiper-prev-cat"
                                                    aria-label="Arrow previous"><i
                                                        class="ri-arrow-left-line d-block lh-1"></i></button>
                                                <button type="button" class="swiper-next swiper-next-cat"
                                                    aria-label="Arrow next"><i
                                                        class="ri-arrow-right-line d-block lh-1"></i></button>
                                            </div>
                                        </div>
                                        <div class="swiper-dots" data-animate="animate__fadeIn">
                                            <div class="swiper-pagination swiper-pagination-cat"></div>
                                        </div>
                                        <div class="view-button d-none" data-animate="animate__fadeIn">
                                            <a href="collections.html" class="btn-style secondary-btn">See more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- category-slider end -->
        <!-- collection-tab start -->
        <section class="collection-tab section-ptb extra-bg bst">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-4">
                        <div class="section-capture mb-lg-0 text-center text-lg-start">
                            <div class="section-title" data-animate="animate__fadeIn">
                                <h2 class="section-heading">Best a collection jewellery catalog</h2>
                            </div>
                            <div class="tab mst-13 mst-sm-23 mst-lg-40" data-animate="animate__fadeIn">
                                <ul class="nav nav-tabs flex-lg-column justify-content-center border-0" role="tablist">
                                    @foreach($homeSections as $index => $section)
                                        <li role="presentation">
                                            <a href="#tab-{{ $section->id }}" data-bs-toggle="tab"
                                                class="d-block {{ $index == 0 ? 'active' : '' }}" role="tab"
                                                data-category-id="{{ $section->category_id }}">
                                                <span
                                                    class="collection-tab-title-mobile d-inline-block d-lg-none">{{ $section->title ?? ($section->category->name ?? 'Category') }}</span>
                                                <div class="collection-tab-title-desktop d-none d-lg-flex">
                                                    <span class="collection-tab-img width-48"><img
                                                            src="{{ $section->icon ? imgPath($section->icon) : asset('assets/images/index2/collection-tab1.png') }}"
                                                            class="w-100 img-fluid" alt="{{ $section->title }}"></span>
                                                    <div class="collection-tab-title flex-grow-1 plr-15 text-start">
                                                        <h6 class="font-18 text-dark">
                                                            {{ $section->title ?? ($section->category->name ?? 'Category') }}
                                                        </h6>
                                                        <p class="d-block mst-4 text-muted small">{{ $section->subtitle }}</p>
                                                    </div>
                                                    <div class="collection-tab-counter-icon width-48">
                                                        <div
                                                            class="position-relative width-48 height-48 d-flex align-items-center justify-content-center extra-bg border-full rounded-circle overflow-hidden">
                                                            <span
                                                                class="collection-tab-counter dominant-color">{{ $section->product_count_text }}</span>
                                                            <span
                                                                class="collection-tab-icon extra-color icon-16 position-absolute top-0 end-0 bottom-0 start-0 d-flex align-items-center justify-content-center z-1"><i
                                                                    class="ri-arrow-right-line d-block lh-1"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="view-button d-none d-lg-block text-lg-start" data-animate="animate__fadeIn">
                            <a href="{{ route('products') }}" class="btn-style secondary-btn">View catalog</a>
                        </div>
                    </div>
                    <div class="col-12 col-lg-8">
                        <div class="tab-content" id="best-collection-tab-content">
                            @foreach($homeSections as $index => $section)
                                <div class="tab-pane {{ $index == 0 ? 'active show' : '' }}" id="tab-{{ $section->id }}"
                                    role="tabpanel">
                                    @if($index == 0)
                                        <div class="collection-banner">
                                            @include('frontend.partials.home_category_products', ['products' => $firstSectionProducts, 'categoryId' => $section->category_id])
                                        </div>
                                    @else
                                        <div class="collection-placeholder py-5 text-center">
                                            <div class="spinner-border text-primary" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- collection-tab end -->
        <!-- category-product start -->
        <section class="category-product section-ptb">
            <div class="container-fluid">
                <div class="collection-category">
                    <div class="section-capture text-center" data-animate="animate__fadeIn">
                        <div class="section-title">
                            <h2 class="section-heading">Trending product</h2>
                        </div>
                    </div>
                    <div class="collection-wrap">
                        <div class="trend-grid">
                            @foreach($products as $product)
                                <div class="trend-grid-item" data-animate="animate__fadeIn">
                                    <div class="single-product w-100">
                                        <div class="row single-product-wrap">
                                            <div class="product-image-col">
                                                <div class="product-image-cat-variant">
                                                    <div class="product-image">
                                                        <a href="{{ route('products.show', $product->id) }}" class="pro-img">
                                                            <img src="{{ imgPath($product->main_image) }}" class="w-100 img-fluid img1" alt="{{ $product->name }}">
                                                            @if($product->gallery && $product->gallery->count() > 0)
                                                                <img src="{{ imgPath($product->gallery->first()->image) }}" class="w-100 img-fluid img2" alt="{{ $product->name }}">
                                                            @else
                                                                <img src="{{ imgPath($product->main_image) }}" class="w-100 img-fluid img2" alt="{{ $product->name }}">
                                                            @endif
                                                            @if($product->discount_price > 0)
                                                                <span class="product-label product-label-new product-label-left">Sale</span>
                                                            @endif
                                                        </a>
                                                        <div class="product-action">
                                                            <a href="javascript:void(0)" class="add-to-wishlist" data-product-id="{{ $product->id }}">
                                                                <span class="product-icon"><i class="ri-heart-line d-block icon-16 lh-1"></i></span>
                                                                <span class="tooltip-text">wishlist</span>
                                                            </a>
                                                            <a href="javascript:void(0)" class="quick-view dynamic-quickview" data-product-id="{{ $product->id }}">
                                                                <span class="product-icon"><i class="ri-eye-line d-block icon-16 lh-1"></i></span>
                                                                <span class="tooltip-text">quickview</span>
                                                            </a>
                                                            <a href="javascript:void(0)" class="add-to-cart ajax-add-to-cart" data-product-id="{{ $product->id }}">
                                                                <span class="product-icon">
                                                                    <span class="product-bag-icon icon-16"><i class="ri-shopping-cart-line d-block lh-1"></i></span>
                                                                    <span class="product-loader-icon icon-16"><i class="ri-loader-4-line d-block lh-1"></i></span>
                                                                    <span class="product-check-icon icon-16"><i class="ri-check-line d-block lh-1"></i></span>
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
                                                        <span class="d-block heading-weight"><a href="{{ route('products.show', $product->id) }}" class="d-block w-100 dominant-link text-truncate">{{ $product->name }}</a></span>
                                                    </div>
                                                    <div class="product-price">
                                                        <div class="price-box heading-weight">
                                                            @if($product->discount_price > 0)
                                                                <span class="new-price dominant-color">₹{{ number_format($product->discount_price, 2) }}</span>
                                                                <span class="old-price ms-2 text-muted text-decoration-line-through">₹{{ number_format($product->price, 2) }}</span>
                                                            @else
                                                                <span class="new-price dominant-color">₹{{ number_format($product->price, 2) }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- category-product end -->
        <!-- testimonial start -->
        <section class="testimonial section-ptb">
            <div class="container">
                <div class="testi-category">
                    <div class="section-capture text-center" data-animate="animate__fadeIn">
                        <div class="section-title">
                            <h2 class="section-heading">Happy client say</h2>
                        </div>
                    </div>
                    <div class="testi-wrap">
                        <div class="testi-slider swiper" id="testi-slider">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide" data-animate="animate__fadeIn">
                                    <div class="testi-content extra-bg br-hidden">
                                        <div class="row">
                                            <div
                                                class="col-12 col-md-6 d-md-flex flex-md-column justify-content-md-center ptb-30 text-center text-md-start">
                                                <div class="plr-15 plr-sm-30 per-md-0">
                                                    <span
                                                        class="extra-color product-label-discount d-inline-flex align-items-center ptb-5 plr-15 meb-23 border-radius"><i
                                                            class="ri-star-fill font-12 mer-5"></i>5.0</span>
                                                    <p>Exquisite craftsmanship and timeless designs! Absolutely love these
                                                        pieces.</p>
                                                    <div class="mst-16">
                                                        <span class="dominant-color font-32 extra-font fw-normal">Wesley
                                                            bates</span>
                                                        <h6 class="font-18 mst-6">Luxury expert</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 d-md-flex align-items-md-end text-center">
                                                <img src="{{ asset('assets/images/index2/testi-1.png') }}"
                                                    class="w-100 img-fluid" alt="testi-1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide" data-animate="animate__fadeIn">
                                    <div class="testi-content extra-bg br-hidden">
                                        <div class="row">
                                            <div
                                                class="col-12 col-md-6 d-md-flex flex-md-column justify-content-md-center ptb-30 text-center text-md-start">
                                                <div class="plr-15 plr-sm-30 per-md-0">
                                                    <span
                                                        class="extra-color product-label-discount d-inline-flex align-items-center ptb-5 plr-15 meb-23 border-radius"><i
                                                            class="ri-star-fill font-12 mer-5"></i>4.0</span>
                                                    <p>Elegant and trendy jewelry that enhances any outfit. A must-have
                                                        collection!</p>
                                                    <div class="mst-16">
                                                        <span class="dominant-color font-32 extra-font fw-normal">Carla
                                                            houston</span>
                                                        <h6 class="font-18 mst-6">Fashion stylist</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 d-md-flex align-items-md-end text-center">
                                                <img src="{{ asset('assets/images/index2/testi-2.png') }}"
                                                    class="w-100 img-fluid" alt="testi-2">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide" data-animate="animate__fadeIn">
                                    <div class="testi-content extra-bg br-hidden">
                                        <div class="row">
                                            <div
                                                class="col-12 col-md-6 d-md-flex flex-md-column justify-content-md-center ptb-30 text-center text-md-start">
                                                <div class="plr-15 plr-sm-30 per-md-0">
                                                    <span
                                                        class="extra-color product-label-discount d-inline-flex align-items-center ptb-5 plr-15 meb-23 border-radius"><i
                                                            class="ri-star-fill font-12 mer-5"></i>4.0</span>
                                                    <p>Brilliant quality and intricate details. These designs truly stand
                                                        out!</p>
                                                    <div class="mst-16">
                                                        <span class="dominant-color font-32 extra-font fw-normal">Ashley
                                                            rosa</span>
                                                        <h6 class="font-18 mst-6">Jewelry designer</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 d-md-flex align-items-md-end text-center">
                                                <img src="{{ asset('assets/images/index2/testi-3.png') }}"
                                                    class="w-100 img-fluid" alt="testi-3">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide" data-animate="animate__fadeIn">
                                    <div class="testi-content extra-bg br-hidden">
                                        <div class="row">
                                            <div
                                                class="col-12 col-md-6 d-md-flex flex-md-column justify-content-md-center ptb-30 text-center text-md-start">
                                                <div class="plr-15 plr-sm-30 per-md-0">
                                                    <span
                                                        class="extra-color product-label-discount d-inline-flex align-items-center ptb-5 plr-15 meb-23 border-radius"><i
                                                            class="ri-star-fill font-12 mer-5"></i>4.0</span>
                                                    <p>Brilliant quality and intricate details. These designs truly stand
                                                        out!</p>
                                                    <div class="mst-16">
                                                        <span class="dominant-color font-32 extra-font fw-normal">Lisa
                                                            resnick</span>
                                                        <h6 class="font-18 mst-6">Gemstone specialist</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 d-md-flex align-items-md-end text-center">
                                                <img src="{{ asset('assets/images/index2/testi-4.png') }}"
                                                    class="w-100 img-fluid" alt="testi-4">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-buttons">
                            <div class="swiper-buttons-wrap">
                                <button type="button" class="swiper-prev swiper-prev-testi" aria-label="Arrow previous"><i
                                        class="ri-arrow-left-line d-block lh-1"></i></button>
                                <button type="button" class="swiper-next swiper-next-testi" aria-label="Arrow next"><i
                                        class="ri-arrow-right-line d-block lh-1"></i></button>
                            </div>
                        </div>
                        <div class="swiper-dots" data-animate="animate__fadeIn">
                            <div class="swiper-pagination swiper-pagination-testi"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- testimonial end -->
        <!-- service-area start -->
        <section class="service-area section-ptb bst">
            <div class="container">
                <div class="row row-mtm justify-content-md-center">
                    <div class="col-12 col-md-6 col-lg-3" data-animate="animate__fadeIn">
                        <div class="service-content d-flex flex-column align-items-center text-center">
                            <span class="service-icon dominant-color icon-40"><i
                                    class="ri-box-3-line d-block lh-1"></i></span>
                            <div class="service-text mst-25">
                                <h6 class="font-18">100% Hallmark</h6>
                                <p class="d-block mst-8">Every piece you get fully check</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3" data-animate="animate__fadeIn">
                        <div class="service-content d-flex flex-column align-items-center text-center">
                            <span class="service-icon dominant-color icon-40"><i
                                    class="ri-truck-line d-block lh-1"></i></span>
                            <div class="service-text mst-25">
                                <h6 class="font-18">Free shipping</h6>
                                <p class="d-block mst-8">We ship for free a 100% safe</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3" data-animate="animate__fadeIn">
                        <div class="service-content d-flex flex-column align-items-center text-center">
                            <span class="service-icon dominant-color icon-40"><i
                                    class="ri-reset-right-line d-block lh-1"></i></span>
                            <div class="service-text mst-25">
                                <h6 class="font-18">30 Days return</h6>
                                <p class="d-block mst-8">If ever feel like exchange</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3" data-animate="animate__fadeIn">
                        <div class="service-content d-flex flex-column align-items-center text-center">
                            <span class="service-icon dominant-color icon-40"><i
                                    class="ri-store-2-line d-block lh-1"></i></span>
                            <div class="service-text mst-25">
                                <h6 class="font-18">24x7 live support</h6>
                                <p class="d-block mst-8">Every time customer support</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- service-area end -->
        <!-- blog-area start -->
        <section class="blog-area section-ptb extra-bg">
            <div class="container">
                <div class="blog-category">
                    <div class="section-capture text-center" data-animate="animate__fadeIn">
                        <div class="section-title">
                            <h2 class="section-heading">Every recent blog</h2>
                        </div>
                    </div>
                    <div class="blog-wrap">
                        <div class="blog-slider swiper" id="blog-slider">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide" data-animate="animate__fadeIn">
                                    <div class="blog-post banner-hover">
                                        <div class="blog-main-img">
                                            <a href="article-left.html"
                                                class="d-block banner-img position-relative br-hidden">
                                                <img src="{{ asset('assets/images/index2/article/a-1.jpg') }}"
                                                    class="w-100 img-fluid" alt="a-1">
                                                <span
                                                    class="secondary-color font-20 position-absolute start-0 bottom-0 width-64 height-64 d-flex flex-column align-items-center justify-content-center extra-bg ptb-5 plr-5 msl-20 meb-20 text-center heading-weight lh-1 border-radius">25<span
                                                        class="dominant-color font-12 mst-5 text-uppercase">Nov</span></span>
                                            </a>
                                        </div>
                                        <div class="blog-post-content pst-15">
                                            <h6 class="font-18">Gold ring best for you</h6>
                                            <p class="mst-8">All the lorem Ipsum generators on the Internet tend to repeat
                                                predefined chunks as necessary, making this the first true generator!</p>
                                            <a href="article-left.html" class="btn-style secondary-btn mst-13">Read more</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide" data-animate="animate__fadeIn">
                                    <div class="blog-post banner-hover">
                                        <div class="blog-main-img">
                                            <a href="article-left.html"
                                                class="d-block banner-img position-relative br-hidden">
                                                <img src="{{ asset('assets/images/index2/article/a-2.jpg') }}"
                                                    class="w-100 img-fluid" alt="a-2">
                                                <span
                                                    class="secondary-color font-20 position-absolute start-0 bottom-0 width-64 height-64 d-flex flex-column align-items-center justify-content-center extra-bg ptb-5 plr-5 msl-20 meb-20 text-center heading-weight lh-1 border-radius">25<span
                                                        class="dominant-color font-12 mst-5 text-uppercase">Nov</span></span>
                                            </a>
                                        </div>
                                        <div class="blog-post-content pst-15">
                                            <h6 class="font-18">Shiny gems look so new</h6>
                                            <p class="mst-8">All the lorem Ipsum generators on the Internet tend to repeat
                                                predefined chunks as necessary, making this the first true generator!</p>
                                            <a href="article-left.html" class="btn-style secondary-btn mst-13">Read more</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide" data-animate="animate__fadeIn">
                                    <div class="blog-post banner-hover">
                                        <div class="blog-main-img">
                                            <a href="article-left.html"
                                                class="d-block banner-img position-relative br-hidden">
                                                <img src="{{ asset('assets/images/index2/article/a-3.jpg') }}"
                                                    class="w-100 img-fluid" alt="a-3">
                                                <span
                                                    class="secondary-color font-20 position-absolute start-0 bottom-0 width-64 height-64 d-flex flex-column align-items-center justify-content-center extra-bg ptb-5 plr-5 msl-20 meb-20 text-center heading-weight lh-1 border-radius">25<span
                                                        class="dominant-color font-12 mst-5 text-uppercase">Nov</span></span>
                                            </a>
                                        </div>
                                        <div class="blog-post-content pst-15">
                                            <h6 class="font-18">Fine hoop drop nice set</h6>
                                            <p class="mst-8">All the lorem Ipsum generators on the Internet tend to repeat
                                                predefined chunks as necessary, making this the first true generator!</p>
                                            <a href="article-left.html" class="btn-style secondary-btn mst-13">Read more</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide" data-animate="animate__fadeIn">
                                    <div class="blog-post banner-hover">
                                        <div class="blog-main-img">
                                            <a href="article-left.html"
                                                class="d-block banner-img position-relative br-hidden">
                                                <img src="{{ asset('assets/images/index2/article/a-4.jpg') }}"
                                                    class="w-100 img-fluid" alt="a-4">
                                                <span
                                                    class="secondary-color font-20 position-absolute start-0 bottom-0 width-64 height-64 d-flex flex-column align-items-center justify-content-center extra-bg ptb-5 plr-5 msl-20 meb-20 text-center heading-weight lh-1 border-radius">25<span
                                                        class="dominant-color font-12 mst-5 text-uppercase">Nov</span></span>
                                            </a>
                                        </div>
                                        <div class="blog-post-content pst-15">
                                            <h6 class="font-18">Pure glow band top pick</h6>
                                            <p class="mst-8">All the lorem Ipsum generators on the Internet tend to repeat
                                                predefined chunks as necessary, making this the first true generator!</p>
                                            <a href="article-left.html" class="btn-style secondary-btn mst-13">Read more</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide" data-animate="animate__fadeIn">
                                    <div class="blog-post banner-hover">
                                        <div class="blog-main-img">
                                            <a href="article-left.html"
                                                class="d-block banner-img position-relative br-hidden">
                                                <img src="{{ asset('assets/images/index2/article/a-5.jpg') }}"
                                                    class="w-100 img-fluid" alt="a-5">
                                                <span
                                                    class="secondary-color font-20 position-absolute start-0 bottom-0 width-64 height-64 d-flex flex-column align-items-center justify-content-center extra-bg ptb-5 plr-5 msl-20 meb-20 text-center heading-weight lh-1 border-radius">25<span
                                                        class="dominant-color font-12 mst-5 text-uppercase">Nov</span></span>
                                            </a>
                                        </div>
                                        <div class="blog-post-content pst-15">
                                            <h6 class="font-18">Necklace gift for her now</h6>
                                            <p class="mst-8">All the lorem Ipsum generators on the Internet tend to repeat
                                                predefined chunks as necessary, making this the first true generator!</p>
                                            <a href="article-left.html" class="btn-style secondary-btn mst-13">Read more</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide" data-animate="animate__fadeIn">
                                    <div class="blog-post banner-hover">
                                        <div class="blog-main-img">
                                            <a href="article-left.html"
                                                class="d-block banner-img position-relative br-hidden">
                                                <img src="{{ asset('assets/images/index2/article/a-6.jpg') }}"
                                                    class="w-100 img-fluid" alt="a-6">
                                                <span
                                                    class="secondary-color font-20 position-absolute start-0 bottom-0 width-64 height-64 d-flex flex-column align-items-center justify-content-center extra-bg ptb-5 plr-5 msl-20 meb-20 text-center heading-weight lh-1 border-radius">25<span
                                                        class="dominant-color font-12 mst-5 text-uppercase">Nov</span></span>
                                            </a>
                                        </div>
                                        <div class="blog-post-content pst-15">
                                            <h6 class="font-18">Charm studs love this buy</h6>
                                            <p class="mst-8">All the lorem Ipsum generators on the Internet tend to repeat
                                                predefined chunks as necessary, making this the first true generator!</p>
                                            <a href="article-left.html" class="btn-style secondary-btn mst-13">Read more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-buttons">
                            <div class="swiper-buttons-wrap">
                                <button type="button" class="swiper-prev swiper-prev-blog" aria-label="Arrow previous"><i
                                        class="ri-arrow-left-line d-block lh-1"></i></button>
                                <button type="button" class="swiper-next swiper-next-blog" aria-label="Arrow next"><i
                                        class="ri-arrow-right-line d-block lh-1"></i></button>
                            </div>
                        </div>
                        <div class="swiper-dots" data-animate="animate__fadeIn">
                            <div class="swiper-pagination swiper-pagination-blog"></div>
                        </div>
                        <div class="view-button d-none" data-animate="animate__fadeIn">
                            <a href="blog.html" class="btn-style secondary-btn">See more</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- blog-area end -->
    </main>
    @push('js')
        <script>
            $(document).ready(function () {
                $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
                    var target = $(e.target).attr("href");
                    var categoryId = $(e.target).data('category-id');

                    if (categoryId && $(target).find('.collection-banner').length == 0) {
                        $.ajax({
                            url: '/get-category-products/' + categoryId,
                            method: 'GET',
                            success: function (response) {
                                $(target).html('<div class="collection-banner">' + response + '</div>');
                            },
                            error: function () {
                                $(target).html('<div class="alert alert-danger m-3">Error loading products.</div>');
                            }
                        });
                    }
                });
            });
        </script>
    @endpush
@endsection
