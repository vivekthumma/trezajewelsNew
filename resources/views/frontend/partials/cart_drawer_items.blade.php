@if($cartItems->count() > 0)
    <ul class="cart-item-list">
        @foreach($cartItems as $item)
            <li class="cart-item d-flex align-items-center meb-15">
                <a href="{{ route('products.show', $item->product->id) }}" class="cart-image br-hidden">
                    <img src="{{ $item->product->main_image ? imgPath($item->product->main_image) : asset('assets/images/index/product/p-1.jpg') }}" class="w-100 img-fluid" alt="{{ $item->product->name }}">
                </a>
                <div class="cart-content msl-15 w-100">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('products.show', $item->product->id) }}" class="cart-title heading-color heading-weight text-truncate" style="max-width: 150px;">{{ $item->product->name }}</a>
                        <button class="remove-cart-item text-danger border-0 bg-transparent" data-id="{{ $item->id }}" aria-label="Remove item"><i class="ri-delete-bin-line"></i></button>
                    </div>
                    @if($item->size || $item->color)
                        <div class="cart-variants text-muted small">
                            @if($item->size) Size: {{ $item->size }} @endif
                            @if($item->color) Color: {{ $item->color }} @endif
                        </div>
                    @endif
                    <div class="cart-price heading-weight dominant-color mt-1">{{ number_format($item->price, 2) }}</div>
                    
                    <div class="js-qty-wrapper cart-qty-wrap mt-2">
                        <div class="js-qty-wrap d-flex extra-bg border-full br-hidden">
                            <button type="button" class="qty-minus body-color icon-16" data-id="{{ $item->id }}" aria-label="Remove item"><i class="ri-subtract-line d-block lh-1"></i></button>
                            <input type="number" class="qty-num p-0 text-center border-0" value="{{ $item->quantity }}" min="1" readonly style="width: 30px;">
                            <button type="button" class="qty-plus body-color icon-16" data-id="{{ $item->id }}" aria-label="Add item"><i class="ri-add-line d-block lh-1"></i></button>
                        </div>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
@else
    <div class="cart-empty text-center ptb-30">
        <i class="ri-shopping-cart-line font-40 text-muted"></i>
        <h6 class="mt-3">Your cart is empty.</h6>
        <a href="{{ route('products') }}" class="btn-style secondary-btn mt-3">Start Shopping</a>
    </div>
@endif
