<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <!-- title -->
        <title>Treza Jewels - Modern jewelry eCommerce</title>
        <meta name="description" content="Treza Jewels Is a luxury jewelry store offering premium rings, bracelets, and necklaces.">
        <meta name="keywords" content="jewelry, eCommerce, luxury, rings, bracelets, necklaces, shop, Treza Jewels">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- favicon -->
        <link rel="shortcut icon" type="image/favicon" href="{{ setting_asset('site_logo', 'assets/images/index2/logo.png') }}">
        <!-- font-links start -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Marcellus&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
        <!-- font-links end -->

        <!-- css-links start -->
        <link rel="stylesheet" href="{{ asset('assets/css/plugin.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/theme2.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/theme.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/style2.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/collection2.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/home-modern.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/cart-qty.css') }}">
        <!-- css-links end -->
        <style>
            main{
                padding-top: 36px;
            }

            @media (max-width: 1199px){
                main{
                    padding-top: 28px;
                }
            }

            /* Global Premium Product Card Styles */
            .pro-img {
                position: relative !important;
                display: block !important;
                width: 100% !important;
                height: 0 !important;
                padding-bottom: 125% !important; /* Forces 4:5 aspect ratio */
                overflow: hidden !important;
                background-color: #fcfbf7;
            }
            
            .pro-img img {
                position: absolute !important;
                top: 0 !important;
                left: 0 !important;
                width: 100% !important;
                height: 100% !important;
                object-fit: contain !important;
                object-position: center !important;
            }
            
            .pro-img .img2 {
                opacity: 0;
                transition: opacity 0.5s ease-in-out !important;
            }
            
            .pro-img:hover .img2 {
                opacity: 1 !important;
            }

            /* Product Action Tooltips & Hover */
            .product-action {
                position: absolute !important;
                bottom: 20px !important;
                left: 50% !important;
                transform: translateX(-50%) translateY(20px) !important;
                opacity: 0;
                visibility: hidden;
                transition: all 0.3s ease-in-out !important;
                display: flex !important;
                flex-direction: row !important;
                flex-wrap: nowrap !important;
                gap: 10px !important;
                z-index: 5 !important;
                width: auto !important;
            }

            .product-image:hover .product-action {
                opacity: 1 !important;
                visibility: visible !important;
                transform: translateX(-50%) translateY(0) !important;
            }

            .single-product:hover .product-action {
                opacity: 1 !important;
                visibility: visible !important;
                transform: translateX(-50%) translateY(0) !important;
            }

            .product-action a {
                width: 40px !important;
                height: 40px !important;
                background: #ffffff !important;
                border-radius: 50% !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                box-shadow: 0 4px 12px rgba(0,0,0,0.12) !important;
                color: #333333 !important;
                position: relative !important;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
                text-decoration: none !important;
                border: 1px solid rgba(0,0,0,0.05) !important;
            }

            .product-action a i {
                font-size: 18px !important;
                line-height: 1 !important;
            }

            .product-action a:hover {
                background: var(--dominant-font-color) !important;
                color: #ffffff !important;
                transform: translateY(-2px) !important;
            }

            .product-action .tooltip-text {
                position: absolute !important;
                bottom: 110% !important;
                left: 50% !important;
                transform: translateX(-50%) translateY(0) !important;
                background: rgba(0, 0, 0, 0.8) !important;
                color: #ffffff !important;
                padding: 4px 10px !important;
                border-radius: 4px !important;
                font-size: 11px !important;
                font-weight: 500 !important;
                text-transform: uppercase !important;
                white-space: nowrap !important;
                opacity: 0;
                visibility: hidden;
                transition: all 0.2s ease !important;
                pointer-events: none !important;
            }

            .product-action a:hover .tooltip-text {
                opacity: 1 !important;
                visibility: visible !important;
                transform: translateX(-50%) translateY(-5px) !important;
            }

            /* Hiding theme's default price hiding on desktop */
            .single-product .single-product-wrap .product-content .pro-content .product-price {
                display: block !important;
                margin-top: 10px !important;
            }

            .new-price {
                color: var(--dominant-font-color) !important;
                font-weight: 600 !important;
                font-size: 16px !important;
            }

            .old-price {
                font-size: 14px !important;
            }

            .btn-style.disabled {
                opacity: 0.5 !important;
                background-color: #ccc !important;
                border-color: #ccc !important;
                cursor: not-allowed !important;
                pointer-events: none !important;
            }
        </style>
        @stack('css')
    </head>
    <body class="@yield('body-class')">
        @include('partials.header')

        <main>
            <div class="container">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3" role="alert">
                        <i class="ri-checkbox-circle-line me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3" role="alert">
                        <i class="ri-error-warning-line me-2"></i> {{ session('error') }}
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
            @yield('content')
        </main>

        @include('partials.footer')

        <!-- js-links start -->
        <script src="{{ asset('assets/js/plugin.js') }}"></script>
        <script src="{{ asset('assets/js/theme2.js') }}"></script>
        <script src="{{ asset('assets/js/home-modern.js') }}"></script>
        
        <script>
            $(document).ready(function() {
                // CSRF for AJAX
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // Sync cart & wishlist on load
                function syncHeaderCounts() {
                    $.get('/get-cart', function(cartData) {
                        $('.cart-drawer-item-list').html(cartData.html);
                        if($('#main-cart-container').length) $('#main-cart-container').html(cartData.page_html);
                        $('.cart-counter').text(cartData.cart_count);
                        $('.subtotal-amount, .cart-total').text(cartData.subtotal);
                    });
                    $.get('/wishlist/count', function(data) {
                        if (data.success) {
                            $('.wishlist-counter').text(data.wishlist_count);
                        }
                    });
                }
                syncHeaderCounts();

                // Quickview Modal Logic
                $(document).on('click', '.dynamic-quickview', function(e) {
                    e.preventDefault();
                    let productId = $(this).data('product-id');
                    let modal = $('#quickview-modal');
                    let loader = $('#quickview-loader');
                    let content = $('#quickview-data');

                    modal.modal('show');
                    content.hide().html('');
                    loader.show();

                    $.ajax({
                        url: `/products/${productId}/quickview`,
                        method: 'GET',
                        success: function(response) {
                            loader.hide();
                            content.html(response).fadeIn();
                            
                            // Re-init swipers in modal
                            if (typeof Swiper !== 'undefined') {
                                new Swiper(".swiper#quickview-slider-small", {
                                    loop: false, slidesPerView: 4, spaceBetween: 15, freeMode: true, watchSlidesProgress: true
                                });
                                new Swiper(".swiper#quickview-slider-big", {
                                    loop: false, slidesPerView: 1, spaceBetween: 0,
                                    navigation: { prevEl: ".swiper-prev-quickview-big", nextEl: ".swiper-next-quickview-big" }
                                });
                            }
                        },
                        error: function() {
                            loader.hide();
                            content.html('<div class="alert alert-danger m-3">Error loading details.</div>').show();
                        }
                    });
                });

                // Add to Cart Logic
                $(document).on('click', '.ajax-add-to-cart', function(e) {
                    e.preventDefault();
                    let productId = $(this).data('product-id');
                    let btn = $(this);
                    let form = btn.closest('form');
                    let qty = form.find('.qty-num, .js-qty-num').val() || 1;
                    let size = form.find('select[name$="size"]').val() || null;
                    let color = form.find('select[name$="color"]').val() || null;

                    btn.find('.product-bag-icon').hide();
                    btn.find('.product-loader-icon').addClass('ri-spin').show();

                    $.ajax({
                        url: '/add-to-cart',
                        method: 'POST',
                        data: { product_id: productId, quantity: qty, size: size, color: color },
                        success: function(data) {
                            if (data.success) {
                                // Update cart counters/contents
                                $.get('/get-cart', function(cartData) {
                                    $('.cart-drawer-item-list').html(cartData.html);
                                    if($('#main-cart-container').length) $('#main-cart-container').html(cartData.page_html);
                                    $('.cart-counter').text(cartData.cart_count);
                                    $('.subtotal-amount, .cart-total').text(cartData.subtotal);
                                });

                                btn.find('.product-loader-icon').hide();
                                btn.find('.product-check-icon').show();
                                setTimeout(() => {
                                    btn.find('.product-check-icon').hide();
                                    btn.find('.product-bag-icon').show();
                                }, 2000);
                            } else {
                                alert(data.message || "Error");
                            }
                        },
                        error: function() {
                            alert("Something went wrong!");
                            btn.find('.product-loader-icon').hide();
                            btn.find('.product-bag-icon').show();
                        }
                    });
                });

                // Remove from Cart Logic
                $(document).on('click', '.remove-cart-item', function(e) {
                    e.preventDefault();
                    let cartId = $(this).data('id');
                    let btn = $(this);

                    if(confirm('Are you sure you want to remove this item?')) {
                        $.ajax({
                            url: '/remove-cart-item',
                            method: 'POST',
                            data: { cart_id: cartId },
                            success: function(data) {
                                if (data.success) {
                                    // Update cart counters/contents
                                    $.get('/get-cart', function(cartData) {
                                        $('.cart-drawer-item-list').html(cartData.html);
                                        if($('#main-cart-container').length) $('#main-cart-container').html(cartData.page_html);
                                        $('.cart-counter').text(cartData.cart_count);
                                        $('.subtotal-amount, .cart-total').text(cartData.subtotal);
                                    });
                                }
                            }
                        });
                    }
                });

                // Quantity Update Logic (+/-)
                $(document).on('click', '.qty-plus, .qty-minus', function(e) {
                    e.preventDefault();
                    let cartId = $(this).data('id');
                    let btn = $(this);
                    let input = btn.siblings('.qty-num');
                    let currentQty = parseInt(input.val());
                    let newQty = btn.hasClass('qty-plus') ? currentQty + 1 : currentQty - 1;

                    if (newQty < 1) return;

                    $.ajax({
                        url: '/update-cart-qty',
                        method: 'POST',
                        data: { cart_id: cartId, quantity: newQty },
                        success: function(data) {
                            if (data.success) {
                                // Update cart counters/contents
                                $.get('/get-cart', function(cartData) {
                                    $('.cart-drawer-item-list').html(cartData.html);
                                    if($('#main-cart-container').length) $('#main-cart-container').html(cartData.page_html);
                                    $('.cart-counter').text(cartData.cart_count);
                                    $('.subtotal-amount, .cart-total').text(cartData.subtotal);
                                });
                            } else {
                                alert(data.message || "Error updating quantity");
                            }
                        }
                    });
                });

                // Wishlist Toggle
                $(document).on('click', '.add-to-wishlist', function(e) {
                    e.preventDefault();
                    let productId = $(this).data('product-id');
                    let btn = $(this);

                    $.ajax({
                        url: '/wishlist/toggle',
                        method: 'POST',
                        data: { product_id: productId },
                        success: function(data) {
                            if (data.success) {
                                if (data.in_wishlist) {
                                    btn.find('i').removeClass('ri-heart-line').addClass('ri-heart-fill');
                                    btn.addClass('wishlist-active');
                                } else {
                                    btn.find('i').removeClass('ri-heart-fill').addClass('ri-heart-line');
                                    btn.removeClass('wishlist-active');
                                }
                                $('.wishlist-counter').text(data.wishlist_count);
                            }
                        }
                    });
                });

                // Drawer Terms Checkbox Logic
                $(document).on('change', '#drawer-terms', function() {
                    if ($(this).is(':checked')) {
                        $('.checkout-btn-sidebar').removeClass('disabled');
                    } else {
                        $('.checkout-btn-sidebar').addClass('disabled');
                    }
                });

                $(document).on('click', '.checkout-btn-sidebar.disabled', function(e) {
                    e.preventDefault();
                    return false;
                });
            });
        </script>

        @stack('js')
    </body>
</html>
