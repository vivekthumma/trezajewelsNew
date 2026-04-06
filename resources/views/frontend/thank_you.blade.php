@extends('layouts.app')

@section('title', 'Thank You - Treza Jewels')

@push('css')
<style>
    .thank-you-content {
        max-width: 980px;
        margin: 0 auto;
    }

    .order-summary-card {
        background: #fff;
        border: 1px solid rgba(176, 139, 102, 0.16);
        border-radius: 24px;
        padding: 28px;
        box-shadow: 0 22px 60px rgba(143, 111, 76, 0.08);
    }

    .order-summary-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding-bottom: 18px;
        margin-bottom: 18px;
        border-bottom: 1px solid #ece4d9;
    }

    .order-summary-title {
        margin: 0;
        font-size: 28px;
        font-family: "Marcellus", serif;
        color: #2d2a26;
    }

    .order-summary-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 8px 14px;
        border-radius: 999px;
        background: #f7f1e8;
        color: #b08b66;
        font-weight: 600;
        font-size: 13px;
        letter-spacing: .08em;
        text-transform: uppercase;
    }

    .order-summary-row {
        display: grid;
        grid-template-columns: minmax(0, 2.2fr) minmax(90px, .7fr) minmax(120px, .8fr) minmax(130px, .8fr);
        gap: 16px;
        align-items: center;
        padding: 16px 0;
        border-bottom: 1px solid #f1ebe3;
    }

    .order-summary-row.is-head {
        padding-top: 0;
        color: #8c8378;
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .08em;
    }

    .order-summary-row.is-total {
        border-bottom: 0;
        padding-bottom: 0;
        margin-top: 8px;
    }

    .order-product-name {
        font-weight: 600;
        color: #2d2a26;
        line-height: 1.5;
    }

    .order-product-meta {
        margin-top: 4px;
        color: #8c8378;
        font-size: 13px;
    }

    .order-summary-value {
        font-weight: 600;
        color: #3f3a35;
    }

    .order-summary-total-label {
        font-size: 18px;
        font-weight: 700;
        color: #2d2a26;
    }

    .order-summary-total-value {
        font-size: 24px;
        font-weight: 700;
        color: #b08b66;
    }

    .thank-you-actions {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 16px;
        flex-wrap: wrap;
    }

    .order-summary-mobile-label {
        display: none;
    }

    @media (max-width: 767px) {
        .order-summary-card {
            padding: 20px;
            border-radius: 18px;
        }

        .order-summary-head {
            flex-direction: column;
            align-items: flex-start;
        }

        .order-summary-title {
            font-size: 24px;
        }

        .order-summary-row {
            grid-template-columns: 1fr 1fr;
            gap: 10px 16px;
        }

        .order-summary-row.is-head {
            display: none;
        }

        .order-summary-col-full {
            grid-column: 1 / -1;
        }

        .order-summary-mobile-label {
            display: block;
            margin-bottom: 4px;
            color: #8c8378;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .08em;
        }

        .order-summary-total-value {
            font-size: 21px;
        }
    }
</style>
@endpush

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

            <div class="order-summary-card text-start mb-5">
                <div class="order-summary-head">
                    <h2 class="order-summary-title">Order Summary</h2>
                    <span class="order-summary-badge">{{ $order->items->count() }} Item{{ $order->items->count() > 1 ? 's' : '' }}</span>
                </div>

                <div class="order-summary-row is-head">
                    <div>Product</div>
                    <div>Qty</div>
                    <div>Price</div>
                    <div class="text-end">Amount</div>
                </div>

                @foreach($order->items as $item)
                    <div class="order-summary-row">
                        <div class="order-summary-col-full">
                            <div class="order-product-name">{{ $item->product->name ?? 'Product' }}</div>
                            <div class="order-product-meta">Order #{{ $order->order_number }}</div>
                        </div>
                        <div>
                            <span class="order-summary-mobile-label">Qty</span>
                            <span class="order-summary-value">{{ $item->quantity }}</span>
                        </div>
                        <div>
                            <span class="order-summary-mobile-label">Price</span>
                            <span class="order-summary-value">₹{{ number_format($item->price, 2) }}</span>
                        </div>
                        <div class="text-md-end">
                            <span class="order-summary-mobile-label">Amount</span>
                            <span class="order-summary-value">₹{{ number_format($item->total, 2) }}</span>
                        </div>
                    </div>
                @endforeach

                <div class="order-summary-row is-total">
                    <div class="order-summary-total-label order-summary-col-full">Total Amount</div>
                    <div></div>
                    <div></div>
                    <div class="text-md-end">
                        <span class="order-summary-total-value">₹{{ number_format($order->total_amount, 2) }}</span>
                    </div>
                </div>
            </div>

            <div class="thank-you-actions">
                <a href="{{ url('/products') }}" class="btn-style secondary-btn px-5 py-3">Continue Shopping</a>
                <a href="{{ url('/') }}" class="btn-style primary-btn px-5 py-3">Back to Home</a>
            </div>
        </div>
    </div>
</section>
@endsection
