@if($cartItems->count() > 0)
    <div class="cart-item-list cart-drawer-item-list">
        @foreach($cartItems as $item)
            <div class="cart-item cart-drawer-card">
                <a href="{{ route('products.show', $item->product->id) }}" class="cart-image cart-drawer-thumb">
                    <img src="{{ $item->product->main_image ? imgPath($item->product->main_image) : asset('assets/images/index/product/p-1.jpg') }}" class="w-100 img-fluid" alt="{{ $item->product->name }}">
                </a>
                <div class="cart-content w-100">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('products.show', $item->product->id) }}" class="cart-title cart-drawer-title text-truncate" style="max-width: 170px;">{{ $item->product->name }}</a>
                        <button class="remove-cart-item cart-drawer-remove border-0 bg-transparent" data-id="{{ $item->id }}" aria-label="Remove item"><i class="ri-delete-bin-line"></i></button>
                    </div>
                    @if($item->size || $item->color)
                        <div class="cart-variants cart-drawer-variants">
                            @if($item->size) Size: {{ $item->size }} @endif
                            @if($item->color) Color: {{ $item->color }} @endif
                        </div>
                    @endif
                    <div class="cart-price cart-drawer-price">{{ number_format($item->price, 2) }}</div>
                    
                    <div class="cart-drawer-bottom">
                    <div class="js-qty-wrapper cart-qty-wrap cart-drawer-qty mt-2 mt-sm-0">
                        <div class="js-qty-wrap extra-bg border-full br-hidden">
                            <button type="button" class="qty-minus body-color" data-id="{{ $item->id }}" aria-label="Remove item"><i class="ri-subtract-line d-block lh-1"></i></button>
                            <input type="number" class="qty-num border-0" value="{{ $item->quantity }}" min="1" readonly style="width: 35px;">
                            <button type="button" class="qty-plus body-color" data-id="{{ $item->id }}" aria-label="Add item"><i class="ri-add-line d-block lh-1"></i></button>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="cart-empty text-center ptb-30">
        <i class="ri-shopping-cart-line font-40 text-muted"></i>
        <h6 class="mt-3">Your cart is empty.</h6>
        <a href="{{ route('products') }}" class="btn-style secondary-btn mt-3">Start Shopping</a>
    </div>
@endif
