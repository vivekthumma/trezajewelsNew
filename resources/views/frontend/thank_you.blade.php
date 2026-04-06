@extends('layouts.app')

@section('title', 'Thank You - Treza Jewels')

@section('content')
<div class="breadcrumb-area ptb-15" data-bgimg="{{ asset('assets/images/other/breadcrumb-bgimg.jpg') }}">
    <div class="container">
        <span class="d-block extra-color"><a href="{{ url('/') }}" class="extra-color">Home</a> / Order Success</span>
    </div>
</div>

<section class="thank-you-area section-ptb text-center">
    <div class="container">
        <div class="thank-you-content py-5">
            <div class="success-icon mb-4">
                <i class="ri-checkbox-circle-line text-success" style="font-size: 80px;"></i>
            </div>
            <h1 class="mb-3">Thank You for Your Order!</h1>
            <p class="mb-4">Your order has been placed successfully. Your order number is <strong>#{{ $order->order_number }}</strong>.</p>
            <p class="mb-5">We've sent a confirmation email to <strong>{{ $order->email }}</strong> with all the details.</p>
            
            <div class="order-summary-box text-start max-width-600 mx-auto p-4 extra-bg br-hidden mb-5">
                <h6 class="font-18 meb-20 border-bottom pb-2">Order Summary</h6>
                <div class="ul-mt15">
                    @foreach($order->items as $item)
                    <div class="d-flex justify-content-between mb-2">
                        <span>{{ $item->product->name }} x {{ $item->quantity }}</span>
                        <span class="heading-weight">₹{{ number_format($item->total, 2) }}</span>
                    </div>
                    @endforeach
                    <div class="d-flex justify-content-between mt-3 border-top pt-2">
                        <span class="heading-weight">Total Amount</span>
                        <span class="heading-weight font-18">₹{{ number_format($order->total_amount, 2) }}</span>
                    </div>
                </div>
            </div>

            <div class="action-buttons">
                <a href="{{ url('/products') }}" class="btn-style secondary-btn px-5 py-3 me-3">Continue Shopping</a>
                <a href="{{ url('/') }}" class="btn-style primary-btn px-5 py-3">Back to Home</a>
            </div>
        </div>
    </div>
</section>
@endsection
