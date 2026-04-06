@extends('layouts.app')

@section('title', 'Checkout - Treza Jewels')

@push('css')
<style>
    .checkout-shell {
        max-width: 1320px;
        margin: 0 auto;
    }

    .checkout-main-card,
    .checkout-summary-card,
    .checkout-block,
    .checkout-mini-card {
        background: #fff;
        border: 1px solid rgba(176, 139, 102, 0.14);
        border-radius: 28px;
        box-shadow: 0 24px 60px rgba(143, 111, 76, 0.08);
    }

    .checkout-main-card,
    .checkout-summary-card {
        padding: 28px;
    }

    .checkout-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 22px;
    }

    .checkout-heading h2 {
        margin: 0;
        font-size: 30px;
        font-family: "Marcellus", serif;
        color: #2d2a26;
    }

    .checkout-heading p {
        margin: 6px 0 0;
        color: #8b8073;
        font-size: 14px;
    }

    .checkout-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 9px 14px;
        border-radius: 999px;
        background: #f7f0e7;
        color: #b08b66;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: .08em;
        text-transform: uppercase;
    }

    .checkout-block {
        padding: 22px;
        margin-top: 22px;
    }

    .checkout-block:first-child {
        margin-top: 0;
    }

    .checkout-block-title {
        margin: 0 0 18px;
        font-size: 24px;
        font-family: "Marcellus", serif;
        color: #2d2a26;
    }

    .checkout-checkbox-card {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 14px 16px;
        border-radius: 18px;
        background: #fcfaf7;
        border: 1px solid #eee4d8;
    }

    .checkout-form-label {
        display: block;
        margin-bottom: 8px;
        color: #6e665d;
        font-size: 14px;
        font-weight: 600;
    }

    .checkout-input,
    .checkout-select {
        width: 100%;
        min-height: 58px;
        border: 1px solid #e7ded2 !important;
        background: #fffdfb !important;
        border-radius: 16px !important;
        padding: 14px 16px !important;
        color: #2f2a26;
        transition: border-color .25s ease, box-shadow .25s ease, background-color .25s ease;
        box-shadow: none !important;
    }

    .checkout-input:focus,
    .checkout-select:focus {
        border-color: #cda97f !important;
        box-shadow: 0 0 0 4px rgba(205, 169, 127, 0.12) !important;
        background: #fff !important;
        outline: none;
    }

    .payment-options-wrapper {
        display: grid;
        gap: 16px;
    }

    .payment-option-item {
        position: relative;
        cursor: pointer;
        display: block;
    }

    .payment-option-item input {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }

    .payment-option-content {
        display: flex;
        align-items: center;
        gap: 18px;
        padding: 18px 20px;
        background: #fcfaf7;
        border: 1px solid #eadfce;
        border-radius: 18px;
        transition: all .25s ease;
    }

    .payment-option-item:hover .payment-option-content {
        border-color: #d8c2ab;
        transform: translateY(-1px);
    }

    .payment-option-item input:checked + .payment-option-content {
        background: linear-gradient(180deg, #fffaf4 0%, #f8efe4 100%);
        border-color: #cda97f;
        box-shadow: 0 10px 24px rgba(176, 139, 102, 0.12);
    }

    .radio-indicator {
        width: 22px;
        height: 22px;
        border: 2px solid #cfb79c;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .radio-indicator::after {
        content: "";
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: #b08b66;
        transform: scale(0);
        transition: transform .2s ease;
    }

    .payment-option-item input:checked + .payment-option-content .radio-indicator {
        border-color: #b08b66;
    }

    .payment-option-item input:checked + .payment-option-content .radio-indicator::after {
        transform: scale(1);
    }

    .payment-text h6 {
        margin: 0 0 4px;
        font-size: 17px;
        font-weight: 700;
        color: #2d2a26;
    }

    .payment-text p {
        margin: 0;
        color: #8b8073;
        font-size: 13px;
    }

    .checkout-submit {
        min-height: 58px;
        border-radius: 16px !important;
        font-weight: 700;
        font-size: 16px;
        letter-spacing: .02em;
    }

    .checkout-summary-card {
        position: sticky;
        top: 24px;
    }

    .checkout-order-list {
        display: grid;
        gap: 16px;
    }

    .checkout-order-item {
        display: grid;
        grid-template-columns: 88px minmax(0, 1fr);
        gap: 14px;
        padding: 14px;
        border-radius: 20px;
        background: #fcfaf7;
        border: 1px solid #eee4d8;
    }

    .checkout-order-thumb {
        position: relative;
        border-radius: 18px;
        overflow: hidden;
        background: #fff;
        aspect-ratio: 1 / 1.12;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .checkout-order-thumb img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .checkout-order-qty {
        position: absolute;
        top: 8px;
        right: 8px;
        min-width: 24px;
        height: 24px;
        padding: 0 6px;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #2d2a26;
        color: #fff;
        font-size: 12px;
        font-weight: 700;
    }

    .checkout-order-name {
        color: #2d2a26;
        font-size: 22px;
        font-family: "Marcellus", serif;
        line-height: 1.12;
        text-decoration: none;
    }

    .checkout-order-name:hover {
        color: #b08b66;
    }

    .checkout-order-meta {
        margin-top: 8px;
        color: #8b8073;
        font-size: 13px;
    }

    .checkout-order-price {
        margin-top: 14px;
        color: #b08b66;
        font-size: 24px;
        font-weight: 700;
    }

    .checkout-summary-totals {
        margin-top: 22px;
        padding-top: 22px;
        border-top: 1px solid #eee4d8;
        display: grid;
        gap: 14px;
    }

    .checkout-total-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        color: #6e665d;
    }

    .checkout-total-row span:last-child {
        color: #2d2a26;
        font-weight: 600;
    }

    .checkout-total-row.discount span:last-child {
        color: #f04452;
    }

    .checkout-total-row.shipping span:last-child {
        color: #15915a;
    }

    .checkout-grand-total {
        margin-top: 16px;
        padding-top: 16px;
        border-top: 1px solid #e9dece;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
    }

    .checkout-grand-total strong:first-child {
        font-size: 20px;
        color: #2d2a26;
    }

    .checkout-grand-total strong:last-child {
        font-size: 30px;
        color: #b08b66;
    }

    @media (max-width: 991px) {
        .checkout-summary-card {
            position: static;
        }
    }

    @media (max-width: 767px) {
        .checkout-main-card,
        .checkout-summary-card,
        .checkout-block {
            padding: 18px;
            border-radius: 20px;
        }

        .checkout-heading {
            flex-direction: column;
            align-items: flex-start;
        }

        .checkout-heading h2,
        .checkout-block-title,
        .checkout-order-name {
            font-size: 24px;
        }

        .checkout-order-item {
            grid-template-columns: 72px minmax(0, 1fr);
            padding: 12px;
        }

        .checkout-order-price,
        .checkout-grand-total strong:last-child {
            font-size: 22px;
        }
    }
</style>
@endpush

@section('content')
<div class="breadcrumb-area ptb-15" data-bgimg="{{ asset('assets/images/other/breadcrumb-bgimg.jpg') }}">
    <div class="container">
        <span class="d-block extra-color"><a href="{{ url('/') }}" class="extra-color">Home</a> / Checkout</span>
    </div>
</div>

<section class="checkout-area section-ptb">
    <form method="POST" id="checkout-form">
        @csrf
        <div class="container checkout-shell">
            <div class="row g-4 flex-lg-row-reverse align-items-start">
                <div class="col-12 col-lg-5">
                    <div class="checkout-summary-card">
                        <div class="checkout-heading">
                            <div>
                                <h2>Order Summary</h2>
                                <p>Review your selected items before placing the order.</p>
                            </div>
                            <span class="checkout-badge">{{ $cartItems->sum('quantity') }} Item{{ $cartItems->sum('quantity') > 1 ? 's' : '' }}</span>
                        </div>

                        <div class="checkout-order-list">
                            @foreach($cartItems as $item)
                                <div class="checkout-order-item">
                                    <div class="checkout-order-thumb">
                                        <img src="{{ $item->product->main_image ? imgPath($item->product->main_image) : asset('assets/images/cart/cart-1.jpg') }}" alt="{{ $item->product->name }}">
                                        <span class="checkout-order-qty">{{ $item->quantity }}</span>
                                    </div>
                                    <div>
                                        <a href="{{ route('products.show', $item->product_id) }}" class="checkout-order-name">{{ $item->product->name }}</a>
                                        @if($item->size || $item->color)
                                            <div class="checkout-order-meta">{{ $item->size }}{{ $item->size && $item->color ? ' / ' : '' }}{{ $item->color }}</div>
                                        @endif
                                        <div class="checkout-order-price">₹{{ number_format($item->price * $item->quantity, 2) }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="checkout-summary-totals">
                            <div class="checkout-total-row">
                                <span>Subtotal</span>
                                <span class="subtotal-amount">₹{{ number_format($subtotal, 2) }}</span>
                            </div>
                            <div class="checkout-total-row discount">
                                <span>Discount</span>
                                <span>0.00</span>
                            </div>
                            <div class="checkout-total-row shipping">
                                <span>Shipping</span>
                                <span>0.00</span>
                            </div>
                            <div class="checkout-total-row">
                                <span>Tax</span>
                                <span>0.00</span>
                            </div>
                        </div>

                        <div class="checkout-grand-total">
                            <strong>Total</strong>
                            <strong class="subtotal-amount">₹{{ number_format($subtotal, 2) }}</strong>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-7">
                    <div class="checkout-main-card">
                        <div class="checkout-heading">
                            <div>
                                <h2>Checkout</h2>
                                <p>Fill in your shipping details and choose a payment method.</p>
                            </div>
                        </div>

                        <div class="checkout-block">
                            <h3 class="checkout-block-title">Shipping Address</h3>
                            <div class="row g-3">
                                <div class="col-12 col-md-6">
                                    <label for="first_name" class="checkout-form-label">First Name</label>
                                    <input type="text" id="first_name" name="first_name" class="checkout-input" placeholder="First Name" required>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="last_name" class="checkout-form-label">Last Name</label>
                                    <input type="text" id="last_name" name="last_name" class="checkout-input" placeholder="Last Name" required>
                                </div>
                                <div class="col-12">
                                    <label for="email" class="checkout-form-label">Email</label>
                                    <input type="email" id="email" name="email" class="checkout-input" placeholder="Email address" required>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="phone" class="checkout-form-label">Phone</label>
                                    <input type="text" id="phone" name="phone" class="checkout-input" placeholder="Phone number" required>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="country" class="checkout-form-label">Country</label>
                                    <select id="country" name="country" class="checkout-select" required>
                                        <option value="India">India</option>
                                        <option value="USA">USA</option>
                                        <option value="UK">UK</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="state" class="checkout-form-label">State</label>
                                    <input type="text" id="state" name="state" class="checkout-input" placeholder="State" required>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="city" class="checkout-form-label">City</label>
                                    <input type="text" id="city" name="city" class="checkout-input" placeholder="City" required>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="address" class="checkout-form-label">Address</label>
                                    <input type="text" id="address" name="address" class="checkout-input" placeholder="Address line 1" required>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="pincode" class="checkout-form-label">Pincode</label>
                                    <input type="text" id="pincode" name="pincode" class="checkout-input" placeholder="Pincode" required>
                                </div>
                            </div>
                        </div>

                        <div class="checkout-block">
                            <h3 class="checkout-block-title">Payment Method</h3>
                            <div class="payment-options-wrapper">
                                <label class="payment-option-item">
                                    <input type="radio" name="payment_method" value="cod" checked>
                                    <div class="payment-option-content">
                                        <div class="radio-indicator"></div>
                                        <div class="payment-text">
                                            <h6>Cash On Delivery</h6>
                                            <p>Pay with cash once your order arrives at your address.</p>
                                        </div>
                                    </div>
                                </label>

                                <label class="payment-option-item">
                                    <input type="radio" name="payment_method" value="razorpay">
                                    <div class="payment-option-content">
                                        <div class="radio-indicator"></div>
                                        <div class="payment-text">
                                            <h6>Razorpay</h6>
                                            <p>Pay securely using cards, UPI, wallets or netbanking.</p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div class="checkout-block">
                            <button type="submit" class="btn-style secondary-btn w-100 checkout-submit" data-default-text="Place Order">Place Order</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>

@push('js')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    $(document).ready(function() {
        const form = $('#checkout-form');
        const submitBtn = form.find('button[type="submit"]');
        const defaultButtonText = submitBtn.data('default-text') || $.trim(submitBtn.text());

        function setSubmitState(isLoading, loadingText) {
            submitBtn.prop('disabled', isLoading).text(isLoading ? loadingText : defaultButtonText);
        }

        function buildPayload(extraData = {}) {
            const data = {};

            $.each(form.serializeArray(), function(_, field) {
                data[field.name] = field.value;
            });

            return Object.assign(data, extraData);
        }

        function getErrorMessage(xhr) {
            if (!xhr.responseJSON) {
                return 'Something went wrong. Please try again.';
            }

            if (xhr.responseJSON.errors) {
                return Object.values(xhr.responseJSON.errors)
                    .flat()
                    .join("\n");
            }

            if (xhr.responseJSON.message) {
                return xhr.responseJSON.message;
            }

            return 'Something went wrong. Please try again.';
        }

        function submitOrder(extraData = {}) {
            const isRazorpay = extraData.payment_method === 'razorpay';
            setSubmitState(true, isRazorpay ? 'Verifying Payment...' : 'Placing Order...');

            $.ajax({
                url: "{{ route('order.place') }}",
                type: "POST",
                data: buildPayload(extraData),
                success: function(res) {
                    if (res.success) {
                        window.location.href = "{{ url('/thank-you') }}/" + res.order_id;
                        return;
                    }

                    alert(res.message || 'Unable to place the order.');
                    setSubmitState(false);
                },
                error: function(xhr) {
                    alert(getErrorMessage(xhr));
                    setSubmitState(false);
                }
            });
        }

        function startRazorpayPayment() {
            if (typeof Razorpay === 'undefined') {
                alert('Razorpay checkout failed to load. Please refresh and try again.');
                return;
            }

            setSubmitState(true, 'Connecting to Razorpay...');

            $.ajax({
                url: "{{ route('payment.razorpay.order') }}",
                type: "POST",
                data: buildPayload(),
                success: function(res) {
                    if (!res.success) {
                        alert(res.message || 'Unable to start Razorpay payment.');
                        setSubmitState(false);
                        return;
                    }

                    const razorpay = new Razorpay({
                        key: res.key,
                        amount: res.amount,
                        currency: res.currency,
                        name: res.name,
                        description: res.description,
                        order_id: res.order_id,
                        prefill: res.prefill || {},
                        notes: res.notes || {},
                        theme: res.theme || {},
                        handler: function(response) {
                            submitOrder({
                                payment_method: 'razorpay',
                                razorpay_payment_id: response.razorpay_payment_id,
                                razorpay_order_id: response.razorpay_order_id,
                                razorpay_signature: response.razorpay_signature
                            });
                        },
                        modal: {
                            ondismiss: function() {
                                setSubmitState(false);
                            }
                        }
                    });

                    razorpay.on('payment.failed', function(response) {
                        const message = response.error && response.error.description
                            ? response.error.description
                            : 'Payment failed. Please try again.';

                        alert(message);
                        setSubmitState(false);
                    });

                    razorpay.open();
                },
                error: function(xhr) {
                    alert(getErrorMessage(xhr));
                    setSubmitState(false);
                }
            });
        }

        $(document).on('submit', '#checkout-form', function(e) {
            e.preventDefault();

            const paymentMethod = form.find('input[name="payment_method"]:checked').val();

            if (paymentMethod === 'razorpay') {
                startRazorpayPayment();
                return;
            }

            submitOrder({
                payment_method: 'cod'
            });
        });
    });
</script>
@endpush
@endsection
