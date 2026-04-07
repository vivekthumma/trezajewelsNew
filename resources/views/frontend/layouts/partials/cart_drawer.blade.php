<!-- cart-drawer start -->
<div class="cart-drawer position-fixed top-0 bottom-0 body-bg z-index-5 invisible box-shadow" id="cart-drawer">
    <div class="drawer-contents d-flex flex-column h-100 w-100">
        <div class="drawer-fixed-header ptb-10 plr-15 beb">
            <div class="drawer-header d-flex align-items-center justify-content-between">
                <h6 class="font-18 text-uppercase heading-weight mb-0">Your Cart</h6>
                <div class="drawer-close">
                    <button type="button" class="drawer-close-btn body-secondary-color icon-16 bg-transparent border-0" aria-label="Close cart drawer"><i class="ri-close-large-line d-block lh-1"></i></button>
                </div>
            </div>
        </div>
        <div class="pst-10 plr-15 text-center">
            <div class="extra-color font-14 ptb-6 plr-15 dominant-bg">Exclusive Jewelry, Exclusively for You.</div>
        </div>

        <div class="drawer-inner h-100 d-flex flex-column justify-content-between overflow-hidden">
            <div class="drawer-scrollable h-100 overflow-auto">
                <div class="cart-drawer-table plr-15" id="cart-drawer-items">
                    @if(isset($cartItems) && $cartItems->count() > 0)
                        @foreach($cartItems as $item)
                        <div class="cart-drawer-info ptb-15 bst">
                            <div class="cart-drawer-content d-flex flex-wrap">
                                <div class="cart-drawer-image width-88">
                                    <a href="{{ route('products.show', $item->product->id) }}" class="d-block border">
                                        <img src="{{ $item->product->main_image ? imgPath($item->product->main_image) : asset('frontend/images/index2/product/p-1.jpg') }}" class="w-100 img-fluid" alt="{{ $item->product->name }}">
                                    </a>
                                </div>
                                <div class="cart-drawer-info-content width-calc-88 psl-15">
                                    <div class="cart-drawer-detail">
                                        <h6 class="font-14 text-truncate heading-weight mb-0"><a href="{{ route('products.show', $item->product->id) }}" class="body-color">{{ $item->product->name }}</a></h6>
                                        @if($item->size || $item->color)
                                            <span class="d-block mst-8 font-12 opacity-75">
                                                @if($item->size) Size: {{ $item->size }} @endif
                                                @if($item->color) | Color: {{ $item->color }} @endif
                                            </span>
                                        @endif
                                    </div>
                                    <div class="cart-drawer-qty-remove d-flex align-items-center justify-content-between mst-16">
                                        <div class="heading-color heading-weight dominant-color">₹{{ number_format($item->price, 2) }}</div>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="js-qty-wrapper cart-drawer-qty">
                                                <div class="js-qty-wrap d-flex align-items-center flex-nowrap extra-bg border-full rounded-pill overflow-hidden" style="display: inline-flex; width: max-content; border: 1px solid #eee;">
                                                    <button type="button" class="qty-minus body-color bg-transparent border-0 px-1 py-0 d-flex align-items-center justify-content-center" data-id="{{ $item->id }}" style="width: 28px; height: 28px;" aria-label="Decrease quantity"><i class="ri-subtract-line d-block lh-1" style="font-size: 12px;"></i></button>
                                                    <input type="number" class="qty-num p-0 text-center border-0 bg-transparent font-12 heading-weight body-color" value="{{ $item->quantity }}" min="1" readonly style="width: 25px; height: 28px;">
                                                    <button type="button" class="qty-plus body-color bg-transparent border-0 px-1 py-0 d-flex align-items-center justify-content-center" data-id="{{ $item->id }}" style="width: 28px; height: 28px;" aria-label="Increase quantity"><i class="ri-add-line d-block lh-1" style="font-size: 12px;"></i></button>
                                                </div>
                                            </div>
                                            <button type="button" class="remove-cart-item text-danger border-0 bg-transparent p-0 icon-16" data-id="{{ $item->id }}" aria-label="Remove item" style="padding-left: 5px !important;"><i class="ri-delete-bin-line d-block lh-1"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="drawer-cart-empty h-100 ptb-50 plr-15 text-center d-flex flex-column align-items-center justify-content-center">
                            <span class="secondary-color icon-40 meb-24 opacity-50"><i class="ri-shopping-bag-3-outline d-block lh-1"></i></span>
                            <h2 class="font-20 heading-weight">Your cart is empty</h2>
                            <p class="text-muted font-14">Looks like you haven't added anything to your cart yet.</p>
                            <a href="{{ route('products') }}" class="btn-style dominant-btn text-uppercase heading-weight width-100 mst-20 font-14">Shop our collections</a>
                        </div>
                    @endif
                </div>
            </div>
            
            @if(isset($cartItems) && $cartItems->count() > 0)
            <div class="drawer-footer ptb-15 plr-15 bst">
                <div class="drawer-total d-flex justify-content-between align-items-center mb-2">
                    <span class="text-uppercase heading-weight font-14">Estimated Total</span>
                    <span class="heading-color heading-weight font-18 dominant-color cart-total">₹{{ number_format($cartSubtotal ?? 0, 2) }}</span>
                </div>
                <div class="font-12 mb-3 text-muted">Shipping, taxes, and discounts calculated at checkout.</div>
                <div class="cart-bottom-btn">
                    <a href="{{ route('cart.page') }}" class="btn-style secondary-btn w-100 meb-10 text-center font-14 p-2 d-block">View cart</a>
                    <a href="{{ route('checkout') }}" class="btn-style dominant-btn w-100 text-center font-14 p-2 d-block">Checkout</a>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
<!-- cart-drawer end -->
