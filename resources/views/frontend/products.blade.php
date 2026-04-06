@extends('layouts.app')

@section('title', 'Products - Treza Jewels')
@section('body-class', 'without-shop-sidebar')

@section('content')
<!-- breadcrumb-area start -->
        <div class="breadcrumb-area ptb-15" data-bgimg="{{ asset('assets/images/other/breadcrumb-bgimg.jpg') }}">
            <div class="container">
                <span class="d-block extra-color"><a href="{{ url('/') }}" class="extra-color">Home</a> / Collection without sidebar</span>
            </div>
        </div>
        <!-- breadcrumb-area end -->
<!-- main start -->
        <main id="main">
            <!-- shop-content start -->
            <section class="shop-content section-ptb">
                <div class="container">
                    <!-- shop-sidebar start -->
                    <div class="shop-sidebar-wrap shop-filter-sidebar" data-animate="animate__fadeIn">
                        <button type="button" class="shop-sidebar-close body-secondary-color icon-16 position-absolute" aria-label="Close"><i class="ri-close-large-line d-block lh-1"></i></button>
                        <form class="shop-form" action="{{ route('products') }}" method="GET" id="shopForm">
                            @if(request('category'))
                                <input type="hidden" name="category" value="{{ request('category') }}">
                            @endif
                            <!-- shop-categories start -->
                            <div class="shop-sidebar shop-categories">
                                <h6 class="font-18">Categories</h6>
                                <div class="shop-cat-post mst-22">
                                    <div class="shop-cat ul-mtm-15">
                                        @foreach($categories as $category)
                                            <a href="{{ request()->fullUrlWithQuery(['category' => $category->slug]) }}" class="{{ request('category') == $category->slug ? 'dominant-color fw-bold' : 'body-dominant-color' }} d-flex align-items-center justify-content-between">
                                                <span>{{ $category->name }}</span>
                                                <span>{{ $category->products_count }}</span>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!-- shop-categories end -->
                            <!-- shop-availability start -->
                            <div class="shop-sidebar availability">
                                <h6 class="font-18">Availability</h6>
                                <div class="shop-header d-flex justify-content-between mst-22">
                                    <span class="shop-selected">2 selected</span>
                                    <button type="submit" class="shop-reset body-secondary-color text-decoration-underline">Reset</button>
                                </div>
                                <div class="shop-element mst-23">
                                    <ul class="shop-filters ul-mtm-15">
                                        <li>
                                            <label class="cust-checkbox-label d-flex align-items-center justify-content-between">
                                                <input type="checkbox" id="shop-in-stock" name="shop-in-stock" class="cust-checkbox" value="1" {{ request('shop-in-stock') ? 'checked' : '' }} onchange="this.form.submit()">
                                                <span class="d-block cust-check"></span>
                                                <span class="shop-name me-auto">In stock</span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="cust-checkbox-label d-flex align-items-center justify-content-between">
                                                <input type="checkbox" id="shop-out-of-stock" name="shop-out-of-stock" class="cust-checkbox" value="1" {{ request('shop-out-of-stock') ? 'checked' : '' }} onchange="this.form.submit()">
                                                <span class="d-block cust-check"></span>
                                                <span class="shop-name me-auto">Out of stock</span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- shop-sidebar availability end -->
                            <!-- shop-sidebar price start -->
                            <div class="shop-sidebar price">
                                <h6 class="font-18">Price</h6>
                                <div class="shop-header d-flex justify-content-between mst-22">
                                    <span class="shop-selected">The highest price is 89.00</span>
                                    <button type="submit" class="shop-reset body-secondary-color text-decoration-underline">Reset</button>
                                </div>
                                <div class="shop-element mst-26">
                                    <div class="price-input-range">
                                        <div class="price-range">
                                            <div class="price-container">
                                                <div class="price-slider"></div>
                                            </div>
                                            <div class="range-input position-relative">
                                                <input type="range" class="min-range position-absolute w-100 p-0 bg-transparent border-0" min="0" max="89" value="0" step="1">
                                                <input type="range" class="max-range position-absolute w-100 p-0 bg-transparent border-0" min="0" max="89" value="89" step="1">
                                            </div>
                                        </div>
                                        <div class="price-input d-flex align-items-center mst-30">
                                            <div class="price-field position-relative w-100">
                                                <span class="price-input-title position-absolute top-0 start-0">From</span>
                                                <span class="price-input-prefix position-absolute top-50 translate-middle-y"></span>
                                                <input type="number" id="min-price" name="min-price" class="min-input w-100 h-100 text-end" min="0" max="{{ $maxDbPrice }}" value="{{ request('min-price', 0) }}">
                                            </div>
                                            <div class="price-input-separator mlr-15">-</div>
                                            <div class="price-field position-relative w-100">
                                                <span class="price-input-title position-absolute top-0 start-0">To</span>
                                                <span class="price-input-prefix position-absolute top-50 translate-middle-y"></span>
                                                <input type="number" id="max-price" name="max-price" class="max-input w-100 h-100 text-end" min="0" max="{{ $maxDbPrice }}" value="{{ request('max-price', $maxDbPrice) }}">
                                            </div>
                                            <button type="submit" class="btn btn-sm btn-primary ms-2" style="padding: 10px;">Apply</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- shop-sidebar price end -->
                        </form>
                    </div>
                    <!-- shop-sidebar end -->
                    <!-- collection-info start -->
                    <div class="row row-mtm" data-animate="animate__fadeIn">
                        <!-- collection-img start -->
                        <div class="collection-img">
                            <h6 class="font-18 meb-25 dominant-color">Collection ({{ $products->total() }})</h6>
                            <img src="{{ asset('assets/images/collection/collection-banner.jpg') }}" class="w-100 img-fluid border-radius" alt="collection-banner">
                        </div>
                        <!-- collection-img end -->
                        <!-- shop-top-bar start -->
                        <div class="shop-top-bar">
                            <div class="row row-mtm15 align-items-md-center">
                                <div class="col-12 col-sm-6 col-md-7 col-lg-8">
                                    <div class="shop-filter-view ul-mt15 align-items-center">
                                        <!-- shop-filter start -->
                                        <div class="shop-filter">
                                            <button type="button" class="shop-filter-btn dominant-color d-flex align-items-center"><i class="ri-filter-line icon-16 mer-5"></i>Filter</button>
                                        </div>
                                        <!-- shop-filter end -->
                                        <!-- shop-view-mode start -->
                                        <div class="shop-view-mode">
                                            <div class="ul-mt10">
                                                <button type="button" class="shop-view-btn dominant-color icon-16 opacity-100 disabled" data-view="grid" aria-label="Grid view"><i class="ri-layout-grid-line"></i></button>
                                                <button type="button" class="shop-view-btn body-color icon-16 opacity-100" data-view="list" aria-label="List view"><i class="ri-list-unordered"></i></button>
                                            </div>
                                        </div>
                                        <!-- shop-view-mode end -->
                                        <!-- shop-show-product start -->
                                        <div class="shop-show-product">Showing {{ $products->firstItem() }}-{{ $products->lastItem() }} of {{ $products->total() }} products</div>
                                        <!-- shop-show-product end -->
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-5 col-lg-4">
                                    <!-- shop-short start -->
                                    <div class="shop-short d-flex flex-wrap position-relative">
                                        <label for="sortby" class="width-72 secondary-color heading-weight">Sort by:</label>
                                        <select id="sortby" name="sortby" class="d-xl-none width-calc-72 h-auto ptb-0 bg-transparent border-0">
                                            <option value="manual">Featured</option>
                                            <option value="best-selling">Best selling</option>
                                            <option value="title-ascending" selected>Alphabetically, A-Z</option>
                                            <option value="title-descending">Alphabetically, Z-A</option>
                                            <option value="price-ascending">Price, low to high</option>
                                            <option value="price-descending">Price, high to low</option>
                                            <option value="created-descending">Date, new to old</option>
                                            <option value="created-ascending">Date, old to new</option>
                                        </select>
                                        <a href="javascript:void(0)" class="short-title width-calc-72 body-color d-none d-xl-flex align-items-xl-start justify-content-xl-between">
                                            <span class="sort-title">Alphabetically, A-Z</span>
                                            <span class="sort-icon heading-weight"><i class="ri-arrow-down-s-line d-block lh-1"></i></span>
                                        </a>
                                        <ul class="collapse position-absolute top-100 start-0 end-0 ptb-5 body-bg z-1 DropDownSlide br-hidden box-shadow" id="select-wrap">
                                            <li><a href="javascript:void(0)" data-value="manual" class="d-block body-dominant-color ptb-5 plr-15">Featured</a></li>
                                            <li><a href="javascript:void(0)" data-value="best-selling" class="d-block body-dominant-color ptb-5 plr-15">Best selling</a></li>
                                            <li class="selected"><a href="javascript:void(0)" data-value="title-ascending" class="d-block secondary-color ptb-5 plr-15 extra-bg">Alphabetically, A-Z</a></li>
                                            <li><a href="javascript:void(0)" data-value="title-descending" class="d-block body-dominant-color ptb-5 plr-15">Alphabetically, Z-A</a></li>
                                            <li><a href="javascript:void(0)" data-value="price-ascending" class="d-block body-dominant-color ptb-5 plr-15">Price, low to high</a></li>
                                            <li><a href="javascript:void(0)" data-value="price-descending" class="d-block body-dominant-color ptb-5 plr-15">Price, high to low</a></li>
                                            <li><a href="javascript:void(0)" data-value="created-descending" class="d-block body-dominant-color ptb-5 plr-15">Date, new to old</a></li>
                                            <li><a href="javascript:void(0)" data-value="created-ascending" class="d-block body-dominant-color ptb-5 plr-15">Date, old to new</a></li>
                                        </ul>
                                    </div>
                                    <!-- shop-short end -->
                                </div>
                            </div>
                        </div>
                        <!-- shop-top-bar end -->
                        <!-- shop-filter-list start -->
                        <div class="shop-filter-list d-flex align-items-start justify-content-between">
                            <ul class="shop-filter-ul ul-mt5 align-items-center">
                                @if(request('shop-out-of-stock'))
                                    <li class="shop-filter-li"><a href="{{ request()->fullUrlWithoutQuery(['shop-out-of-stock']) }}" class="shop-filter-active text-white font-14 d-flex align-items-center dominant-bg ptb-6 plr-15 border-radius">Out of stock<i class="ri-close-large-line"></i></a></li>
                                @endif
                                @if(request('shop-in-stock'))
                                    <li class="shop-filter-li"><a href="{{ request()->fullUrlWithoutQuery(['shop-in-stock']) }}" class="shop-filter-active text-white font-14 d-flex align-items-center dominant-bg ptb-6 plr-15 border-radius">In stock<i class="ri-close-large-line"></i></a></li>
                                @endif
                                @if(request('category'))
                                    <li class="shop-filter-li"><a href="{{ request()->fullUrlWithoutQuery(['category']) }}" class="shop-filter-active text-white font-14 d-flex align-items-center dominant-bg ptb-6 plr-15 border-radius">{{ ucfirst(str_replace('-', ' ', request('category'))) }}<i class="ri-close-large-line"></i></a></li>
                                @endif
                                @if(request('min-price') || request('max-price'))
                                    <li class="shop-filter-li"><a href="{{ request()->fullUrlWithoutQuery(['min-price', 'max-price']) }}" class="shop-filter-active text-white font-14 d-flex align-items-center dominant-bg ptb-6 plr-15 border-radius">{{ request('min-price', 0) }} - {{ request('max-price', $maxDbPrice ?? 1000) }}<i class="ri-close-large-line"></i></a></li>
                                @endif
                                @if(request()->anyFilled(['category', 'shop-in-stock', 'shop-out-of-stock', 'min-price', 'max-price']))
                                    <li class="shop-filter-li"><a href="{{ route('products') }}" class="shop-filter-active text-decoration-underline">Clear all</a></li>
                                @endif
                            </ul>
                            <div class="shop-filter-loader"><svg aria-hidden="true" focusable="false" role="presentation" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg"><circle fill="none" stroke="var(--heading-font-color)" stroke-width="3" cx="33" cy="33" r="30"></circle></svg></div>
                        </div>
                        <!-- shop-filter-list end -->
                        <div class="shop-product-wrap data-grid">
                            <!-- shop-grid start -->
                            <div class="row row-mtm30">
                                @forelse($products as $product)
                                <div class="col-6 col-md-4 col-xl-3 d-flex shop-col" data-animate="animate__fadeIn">
                                    <div class="single-product w-100">
                                        <div class="row single-product-wrap">
                                            <div class="product-image">
                                                <a href="{{ route('products.show', $product->id ?? 1) }}" class="pro-img">
                                                    <img src="{{ imgPath($product->main_image) }}" class="w-100 img-fluid img1" alt="{{ $product->name }}">
                                                    @if($product->gallery->count() > 0)
                                                        <img src="{{ imgPath($product->gallery->first()->image) }}" class="w-100 img-fluid img2" alt="{{ $product->name }}">
                                                    @else
                                                        <img src="{{ imgPath($product->main_image) }}" class="w-100 img-fluid img2" alt="{{ $product->name }}">
                                                    @endif
                                                </a>
                                                <div class="product-action">
                                                    <a href="javascript:void(0)" class="add-to-wishlist" data-product-id="{{ $product->id }}">
                                                        <span class="product-icon">Wishlist</span>
                                                    </a>
                                                    <a href="javascript:void(0)" data-product-id="{{ $product->id }}" class="quick-view dynamic-quickview">
                                                        <span class="product-icon">Quickview</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <div class="pro-content">
                                                    <div class="pro-content-action">
                                                        <div class="product-title">
                                                            <span class="d-block meb-8">{{ $product->category->name ?? 'Jewelry' }}</span>
                                                            <span class="d-block heading-weight"><a href="{{ route('products.show', $product->id ?? 1) }}" class="d-block w-100 dominant-link text-truncate">{{ $product->name }}</a></span>
                                                        </div>
                                                        <div class="pro-price-action">
                                                            <div class="price-box heading-weight">
                                                                <span class="new-price dominant-color">{{ number_format($product->effectivePrice(), 2) }}</span>
                                                                @if($product->hasDiscount())
                                                                    <span class="old-price text-decoration-line-through">{{ number_format($product->price, 2) }}</span>
                                                                @endif
                                                            </div>
                                                            <div class="product-action">
                                                                <a href="javascript:void(0)" class="add-to-cart ajax-add-to-cart" data-product-id="{{ $product->id }}">
                                                                    <span class="product-icon">
                                                                        <span class="product-bag-icon icon-16"><i class="ri-shopping-bag-3-line d-block lh-1"></i></span>
                                                                        <span class="product-loader-icon icon-16"><i class="ri-loader-4-line d-block lh-1"></i></span>
                                                                        <span class="product-check-icon icon-16"><i class="ri-check-line d-block lh-1"></i></span>
                                                                    </span>
                                                                    <span class="tooltip-text">add to cart</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="product-price">
                                                        <div class="price-box heading-weight">
                                                            <span class="new-price dominant-color">{{ number_format($product->effectivePrice(), 2) }}</span>
                                                            @if($product->hasDiscount())
                                                                <span class="old-price"><span class="mer-3">~</span><span class="text-decoration-line-through">{{ number_format($product->price, 2) }}</span></span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="product-description">
                                                        <p>{!! Str::limit(strip_tags($product->short_description), 100) !!}</p>
                                                    </div>
                                                    <div class="product-action">
                                                        <a href="javascript:void(0)" class="add-to-cart ajax-add-to-cart" data-product-id="{{ $product->id }}">
                                                            <span class="product-icon">
                                                                <span class="product-bag-icon icon-16"><i class="ri-shopping-bag-3-line d-block lh-1"></i></span>
                                                                <span class="product-loader-icon icon-16"><i class="ri-loader-4-line d-block lh-1"></i></span>
                                                                <span class="product-check-icon icon-16"><i class="ri-check-line d-block lh-1"></i></span>
                                                            </span>
                                                            <span class="tooltip-text">add to cart</span>
                                                        </a>
                                                        <a href="javascript:void(0)" class="add-to-wishlist" data-product-id="{{ $product->id }}">
                                                            <span class="product-icon"><i class="ri-heart-line d-block icon-16 lh-1"></i></span>
                                                            <span class="tooltip-text">wishlist</span>
                                                        </a>
                                                        <a href="javascript:void(0)" data-product-id="{{ $product->id }}" class="quick-view dynamic-quickview">
                                                            <span class="product-icon"><i class="ri-eye-line d-block icon-16 lh-1"></i></span>
                                                            <span class="tooltip-text">quickview</span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="pro-sku-variant">
                                                    <div class="product-sku-variant">
                                                        <div class="pro-sku">
                                                            <span class="heading-color text-uppercase heading-weight">SKU:<span class="dominant-color msl-4">{{ $product->sku }}</span></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="col-12 text-center py-5">
                                    <h4>No products found.</h4>
                                </div>
                                @endforelse
                            </div>
                            <div class="paginatoin-area section-pt" data-animate="animate__fadeIn">
                                {{ $products->links('vendor.pagination.bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                    <!-- collection-info end -->
                </div>
            </section>
            <!-- shop-content start -->
        </main>
        <!-- main end -->

@endsection
