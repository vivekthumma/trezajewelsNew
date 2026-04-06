@extends('layouts.app')

@section('title', 'Wishlist - Treza Jewels')

@section('content')
<!-- breadcrumb-area start -->
<div class="breadcrumb-area ptb-15" data-bgimg="{{ asset('assets/images/other/breadcrumb-bgimg.jpg') }}">
    <div class="container">
        <span class="d-block extra-color"><a href="{{ url('/') }}" class="extra-color">Home</a> / Wishlist</span>
    </div>
</div>
<!-- breadcrumb-area end -->

<!-- main start -->
<main id="main">
    <!-- wishlist-page start -->
    <section class="wish-area section-ptb">
        <div class="container">
            @if($wishlistItems->count() > 0)
            <div class="row row-mtm">
                <div class="col-12 col-lg-8" data-animate="animate__fadeIn">
                    <div class="wish-textview ul-mtm30">
                        <div class="wish-text">Create your very own personalized collections of items and save them in your account for future reference.</div>
                        @guest
                        <div class="wish-text">
                            <div class="wish-text-content ul-mtm-15">
                                <span>This list will expire when your session ends.</span>
                                <span><a href="{{ route('login') }}" class="body-dominant-color text-decoration-underline">Login</a> or <a href="{{ route('register') }}" class="body-dominant-color text-decoration-underline">Create account</a> to save your wishlist permanently.</span>
                            </div>
                        </div>
                        @endguest
                    </div>
                </div>
                <div class="col-12 col-lg-4" data-animate="animate__fadeIn">
                    <div class="wish-summary ptb-30 plr-15 plr-sm-30 extra-bg border-radius">
                        <h6 class="font-18 meb-22">Wishlist summary</h6>
                        <div class="wish-total ul-mtm20">
                            <div class="wish-total-info d-flex justify-content-between">
                                <span>Subtotal</span>
                                <span class="heading-color heading-weight" id="wishlist-subtotal">₹{{ number_format($subtotal, 2) }}</span>
                            </div>
                            <div class="wish-total-info d-flex justify-content-between">
                                <span>Items</span>
                                <span class="heading-weight" id="wishlist-item-count">{{ $wishlistItems->count() }}</span>
                            </div>
                        </div>
                        <div class="wish-total mst-26 pst-27 bst">
                            <div class="wish-total-info d-flex justify-content-between">
                                <span>Total</span>
                                <span class="heading-color heading-weight" id="wishlist-total">₹{{ number_format($subtotal, 2) }}</span>
                            </div>
                        </div>
                        <div class="wish-summary-btn mst-26">
                            <div class="row row-mtm15">
                                <div class="col-12">
                                    <button type="button" id="wishlist-add-all-cart" class="w-100 btn-style quaternary-btn add-to-cart">
                                        <span class="product-icon">
                                            <span class="product-bag-icon">All add to cart</span>
                                            <span class="product-loader-icon icon-16"><i class="ri-loader-4-line d-block lh-1"></i></span>
                                            <span class="product-check-icon icon-16"><i class="ri-check-line d-block lh-1"></i></span>
                                        </span>
                                    </button>
                                </div>
                                <div class="col-12">
                                    <button type="button" id="wishlist-clear-btn" class="w-100 btn-style secondary-btn">Clear wishlist</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="wish-itemview section-pt">
                <div class="wish-title d-flex align-items-center justify-content-between peb-30 beb">
                    <h6 class="font-18">My favorites</h6>
                    <span class="wish-count"><span id="wish-counter-title">{{ $wishlistItems->count() }}</span> Items</span>
                </div>
                <div class="wish-table">
                    <div class="wish-table-heading d-none d-md-block ptb-30 beb">
                        <div class="row">
                            <div class="col-md-5 col-lg-4 heading-color heading-weight">Product</div>
                            <div class="col-md-3 heading-color heading-weight">Price</div>
                            <div class="col-md-2 col-lg-3 heading-color heading-weight">Action</div>
                            <div class="col-md-2 heading-color heading-weight text-end">Remove</div>
                        </div>
                    </div>
                    <div class="wish-table-data" id="wishlist-items-container">
                        @foreach($wishlistItems as $item)
                        @if($item->product)
                        <div class="wish-table-info ptb-30 beb wishlist-row" data-wishlist-id="{{ $item->id }}" data-product-id="{{ $item->product_id }}">
                            <div class="row row-mtm">
                                <div class="wish-table-item">
                                    <div class="row row-mtm30 align-items-center">
                                        <div class="col-12 col-md-5 col-lg-4">
                                            <div class="d-md-none heading-color heading-weight meb-11">Product</div>
                                            <div class="wish-item-content d-flex flex-wrap">
                                                <div class="wish-item-image width-88">
                                                    <a href="{{ route('products.show', $item->product->id) }}" class="d-block br-hidden">
                                                        <img src="{{ imgPath($item->product->main_image) }}" class="w-100 img-fluid" alt="{{ $item->product->name }}">
                                                    </a>
                                                </div>
                                                <div class="wish-item-info width-calc-88 psl-15">
                                                    <a href="{{ route('products.show', $item->product->id) }}" class="dominant-link heading-weight">{{ $item->product->name }}</a>
                                                    <div class="wish-item-price heading-color mst-8 heading-weight">
                                                        ₹{{ number_format($item->product->effectivePrice(), 2) }}
                                                        @if($item->product->hasDiscount())
                                                            <span class="ms-2 text-muted text-decoration-line-through">₹{{ number_format($item->product->price, 2) }}</span>
                                                        @endif
                                                    </div>
                                                    @if($item->product->quantity > 0)
                                                        <span class="text-success font-12"><i class="ri-check-line"></i> In Stock</span>
                                                    @else
                                                        <span class="text-danger font-12"><i class="ri-close-line"></i> Out of Stock</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <div class="d-md-none heading-color heading-weight meb-11">Price</div>
                                            <div class="wishlist-item-price heading-color heading-weight">
                                                ₹{{ number_format($item->product->effectivePrice(), 2) }}
                                                @if($item->product->hasDiscount())
                                                    <span class="ms-2 text-muted text-decoration-line-through">₹{{ number_format($item->product->price, 2) }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-2 col-lg-3">
                                            <div class="d-md-none heading-color heading-weight meb-11">Action</div>
                                            <button type="button"
                                                class="btn-style secondary-btn add-to-cart ajax-add-to-cart wishlist-add-to-cart"
                                                data-product-id="{{ $item->product->id }}"
                                                @if($item->product->quantity <= 0) disabled title="Out of stock" @endif>
                                                <span class="product-bag-icon">Add to cart</span>
                                                <span class="product-loader-icon icon-16" style="display:none;"><i class="ri-loader-4-line d-block lh-1"></i></span>
                                                <span class="product-check-icon icon-16" style="display:none;"><i class="ri-check-line d-block lh-1"></i></span>
                                            </button>
                                        </div>
                                        <div class="col-12 col-md-2 text-md-end">
                                            <div class="d-md-none heading-color heading-weight meb-11">Remove</div>
                                            <button type="button"
                                                class="wish-remove text-danger icon-16 remove-from-wishlist"
                                                data-wishlist-id="{{ $item->id }}"
                                                aria-label="Remove item">
                                                <i class="ri-close-large-line d-block lh-1"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>

            @else
            <!-- Empty Wishlist -->
            <div class="text-center py-5" data-animate="animate__fadeIn">
                <div class="meb-30">
                    <i class="ri-heart-line dominant-color" style="font-size: 80px; opacity: 0.4;"></i>
                </div>
                <h4 class="font-24 heading-color meb-15">Your wishlist is empty</h4>
                <p class="meb-30">Save items you love to your wishlist and come back to them anytime.</p>
                @guest
                <p class="meb-30"><a href="{{ route('login') }}" class="body-dominant-color text-decoration-underline">Login</a> or <a href="{{ route('register') }}" class="body-dominant-color text-decoration-underline">Create account</a> to save items permanently.</p>
                @endguest
                <a href="{{ route('products') }}" class="btn-style dominant-btn">Start Shopping</a>
            </div>
            @endif
        </div>
    </section>
    <!-- wishlist-page end -->
</main>
<!-- main end -->

@push('js')
<script>
$(document).ready(function() {

    // Remove single item from wishlist
    $(document).on('click', '.remove-from-wishlist', function() {
        let btn = $(this);
        let wishlistId = btn.data('wishlist-id');
        let row = btn.closest('.wishlist-row');

        row.css('opacity', 0.5);

        $.ajax({
            url: "{{ route('wishlist.remove') }}",
            type: "POST",
            data: { wishlist_id: wishlistId },
            success: function(res) {
                if (res.success) {
                    row.fadeOut(300, function() {
                        row.remove();
                        updateWishlistUI(res.wishlist_count);
                    });
                }
            },
            error: function() {
                row.css('opacity', 1);
                alert('Could not remove item. Please try again.');
            }
        });
    });

    // Clear entire wishlist
    $('#wishlist-clear-btn').on('click', function() {
        if (!confirm('Are you sure you want to clear your entire wishlist?')) return;

        $.ajax({
            url: "{{ route('wishlist.clear') }}",
            type: "POST",
            success: function(res) {
                if (res.success) {
                    location.reload();
                }
            }
        });
    });

    // Add single item to cart from wishlist page
    $(document).on('click', '.wishlist-add-to-cart', function(e) {
        e.preventDefault();
        let btn = $(this);
        let productId = btn.data('product-id');

        btn.find('.product-bag-icon').hide();
        btn.find('.product-loader-icon').addClass('ri-spin').show();

        $.ajax({
            url: "{{ route('cart.add') }}",
            type: "POST",
            data: { product_id: productId, quantity: 1 },
            success: function(res) {
                if (res.success) {
                    btn.find('.product-loader-icon').removeClass('ri-spin').hide();
                    btn.find('.product-check-icon').show();
                    $('.cart-counter').text(res.cart_count);
                    setTimeout(function() {
                        btn.find('.product-check-icon').hide();
                        btn.find('.product-bag-icon').show();
                    }, 2000);
                }
            },
            error: function(err) {
                alert(err.responseJSON ? err.responseJSON.message : 'Error adding to cart.');
                btn.find('.product-loader-icon').removeClass('ri-spin').hide();
                btn.find('.product-bag-icon').show();
            }
        });
    });

    // Add ALL wishlist items to cart
    $('#wishlist-add-all-cart').on('click', function() {
        let btn = $(this);
        let productIds = [];
        $('.wishlist-row').each(function() {
            productIds.push($(this).data('product-id'));
        });

        if (productIds.length === 0) return;

        btn.find('.product-bag-icon').hide();
        btn.find('.product-loader-icon').addClass('ri-spin').show();

        let promises = productIds.map(function(productId) {
            return $.ajax({
                url: "{{ route('cart.add') }}",
                type: "POST",
                data: { product_id: productId, quantity: 1 }
            });
        });

        $.when.apply($, promises).then(function() {
            btn.find('.product-loader-icon').removeClass('ri-spin').hide();
            btn.find('.product-check-icon').show();
            // Update cart counter with last response
            let responses = arguments;
            if (Array.isArray(responses[0])) {
                let lastRes = responses[responses.length - 1][0];
                if (lastRes && lastRes.cart_count !== undefined) {
                    $('.cart-counter').text(lastRes.cart_count);
                }
            }
            setTimeout(function() {
                btn.find('.product-check-icon').hide();
                btn.find('.product-bag-icon').show();
            }, 2000);
        }).fail(function() {
            btn.find('.product-loader-icon').removeClass('ri-spin').hide();
            btn.find('.product-bag-icon').show();
            alert('Some items could not be added to cart.');
        });
    });

    function updateWishlistUI(count) {
        $('.wishlist-counter').text(count);
        $('#wish-counter-title').text(count);
        $('#wishlist-item-count').text(count);

        if (count === 0) {
            location.reload();
        }
    }
});
</script>
@endpush

@endsection
