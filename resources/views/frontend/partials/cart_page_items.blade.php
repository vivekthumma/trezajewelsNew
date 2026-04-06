@if($cartItems->isEmpty())
    <div class="col-12">
        <div class="cart-empty-panel text-center py-5">
        <span class="secondary-color icon-32 mb-4 d-inline-block"><i class="ri-shopping-bag-3-line ri-4x"></i></span>
        <h2 class="font-24">Your cart is currently empty</h2>
        <a href="{{ route('products') }}" class="btn-style secondary-btn mt-4">Continue shopping</a>
        </div>
    </div>
@else
    <div class="cart-itemview col-12 col-lg-8">
        <div class="cart-panel">
            <div class="cart-header">
                <div>
                    <h2>Shopping Cart</h2>
                    <p>Review your selected jewellery pieces before checkout.</p>
                </div>
                <span class="cart-badge"><span class="cart-counter">{{ $cartItems->sum('quantity') }}</span> Item{{ $cartItems->sum('quantity') > 1 ? 's' : '' }}</span>
            </div>

            <div class="cart-lines">
                @foreach($cartItems as $item)
                    <div class="cart-line-card cart-item">
                        <div class="cart-line-grid">
                            <div>
                                <span class="cart-label-mobile">Product</span>
                                <div class="cart-line-product">
                                    <div class="cart-line-thumb">
                                        <a href="{{ route('products.show', $item->product_id) }}" class="d-block">
                                            <img src="{{ $item->product->main_image ? imgPath($item->product->main_image) : asset('assets/images/cart/cart-1.jpg') }}" class="w-100 img-fluid" alt="{{ $item->product->name }}">
                                        </a>
                                    </div>
                                    <div>
                                        <a href="{{ route('products.show', $item->product_id) }}" class="cart-line-title">{{ $item->product->name }}</a>
                                        @if($item->size || $item->color)
                                            <span class="cart-line-meta d-block">{{ $item->size }}{{ $item->size && $item->color ? ' / ' : '' }}{{ $item->color }}</span>
                                        @endif
                                        <span class="cart-line-price d-block">₹{{ number_format($item->price, 2) }}</span>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <span class="cart-label-mobile">Qty</span>
                                <div class="js-qty-wrapper cart-qty-wrap cart-page-qty">
                                    <div class="js-qty-wrap extra-bg border-full br-hidden">
                                        <button type="button" class="js-qty-adjust qty-minus body-color" data-id="{{ $item->id }}" aria-label="Remove item"><i class="ri-subtract-line d-block lh-1"></i></button>
                                        <input type="number" class="js-qty-num qty-num border-0" value="{{ $item->quantity }}" min="1" readonly>
                                        <button type="button" class="js-qty-adjust qty-plus body-color" data-id="{{ $item->id }}" aria-label="Add item"><i class="ri-add-line d-block lh-1"></i></button>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <span class="cart-label-mobile">Total</span>
                                <div class="cart-total-price cart-value-strong">₹{{ number_format($item->price * $item->quantity, 2) }}</div>
                            </div>

                            <div class="text-md-end">
                                <span class="cart-label-mobile">Remove</span>
                                <button type="button" class="cart-remove cart-remove-btn text-danger icon-16 remove-cart-item" data-id="{{ $item->id }}" aria-label="Remove item"><i class="ri-delete-bin-line d-block lh-1"></i></button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="cart-actions-row">
                <a href="{{ route('products') }}" class="width-100 width-sm-auto btn-style quaternary-btn">Continue shopping</a>
                <button type="button" id="clear-cart-btn" class="width-100 width-sm-auto btn-style secondary-btn mst-15 mst-sm-0">Clear cart</button>
            </div>
        </div>
    </div>
    <div class="cart-summaryview col-12 col-lg-4 p-lg-sticky top-0 mt-5 mt-lg-0">
        <div class="cart-summary-panel">
            <div class="cart-summary-head">
                <h3>Cost Summary</h3>
                <span class="cart-badge">Order Total</span>
            </div>
            <div class="cart-summary-note">Review your subtotal and proceed to secure checkout.</div>

            <div class="cart-summary-box">
                <div class="cart-summary-row">
                    <span>Subtotal</span>
                    <span class="subtotal-amount">₹{{ number_format($subtotal, 2) }}</span>
                </div>
                <div class="cart-summary-row discount">
                    <span>Discount</span>
                    <span>0.00</span>
                </div>
                <div class="cart-summary-row shipping">
                    <span>Shipping</span>
                    <span>0.00</span>
                </div>
                <div class="cart-summary-total">
                    <strong>Total</strong>
                    <strong class="subtotal-amount">₹{{ number_format($subtotal, 2) }}</strong>
                </div>
            </div>

            <div class="cart-button mst-30">
                <a href="{{ url('checkout') }}" class="w-100 btn-style secondary-btn">Checkout</a>
                <span class="d-block font-12 mst-12">Taxes excluded at checkout*</span>
            </div>
        </div>
    </div>
@endif
