@extends('layouts.app')

@section('title', 'Checkout - Treza Jewels')

@section('style')
<style>
    .payment-options-wrapper {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }
    .payment-option-item {
        position: relative;
        cursor: pointer;
        transition: all 0.3s ease;
        display: block;
    }
    .payment-option-item input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }
    .payment-option-content {
        padding: 20px 25px;
        background: #fff;
        border: 2px solid #f2f2f2;
        border-radius: 12px;
        display: flex;
        align-items: center;
        gap: 20px;
        transition: all 0.3s ease;
    }
    .payment-option-item:hover .payment-option-content {
        border-color: #ddd;
    }
    .payment-option-item input:checked + .payment-option-content {
        border-color: #f7a392; /* Theme primary color */
        background-color: #fff9f8;
    }
    .radio-indicator {
        width: 20px;
        height: 20px;
        border: 2px solid #ddd;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: all 0.3s ease;
    }
    .payment-option-item input:checked + .payment-option-content .radio-indicator {
        border-color: #f7a392;
    }
    .radio-indicator::after {
        content: "";
        width: 10px;
        height: 10px;
        background: #f7a392;
        border-radius: 50%;
        transform: scale(0);
        transition: transform 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .payment-option-item input:checked + .payment-option-content .radio-indicator::after {
        transform: scale(1);
    }
    .payment-text h6 {
        margin: 0 0 4px;
        font-weight: 600;
        color: #333;
    }
    .payment-text p {
        margin: 0;
        font-size: 13px;
        color: #777;
    }
    .payment-option-item.disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }
    .payment-option-item.disabled .payment-option-content {
        background: #fdfdfd;
    }
</style>
@endsection

@section('content')
<!-- breadcrumb-area start -->
<div class="breadcrumb-area ptb-15" data-bgimg="{{ asset('assets/images/other/breadcrumb-bgimg.jpg') }}">
    <div class="container">
        <span class="d-block extra-color"><a href="{{ url('/') }}" class="extra-color">Home</a> / Checkout</span>
    </div>
</div>
<!-- breadcrumb-area end -->

