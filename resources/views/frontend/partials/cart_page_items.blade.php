@if($cartItems->isEmpty())
    <div class="col-12 text-center py-5">
        <span class="secondary-color icon-32 mb-4 d-inline-block"><i class="ri-shopping-bag-3-line ri-4x"></i></span>
        <h2 class="font-24">Your cart is currently empty</h2>
        <a href="{{ route('products') }}" class="btn-style secondary-btn mt-4">Continue shopping</a>
    </div>
@else
    <div class="cart-itemview col-12 col-lg-8">
        <div class="cart-title d-flex align-items-center justify-content-between peb-30 beb">
            <h6 class="font-18">Shopping cart</h6>
            <span class="cart-count"><span class="cart-counter">{{ $cartItems->sum('quantity') }}</span> Items</span>
        </div>
        <div class="cart-table">
            <!-- ... table content ... -->
            <div class="cart-table-heading d-none d-md-block ptb-30 beb">
                <div class="row">
                    <div class="col-md-5 heading-color heading-weight">Product</div>
                    <div class="col-md-3 heading-color heading-weight">Qty</div>
                    <div class="col-md-2 heading-color heading-weight">Total</div>
                    <div class="col-md-2 heading-color heading-weight text-end">Option</div>
                </div>
            </div>
            <div class="cart-table-data">
                @foreach($cartItems as $item)
                    <div class="cart-table-info ptb-30 beb cart-item">
                        <div class="row row-mtm30 align-items-center">
                            <div class="col-12 col-md-5">
                                <div class="d-md-none heading-color heading-weight meb-11">Product</div>
                                <div class="cart-item-content d-flex flex-wrap align-items-center">
                                    <div class="cart-item-image width-88">
                                        <a href="{{ route('products.show', $item->product_id) }}" class="d-block br-hidden">
                                            <img src="{{ $item->product->main_image ? imgPath($item->product->main_image) : asset('assets/images/cart/cart-1.jpg') }}" class="w-100 img-fluid" alt="{{ $item->product->name }}">
                                        </a>
                                    </div>
                                    <div class="cart-item-info width-calc-88 psl-15">
                                        <a href="{{ route('products.show', $item->product_id) }}" class="dominant-link heading-weight">{{ $item->product->name }}</a>
                                        @if($item->size || $item->color)
                                            <span class="d-block mst-8">{{ $item->size }}{{ $item->size && $item->color ? ' / ' : '' }}{{ $item->color }}</span>
                                        @endif
                                        <span class="d-block mst-8 heading-color heading-weight">{{ number_format($item->price, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-sm-4 col-md-3">
                                <div class="d-md-none heading-color heading-weight meb-11">Qty</div>
                                <div class="js-qty-wrapper cart-qty-wrap">
                                    <div class="js-qty-wrap d-flex extra-bg border-full br-hidden">
                                        <button type="button" class="js-qty-adjust qty-minus body-color icon-16" data-id="{{ $item->id }}" aria-label="Remove item"><i class="ri-subtract-line d-block lh-1"></i></button>
                                        <input type="number" class="js-qty-num qty-num p-0 text-center border-0" value="{{ $item->quantity }}" min="1" readonly>
                                        <button type="button" class="js-qty-adjust qty-plus body-color icon-16" data-id="{{ $item->id }}" aria-label="Add item"><i class="ri-add-line d-block lh-1"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 col-sm-4 col-md-2">
                                <div class="d-md-none heading-color heading-weight meb-9">Total</div>
                                <div class="cart-total-price heading-color heading-weight">{{ number_format($item->price * $item->quantity, 2) }}</div>
                            </div>
                            <div class="col-3 col-sm-4 col-md-2 text-end">
                                <div class="d-md-none heading-color heading-weight meb-11">Option</div>
                                <button type="button" class="cart-remove text-danger icon-16 remove-cart-item" data-id="{{ $item->id }}" aria-label="Remove item"><i class="ri-delete-bin-line d-block lh-1"></i></button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="cart-summary-button d-flex flex-wrap justify-content-sm-between mt-4">
            <a href="{{ route('products') }}" class="width-100 width-sm-auto btn-style quaternary-btn">Continue shopping</a>
            <button type="button" id="clear-cart-btn" class="width-100 width-sm-auto btn-style secondary-btn mst-15 mst-sm-0">Clear cart</button>
        </div>
    </div>
    <div class="cart-summaryview col-12 col-lg-4 p-lg-sticky top-0 mt-5 mt-lg-0">
        <div class="cart-summary">
            <div class="cart-orderview">
                <div class="cart-info">
                    <div class="cart-discount-title d-flex align-items-center justify-content-between">
                        <span>Use discount code</span>
                        <button type="button" class="cart-code-edit body-secondary-color icon-16" aria-label="Edit"><i class="ri-edit-2-line d-block lh-1"></i></button>
                    </div>
                </div>
            </div>
            <div class="cart-costview">
                <div class="cart-cost pst-30 mst-30 bst">
                    <div class="row row-mtm20">
                        <div class="col-12 d-flex justify-content-between">
                            <span>Subtotal</span>
                            <span class="heading-color heading-weight subtotal-amount">{{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="col-12 d-flex justify-content-between">
                            <span>Discount</span>
                            <span class="text-danger heading-weight">0.00</span>
                        </div>
                        <div class="col-12 d-flex justify-content-between">
                            <span>Shipping</span>
                            <span class="text-success heading-weight">0.00</span>
                        </div>
                    </div>
                </div>
                <div class="cart-cost pst-30 mst-30 bst">
                    <div class="row row-mtm20">
                        <div class="col-12 d-flex justify-content-between">
                            <span>Total</span>
                            <span class="heading-color heading-weight subtotal-amount">{{ number_format($subtotal, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cart-button mst-30">
                <a href="{{ url('checkout') }}" class="w-100 btn-style secondary-btn">Checkout</a>
                <span class="d-block font-12 mst-12">Taxes excluded at checkout*</span>
            </div>
        </div>
    </div>
@endif
