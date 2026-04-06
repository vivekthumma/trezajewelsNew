<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Treza Jewels - Modern jewelry eCommerce</title>
    <meta name="description"
        content="Treza Jewels Is a luxury jewelry store offering premium rings, bracelets, and necklaces.">
    <meta name="keywords" content="jewelry, eCommerce, luxury, rings, bracelets, necklaces, shop, Treza Jewels">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- favicon -->
    <link rel="icon" href="{{ asset('frontend/images/favicon.png') }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset('frontend/images/favicon.png') }}">

    <!-- font-links start -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Marcellus&display=swap"
        rel="stylesheet">
    <!-- font-links end -->

    <!-- plugin css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/plugin.css') }}">
    <!-- theme css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/theme2.css') }}">
    <!-- collection css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/collection2.css') }}">
    <!-- blog css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/blog2.css') }}">
    <!-- style css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/style2.css') }}">

    <style>
        #main {
            padding-top: 36px;
        }

        @media (max-width: 1199px) {
            #main {
                padding-top: 28px;
            }
        }
    </style>

    @stack('css')
</head>

<body class="@yield('body-class')">
    <!-- preloader start -->
    <div class="preloader position-fixed top-0 start-0 w-100 h-100 body-bg z-index-5">
        <div
            class="loader-img position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">
            <img src="{{ setting('site_logo') ? imgPath('settings/' . setting('site_logo')) : asset('frontend/images/index2/logo.png') }}"
                class="width-96 width-xl-144 img-fluid" alt="logo">
        </div>
    </div>
    <!-- preloader end -->

    @include('frontend.layouts.partials.header')

    <!-- Modal Containers (Global) -->
    <!-- quickview-modal start -->
    <div class="quickview-modal modal fade" id="quickview-modal" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content body-bg border-0 br-hidden">
                <div class="modal-body ptb-30 plr-15 plr-sm-30" id="quickview-data">
                    <!-- Data will be loaded via AJAX -->
                    <div id="quickview-loader" style="display:none;" class="text-center p-5">
                        <i class="ri-loader-4-line ri-spin font-32"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- quickview-modal end -->

    <main id="main">
        <div class="container-fluid">
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

    @include('frontend.layouts.partials.footer')

    <!-- mobile-menu start -->
    @include('frontend.layouts.partials.mobile_menu')
    <!-- search-modal start -->
    @include('frontend.layouts.partials.search_modal')
    <!-- cart-drawer start -->
    @include('frontend.layouts.partials.cart_drawer')
    <!-- bottom-menu start -->
    @include('frontend.layouts.partials.bottom_menu')

    <!-- bg-screen start -->
    <div class="bg-screen">
        <div class="bg-back position-fixed top-0 end-0 bottom-0 start-0 bg-black z-index-4 opacity-0 invisible"></div>
        <div class="bg-shop position-fixed top-0 end-0 bottom-0 start-0 bg-black z-index-4 opacity-0 invisible"></div>
    </div>
    <!-- bg-screen end -->

    <!-- back-to-top start -->
    <a href="javascript:void(0)" id="top"
        class="icon-16 secondary-btn position-fixed width-32 height-32 d-flex align-items-center justify-content-center z-1 opacity-0 invisible border-radius"
        aria-label="Back to top"><i class="ri-arrow-up-line d-block lh-1"></i></a>
    <!-- back-to-top end -->

    <!-- plugin js -->
    <script src="{{ asset('frontend/js/plugin.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- theme js -->
    <script src="{{ asset('frontend/js/theme2.js') }}"></script>

    <script>
        $(document).ready(function () {
            // CSRF for AJAX
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Quickview Modal Logic
            $(document).on('click', '.dynamic-quickview', function (e) {
                e.preventDefault();
                let productId = $(this).data('product-id');
                let modal = $('#quickview-modal');
                let loader = $('#quickview-loader');
                let content = $('#quickview-data');

                modal.modal('show');
                content.find('> div:not(#quickview-loader)').hide().html('');
                loader.show();

                $.ajax({
                    url: `/products/${productId}/quickview`,
                    method: 'GET',
                    success: function (response) {
                        loader.hide();
                        content.append(response).fadeIn();

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
                    error: function () {
                        loader.hide();
                        content.append('<div class="alert alert-danger m-3">Error loading details.</div>').show();
                    }
                });
            });

            // Add to Cart Logic (AJAX)
            $(document).on('click', '.ajax-add-to-cart', function (e) {
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
                    success: function (data) {
                        if (data.success) {
                            // Update cart counters
                            $.get('/get-cart', function (cartData) {
                                $('#cart-drawer-items').html(cartData.html);
                                if ($('#main-cart-container').length) $('#main-cart-container').html(cartData.page_html);
                                $('.cart-counter').text(cartData.cart_count);
                                $('.cart-total, .subtotal-amount').text(cartData.subtotal);
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
                    error: function () {
                        alert("Something went wrong!");
                        btn.find('.product-loader-icon').hide();
                        btn.find('.product-bag-icon').show();
                    }
                });
            });

            // Wishlist Toggle
            $(document).on('click', '.add-to-wishlist', function (e) {
                e.preventDefault();
                let productId = $(this).data('product-id');
                let btn = $(this);

                $.ajax({
                    url: '/wishlist/toggle',
                    method: 'POST',
                    data: { product_id: productId },
                    success: function (data) {
                        if (data.success) {
                            if (data.in_wishlist) {
                                btn.find('i').removeClass('ri-heart-line').addClass('ri-heart-fill');
                                btn.addClass('wishlist-active');
                            } else {
                                btn.find('i').removeClass('ri-heart-fill').addClass('ri-heart-line');
                                btn.removeClass('wishlist-active');
                            }
                            $('.wishlist-counter').each(function () {
                                $(this).text(data.wishlist_count);
                            });
                        }
                    }
                });
            });

            // Remove Cart Item
            $(document).on('click', '.remove-cart-item', function (e) {
                e.preventDefault();
                let cartId = $(this).data('id');
                let btn = $(this);

                if (confirm('Remove this item?')) {
                    $.ajax({
                        url: '/remove-cart-item',
                        method: 'POST',
                        data: { cart_id: cartId },
                        success: function (data) {
                            if (data.success) {
                                // Refresh cart drawer content
                                $.get('/get-cart', function (cartData) {
                                    $('#cart-drawer-items').html(cartData.html);
                                    if ($('#main-cart-container').length) $('#main-cart-container').html(cartData.page_html);
                                    $('.cart-counter').text(cartData.cart_count);
                                    $('.cart-total, .subtotal-amount').text(cartData.subtotal);
                                });
                            }
                        }
                    });
                }
            });

            // Update Cart Quantity
            $(document).on('click', '.qty-plus, .qty-minus', function (e) {
                let cartId = $(this).data('id');
                let input = $(this).siblings('.qty-num, .js-qty-num');
                let currentVal = parseInt(input.val());
                let newVal = $(this).hasClass('qty-plus') ? currentVal + 1 : currentVal - 1;

                if (newVal < 1) return;

                $.ajax({
                    url: '/update-cart-qty',
                    method: 'POST',
                    data: { cart_id: cartId, quantity: newVal },
                    success: function (data) {
                        if (data.success) {
                            $.get('/get-cart', function (cartData) {
                                $('#cart-drawer-items').html(cartData.html);
                                if ($('#main-cart-container').length) $('#main-cart-container').html(cartData.page_html);
                                $('.cart-counter').text(cartData.cart_count);
                                $('.cart-total, .subtotal-amount').text(cartData.subtotal);
                            });
                        }
                    },
                    error: function (xhr) {
                        if (xhr.responseJSON) alert(xhr.responseJSON.message);
                    }
                });
            });
        });
    </script>
    @stack('js')
</body>

</html>