<!-- checkout start -->
<section class="checkout-area section-ptb">
    <form method="POST" id="checkout-form">
        @csrf
        <div class="container">
            <div class="row row-mtm flex-lg-row-reverse align-items-lg-start">
                <div class="col-12 col-lg-5 p-lg-sticky top-0" data-animate="animate__fadeIn">
                    <div class="checkout-summary">
                        <div class="checkout-orderview">
                            <h6 class="font-18 meb-25">Shopping cart <span class="checkcart-count cart-counter">{{ $cartItems->sum('quantity') }}</span></h6>
                            <div class="row row-mtm15 checkout-item-list">
                                @foreach($cartItems as $item)
                                <div class="checkitem-content mb-3">
                                    <div class="ul-mt15 d-flex">
                                        <div class="checkitem-img width-88 me-3">
                                            <div class="position-relative">
                                                <img src="{{ $item->product->main_image ? imgPath($item->product->main_image) : asset('assets/images/cart/cart-1.jpg') }}" class="w-100 img-fluid border-radius" alt="{{ $item->product->name }}">
                                                <span class="checkitem-qty extra-color font-11 position-absolute d-flex align-items-center justify-content-center secondary-bg rounded-circle lh-1" style="width: 20px; height: 20px; top: -5px; right: -5px;">{{ $item->quantity }}</span>
                                            </div>
                                        </div>
                                        <div class="checkitem-info width-calc-88 flex-grow-1">
                                            <div class="checkitem-detail h-100 d-flex flex-column justify-content-between">
                                                <div class="checkitem-text">
                                                    <a href="{{ route('products.show', $item->product_id) }}" class="dominant-link heading-weight">{{ $item->product->name }}</a>
                                                    @if($item->size || $item->color)
                                                        <div class="mst-8">{{ $item->size }}{{ $item->size && $item->color ? ' / ' : '' }}{{ $item->color }}</div>
                                                    @endif
                                                </div>
                                                <div class="checkitem-price mst-10 text-end">
                                                    <div class="heading-color heading-weight">{{ number_format($item->price * $item->quantity, 2) }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="checkout-costview">
                            <div class="checkout-cost mst-30 pst-30 bst">
                                <h6 class="font-18 meb-22">Cost summary</h6>
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
                                    <div class="col-12 d-flex justify-content-between">
                                        <span>Tax</span>
                                        <span class="heading-color heading-weight">0.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout-cost mst-30 pst-30 bst">
                                <div class="row row-mtm22">
                                    <div class="col-12 d-flex justify-content-between">
                                        <span class="font-18 heading-weight">Total</span>
                                        <span class="font-18 heading-color heading-weight subtotal-amount">{{ number_format($subtotal, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-7">
                    <div class="checktab-overview">
                        <div class="checktab-content">
                            <div class="checkout-box peb-30 meb-30 beb">
                                <label class="cust-checkbox-label">
                                    <input type="checkbox" id="news-email" name="news-email" class="cust-checkbox">
                                    <span class="d-block cust-check"></span>
                                    <span>Email me with news and offers</span>
                                </label>
                            </div>
                            <div class="checktab-detail">
                                <div class="checktab-data">
                                    <div class="checktab-info">
                                        <div class="acc-info">
                                            <div class="acc-title d-flex align-items-center justify-content-between">
                                                <h6 class="font-18">Shipping address</h6>
                                            </div>
                                            <div class="acc-detail-form mst-22">
                                                <div class="row field-row">
                                                    <div class="col-12 col-md-6 field-col mb-3">
                                                        <label for="first_name" class="field-label">First Name</label>
                                                        <input type="text" id="first_name" name="first_name" class="w-100 form-control" placeholder="First Name" required>
                                                    </div>
                                                    <div class="col-12 col-md-6 field-col mb-3">
                                                        <label for="last_name" class="field-label">Last Name</label>
                                                        <input type="text" id="last_name" name="last_name" class="w-100 form-control" placeholder="Last Name" required>
                                                    </div>
                                                    <div class="col-12 col-md-12 field-col mb-3">
                                                        <label for="email" class="field-label">Email</label>
                                                        <input type="email" id="email" name="email" class="w-100 form-control" placeholder="Email address" required>
                                                    </div>
                                                    <div class="col-12 col-md-6 field-col mb-3">
                                                        <label for="phone" class="field-label">Phone</label>
                                                        <input type="text" id="phone" name="phone" class="w-100 form-control" placeholder="Phone number" required>
                                                    </div>
                                                    <div class="col-12 col-md-6 field-col mb-3">
                                                        <label for="country" class="field-label">Country</label>
                                                        <select id="country" name="country" class="w-100 form-control" required>
                                                            <option value="India">India</option>
                                                            <option value="USA">USA</option>
                                                            <option value="UK">UK</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-12 col-md-6 field-col mb-3">
                                                        <label for="state" class="field-label">State</label>
                                                        <input type="text" id="state" name="state" class="w-100 form-control" placeholder="State" required>
                                                    </div>
                                                    <div class="col-12 col-md-6 field-col mb-3">
                                                        <label for="city" class="field-label">City</label>
                                                        <input type="text" id="city" name="city" class="w-100 form-control" placeholder="City" required>
                                                    </div>
                                                    <div class="col-12 col-md-6 field-col mb-3">
                                                        <label for="address" class="field-label">Address</label>
                                                        <input type="text" id="address" name="address" class="w-100 form-control" placeholder="Address line1" required>
                                                    </div>
                                                    <div class="col-12 col-md-6 field-col mb-3">
                                                        <label for="pincode" class="field-label">Pincode</label>
                                                        <input type="text" id="pincode" name="pincode" class="w-100 form-control" placeholder="Pincode" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="checkout-payment mst-50">
                                            <h6 class="font-18 meb-25">Payment method</h6>
                                            <div class="payment-options-wrapper">
                                                <label class="payment-option-item">
                                                    <input type="radio" name="payment_method" value="cod" checked>
                                                    <div class="payment-option-content">
                                                        <div class="radio-indicator"></div>
                                                        <div class="payment-text">
                                                            <h6>Cash on Delivery (COD)</h6>
                                                            <p>Pay with cash upon delivery.</p>
                                                        </div>
                                                    </div>
                                                </label>

                                                <label class="payment-option-item">
                                                    <input type="radio" name="payment_method" value="razorpay">
                                                    <div class="payment-option-content">
                                                        <div class="radio-indicator"></div>
                                                        <div class="payment-text">
                                                            <h6>Razorpay (Cards / UPI / Netbanking)</h6>
                                                            <p>Pay securely online with Razorpay.</p>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="checkout-footer mst-40 border-top pt-4">
                                            <button type="submit" class="btn-style secondary-btn w-100 py-3" data-default-text="Place Order">Place Order</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
<!-- checkout end -->
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

