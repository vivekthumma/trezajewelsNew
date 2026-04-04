@extends('layouts.app')

@section('title', 'Shop - Treza Jewels')
@section('body-class', 'collection-category')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/collection.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/premium-cards.css') }}">
    <style>
        .shop-cat-title.active { background-color: var(--dominant-font-color) !important; color: white !important; }
        .shop-cat-title.active a { color: white !important; }
        .price-slider-wrap { padding: 10px 0; }
        .price-input-range { margin-top: 15px; }
        .shop-cat-block .shop-cat-img-wrapper:hover img { transform: scale(1.1); }
        .shop-cat-block .shop-cat-img-wrapper:hover .shop-cat-overlay { opacity: 1 !important; visibility: visible; }
        .shop-cat-overlay { transition: all 0.3s ease; visibility: hidden; }
        .price-slider { height: 5px; background: #ddd; border-radius: 5px; position: relative; }
        .price-slider .ui-slider-range { background: var(--dominant-font-color); position: absolute; height: 100%; border-radius: 5px; }
        .price-slider .ui-slider-handle { width: 16px; height: 16px; border-radius: 50%; background: var(--dominant-font-color); border: 2px solid white; position: absolute; top: -6px; cursor: pointer; outline: none; }
        .shop-filter-loader { display: none; margin-left: 10px; }
        .shop-filter-loader svg { width: 20px; height: 20px; animation: rotate 2s linear infinite; }
        @keyframes rotate { 100% { transform: rotate(360deg); } }
    </style>
@endpush

@section('content')
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area ptb-15" data-bgimg="{{ asset('assets/images/other/breadcrumb-bgimg.jpg') }}">
        <div class="container">
            <span class="d-block extra-color"><a href="{{ url('/') }}" class="extra-color">Home</a> / Shop</span>
        </div>
    </div>
    <!-- breadcrumb-area end -->

    <main id="main">
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
                                                        <a href="javascript:void(0)" class="d-block cat-content-img position-relative pbp-100 filter-cat" data-id="{{ $category->id }}">
                                                            <span class="cat-img position-absolute top-0 end-0 bottom-0 start-0 d-flex flex-column align-items-center justify-content-center body-bg mtb-xl-25 mlr-xl-25 rounded-circle">
                                                                <img src="{{ $category->image ? imgPath($category->image) : asset('assets/images/index2/cat-1.png') }}" class="width-64 img-fluid" alt="{{ $category->name }}">
                                                            </span>
                                                            <div class="d-none cat-link position-absolute top-0 end-0 bottom-0 start-0 z-1 d-xl-flex align-items-center justify-content-center rounded-circle overflow-hidden">
                                                                <span class="cat-link-btn extra-color text-uppercase heading-weight">Shop now</span>
                                                            </div>
                                                        </a>
                                                        <h6 class="font-18 mst-26">
                                                            <a href="javascript:void(0)" class="dominant-link filter-cat {{ request('category') == $category->id ? 'active' : '' }}" data-id="{{ $category->id }}">
                                                                {{ $category->name }}
                                                            </a>
                                                        </h6>
                                                        <a href="javascript:void(0)" class="d-inline-block d-xl-none dominant-link text-uppercase heading-weight mst-12 filter-cat" data-id="{{ $category->id }}">
                                                            <span class="d-inline-block cat-link-btn">Shop now</span>
                                                        </a>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="swiper-buttons">
                                            <div class="swiper-buttons-wrap">
                                                <button type="button" class="swiper-prev swiper-prev-cat" aria-label="Arrow previous"><i class="ri-arrow-left-line d-block lh-1"></i></button>
                                                <button type="button" class="swiper-next swiper-next-cat" aria-label="Arrow next"><i class="ri-arrow-right-line d-block lh-1"></i></button>
                                            </div>
                                        </div>
                                        <div class="swiper-dots" data-animate="animate__fadeIn">
                                            <div class="swiper-pagination swiper-pagination-cat"></div>
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

        <!-- shop-content start -->
        <section class="shop-content section-ptb">
            <div class="container">
                <div class="row align-items-xl-start">
                    <!-- shop-sidebar start -->
                    <div class="col-12 col-xl-3 p-xl-sticky top-0">
                        <div class="shop-sidebar-wrap shop-filter-sidebar" data-animate="animate__fadeIn">
                            <button type="button" class="shop-sidebar-close body-secondary-color icon-16 position-absolute" aria-label="Close"><i class="ri-close-large-line d-block lh-1"></i></button>
                            <form class="shop-form" action="{{ route('products') }}" method="GET" id="shopForm">
                                <input type="hidden" name="category" id="hidden_category" value="{{ request('category') }}">
                                <input type="hidden" name="sort" id="hidden_sort" value="{{ request('sort', 'latest') }}">
                                
                                <!-- shop-categories start -->
                                <div class="shop-sidebar shop-categories">
                                    <h6 class="font-18">Categories</h6>
                                    <div class="shop-cat-post mst-22">
                                        <div class="shop-cat ul-mtm-15">
                                            @foreach($categories as $category)
                                                <a href="javascript:void(0)" class="filter-cat {{ request('category') == $category->id ? 'dominant-color fw-bold' : 'body-dominant-color' }} d-flex align-items-center justify-content-between" data-id="{{ $category->id }}">
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
                                        <span class="shop-selected" id="availability_status">
                                            @if(request('stock') == 'in-stock') 1 selected @elseif(request('stock') == 'out-of-stock') 1 selected @else 0 selected @endif
                                        </span>
                                        <button type="button" class="shop-reset body-secondary-color text-decoration-underline clear-availability">Reset</button>
                                    </div>
                                    <div class="shop-element mst-23">
                                        <ul class="shop-filters ul-mtm-15">
                                            <li>
                                                <label class="cust-checkbox-label d-flex align-items-center justify-content-between">
                                                    <input type="radio" name="stock" class="cust-checkbox filter-stock" value="in-stock" {{ request('stock') == 'in-stock' ? 'checked' : '' }}>
                                                    <span class="d-block cust-check"></span>
                                                    <span class="shop-name me-auto">In stock</span>
                                                </label>
                                            </li>
                                            <li>
                                                <label class="cust-checkbox-label d-flex align-items-center justify-content-between">
                                                    <input type="radio" name="stock" class="cust-checkbox filter-stock" value="out-of-stock" {{ request('stock') == 'out-of-stock' ? 'checked' : '' }}>
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
                                        <span class="shop-selected">The highest price is {{ number_format($maxDbPrice, 2) }}</span>
                                        <button type="button" class="shop-reset body-secondary-color text-decoration-underline clear-price">Reset</button>
                                    </div>
                                    <div class="shop-element mst-26">
                                        <div class="price-input-range">
                                            <div class="price-range">
                                                <div class="price-container">
                                                    <div class="price-slider" id="price-slider-bar"></div>
                                                </div>
                                                <div class="range-input position-relative">
                                                    <input type="range" class="min-range filter-price-range position-absolute w-100 p-0 bg-transparent border-0" min="0" max="{{ $maxDbPrice }}" value="{{ request('price_min', 0) }}" step="1" id="range-min">
                                                    <input type="range" class="max-range filter-price-range position-absolute w-100 p-0 bg-transparent border-0" min="0" max="{{ $maxDbPrice }}" value="{{ request('price_max', $maxDbPrice) }}" step="1" id="range-max">
                                                </div>
                                            </div>
                                            <div class="price-input d-flex align-items-center mst-30">
                                                <div class="price-field position-relative w-100">
                                                    <span class="price-input-title position-absolute top-0 start-0">From</span>
                                                    <span class="price-input-prefix position-absolute top-50 translate-middle-y"></span>
                                                    <input type="number" id="price_min" name="price_min" class="min-input w-100 h-100 text-end filter-price-num" min="0" max="{{ $maxDbPrice }}" value="{{ request('price_min', 0) }}">
                                                </div>
                                                <div class="price-input-separator mlr-15">-</div>
                                                <div class="price-field position-relative w-100">
                                                    <span class="price-input-title position-absolute top-0 start-0">To</span>
                                                    <span class="price-input-prefix position-absolute top-50 translate-middle-y"></span>
                                                    <input type="number" id="price_max" name="price_max" class="max-input w-100 h-100 text-end filter-price-num" min="0" max="{{ $maxDbPrice }}" value="{{ request('price_max', $maxDbPrice) }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- shop-sidebar price end -->
                            </form>
                        </div>

                        <!-- shop-sidebar banner start -->
                        <div class="sidebar-banner d-none d-xl-block banner-hover mst-30" data-animate="animate__fadeIn">
                            <a href="javascript:void(0)" class="d-block banner-img position-relative br-hidden">
                                <span class="banner-icon secondary-color font-20 position-absolute top-50 start-50 width-48 height-48 d-flex align-items-center justify-content-center extra-bg z-1 rounded-circle"><i class="ri-arrow-right-line d-block lh-1"></i></span>
                                <img src="{{ asset('assets/images/collection/side-image.jpg') }}" class="w-100 img-fluid" alt="side-image">
                            </a>
                        </div>
                        <!-- shop-sidebar banner end -->
                    </div>
                    <!-- shop-sidebar end -->

                    <div class="col-12 col-xl-9">
                        <!-- collection-info start -->
                        <div class="row row-mtm" data-animate="animate__fadeIn">
                            <!-- collection-img start -->
                            <div class="collection-img">
                                <h6 class="font-18 meb-25 dominant-color" id="product_total_count">
                                     <span id="current_collection_name">{{ $currentCategory ? $currentCategory->name : 'All Products' }}</span> ({{ $products->total() }})
                                 </h6>
                                 <img src="{{ $currentCategory && $currentCategory->banner_image ? imgPath($currentCategory->banner_image) : imgPath($defaultBanner) }}" class="w-100 img-fluid border-radius" alt="collection-banner" id="current_category_banner">
                            </div>
                            <!-- collection-img end -->

                            <!-- shop-top-bar start -->
                            <div class="shop-top-bar">
                                <div class="row row-mtm15 align-items-md-center">
                                    <div class="col-12 col-sm-6 col-md-7 col-lg-8">
                                        <div class="shop-filter-view ul-mt15 align-items-center">
                                            <div class="shop-filter d-xl-none">
                                                <button type="button" class="shop-filter-btn secondary-color d-flex align-items-center"><i class="ri-filter-line icon-16 mer-5"></i>Filter</button>
                                            </div>
                                            <div class="shop-view-mode">
                                                <div class="ul-mt10">
                                                    <button type="button" class="shop-view-btn dominant-color icon-16 opacity-100 disabled" data-view="grid" aria-label="Grid view"><i class="ri-layout-grid-line"></i></button>
                                                    <button type="button" class="shop-view-btn body-color icon-16 opacity-100" data-view="list" aria-label="List view"><i class="ri-list-unordered"></i></button>
                                                </div>
                                            </div>
                                            <div class="shop-show-product" id="showing_range">Showing {{ $products->firstItem() }}-{{ $products->lastItem() }} of {{ $products->total() }} products</div>
                                            <div class="shop-filter-loader"><svg aria-hidden="true" focusable="false" role="presentation" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg"><circle fill="none" stroke="var(--heading-font-color)" stroke-width="3" cx="33" cy="33" r="30"></circle></svg></div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-5 col-lg-4">
                                        <div class="shop-short d-flex flex-wrap position-relative">
                                            <label for="sort" class="width-72 secondary-color heading-weight">Sort by:</label>
                                            <select id="sort_select" name="sort" class="d-xl-none width-calc-72 h-auto ptb-0 bg-transparent border-0">
                                                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                                                <option value="az" {{ request('sort') == 'az' ? 'selected' : '' }}>Alphabetically, A-Z</option>
                                                <option value="za" {{ request('sort') == 'za' ? 'selected' : '' }}>Alphabetically, Z-A</option>
                                                <option value="low-high" {{ request('sort') == 'low-high' ? 'selected' : '' }}>Price, low to high</option>
                                                <option value="high-low" {{ request('sort') == 'high-low' ? 'selected' : '' }}>Price, high to low</option>
                                            </select>
                                            <a href="javascript:void(0)" class="short-title width-calc-72 body-color d-none d-xl-flex align-items-xl-start justify-content-xl-between">
                                                <span class="sort-title" id="current_sort_label">
                                                    @switch(request('sort'))
                                                        @case('az') Alphabetically, A-Z @break
                                                        @case('za') Alphabetically, Z-A @break
                                                        @case('low-high') Price, low to high @break
                                                        @case('high-low') Price, high to low @break
                                                        @default Latest @break
                                                    @endswitch
                                                </span>
                                                <span class="sort-icon heading-weight"><i class="ri-arrow-down-s-line d-block lh-1"></i></span>
                                            </a>
                                            <ul class="collapse position-absolute top-100 start-0 end-0 ptb-5 body-bg z-1 DropDownSlide br-hidden box-shadow" id="select-wrap">
                                                <li><a href="javascript:void(0)" data-value="latest" class="d-block body-dominant-color ptb-5 plr-15 {{ request('sort') == 'latest' || !request('sort') ? 'extra-bg fw-bold' : '' }}">Latest</a></li>
                                                <li><a href="javascript:void(0)" data-value="az" class="d-block body-dominant-color ptb-5 plr-15 {{ request('sort') == 'az' ? 'extra-bg fw-bold' : '' }}">Alphabetically, A-Z</a></li>
                                                <li><a href="javascript:void(0)" data-value="za" class="d-block body-dominant-color ptb-5 plr-15 {{ request('sort') == 'za' ? 'extra-bg fw-bold' : '' }}">Alphabetically, Z-A</a></li>
                                                <li><a href="javascript:void(0)" data-value="low-high" class="d-block body-dominant-color ptb-5 plr-15 {{ request('sort') == 'low-high' ? 'extra-bg fw-bold' : '' }}">Price, low to high</a></li>
                                                <li><a href="javascript:void(0)" data-value="high-low" class="d-block body-dominant-color ptb-5 plr-15 {{ request('sort') == 'high-low' ? 'extra-bg fw-bold' : '' }}">Price, high to low</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- shop-top-bar end -->

                            <div id="product-list-container">
                                @include('frontend.products._list')
                            </div>

                            <div class="paginatoin-area section-pt" data-animate="animate__fadeIn" id="pagination-container">
                                {{ $products->links('vendor.pagination.bootstrap-5') }}
                            </div>
                        </div>
                        <!-- collection-info end -->
                    </div>
                </div>
            </div>
        </section>
        <!-- shop-content start -->
    </main>

    @push('js')
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <script>
        $(document).ready(function() {
            const $form = $('#shopForm');
            const $container = $('#product-list-container');
            const $pagContainer = $('#pagination-container');
            const $loader = $('.shop-filter-loader');
            const maxPrice = {{ $maxDbPrice }};
            const priceGap = 1; // Minimum gap between min and max

            function updatePriceSlider() {
                const minVal = parseInt($('#range-min').val());
                const maxVal = parseInt($('#range-max').val());
                const percent1 = (minVal / maxPrice) * 100;
                const percent2 = (maxVal / maxPrice) * 100;
                $('#price-slider-bar').css('left', percent1 + '%');
                $('#price-slider-bar').css('right', (100 - percent2) + '%');
            }

            // Sync range inputs with number inputs
            $('.filter-price-range').on('input', function() {
                let minVal = parseInt($('#range-min').val());
                let maxVal = parseInt($('#range-max').val());

                if (maxVal - minVal < priceGap) {
                    if ($(this).hasClass('min-range')) {
                        $('#range-min').val(maxVal - priceGap);
                    } else {
                        $('#range-max').val(minVal + priceGap);
                    }
                } else {
                    $('#price_min').val(minVal);
                    $('#price_max').val(maxVal);
                    updatePriceSlider();
                }
            });

            $('.filter-price-range').on('change', function() {
                applyFilters();
            });

            // Sync number inputs with range inputs
            $('.filter-price-num').on('change', function() {
                let minVal = parseInt($('#price_min').val());
                let maxVal = parseInt($('#price_max').val());

                if ((maxVal - minVal >= priceGap) && maxVal <= maxPrice) {
                    if ($(this).hasClass('min-input')) {
                        $('#range-min').val(minVal);
                    } else {
                        $('#range-max').val(maxVal);
                    }
                    updatePriceSlider();
                    applyFilters();
                }
            });

            // Initialize slider bar
            updatePriceSlider();

            // Category filter click
            $(document).on('click', '.filter-cat', function(e) {
                e.preventDefault();
                const catId = $(this).data('id');
                $('#hidden_category').val(catId);
                
                // UI update
                $('.shop-cat-title').removeClass('active');
                $('.shop-cat-title[data-cat-id="'+catId+'"]').addClass('active');
                $('.shop-categories .filter-cat').removeClass('dominant-color fw-bold').addClass('body-dominant-color');
                $('.shop-categories .filter-cat[data-id="'+catId+'"]').addClass('dominant-color fw-bold').removeClass('body-dominant-color');
                
                applyFilters();
            });

            // Stock filter
            $('.filter-stock').on('change', function() {
                applyFilters();
            });

            // Sorting
            $('#sort_select').on('change', function() {
                $('#hidden_sort').val($(this).val());
                applyFilters();
            });

            $('#select-wrap a').on('click', function(e) {
                e.preventDefault();
                const val = $(this).data('value');
                const label = $(this).text();
                $('#hidden_sort').val(val);
                $('#current_sort_label').text(label);
                $('#select-wrap li').removeClass('selected extra-bg fw-bold');
                $(this).closest('li').addClass('selected extra-bg fw-bold');
                applyFilters();
            });

            // Clear Availability
            $('.clear-availability').on('click', function() {
                $('.filter-stock').prop('checked', false);
                applyFilters();
            });

            // Clear Price
            $('.clear-price').on('click', function() {
                $('#price_min, #range-min').val(0);
                $('#price_max, #range-max').val(maxPrice);
                updatePriceSlider();
                applyFilters();
            });

            // Pagination using AJAX
            $(document).on('click', '#pagination-container a', function(e) {
                e.preventDefault();
                const url = $(this).attr('href');
                fetchProducts(url);
            });

            function applyFilters() {
                const url = $form.attr('action');
                const formData = $form.serialize();
                fetchProducts(url + '?' + formData);
            }

            function fetchProducts(url) {
                $loader.show();
                $container.css('opacity', '0.5');

                $.ajax({
                    url: url,
                    method: 'GET',
                    dataType: 'json',
                    success: function(res) {
                        $container.html(res.html).css('opacity', '1');
                        $pagContainer.html(res.pagination);
                        $('#product_total_count').html('<span id="current_collection_name">' + res.current_category_name + '</span> (' + res.total + ')');
                        $('#current_category_banner').attr('src', res.current_category_banner);
                        $('#showing_range').text('Showing ' + (res.first_item || 0) + '-' + (res.last_item || 0) + ' of ' + res.total + ' products');
                        $loader.hide();
                        
                        // Push to state
                        window.history.pushState(null, '', url);
                        
                        // Re-trigger scroll to top of list if needed
                        $('html, body').animate({
                            scrollTop: $(".shop-top-bar").offset().top - 100
                        }, 500);

                        // Re-trigger animations for AJAX-loaded products
                        $container.find('[data-animate]:not(.animate__animated)').each(function() {
                            const animation = $(this).data('animate');
                            $(this).addClass('animate__animated').addClass(animation);
                        });
                        
                        // Re-remark wishlist state for new products
                        if (typeof loadWishlistState === 'function') {
                            loadWishlistState();
                        }
                    },
                    error: function() {
                        $loader.hide();
                        $container.css('opacity', '1');
                        alert('Something went wrong. Please try again.');
                    }
                });
            }
        });
    </script>
    @endpush
@endsection
