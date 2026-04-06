@extends('layouts.app')

@section('title', 'Track Order - Treza Jewels')

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/account.css') }}">
<style>
    .track-shell {
        max-width: 1320px;
        margin: 0 auto;
    }

    .track-main-card,
    .track-side-card,
    .track-info-card {
        background: #fff;
        border: 1px solid rgba(176, 139, 102, 0.14);
        border-radius: 28px;
        box-shadow: 0 24px 60px rgba(143, 111, 76, 0.08);
    }

    .track-main-card,
    .track-side-card {
        padding: 28px;
    }

    .track-back-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 22px;
        color: #8f6f4c;
        text-decoration: underline;
        text-underline-offset: 3px;
    }

    .track-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 18px;
        padding-bottom: 24px;
        margin-bottom: 24px;
        border-bottom: 1px solid #eee4d8;
    }

    .track-header-title {
        margin: 0;
        font-size: 32px;
        font-family: "Marcellus", serif;
        color: #2d2a26;
    }

    .track-header-meta {
        margin-top: 8px;
        color: #8b8073;
        font-size: 15px;
    }

    .track-status-pill {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 11px 16px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: .08em;
        text-transform: uppercase;
        background: #fff3da;
        color: #d79a07;
    }

    .track-status-pill.status-delivered {
        background: #e8f7ef;
        color: #15915a;
    }

    .track-status-pill.status-cancelled {
        background: #fdeceb;
        color: #d14c45;
    }

    .track-stats-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 16px;
        margin-bottom: 24px;
    }

    .track-stat-box,
    .track-info-card {
        padding: 18px;
        background: #fcfaf7;
        border: 1px solid #eee4d8;
    }

    .track-stat-label,
    .track-info-label {
        color: #8b8073;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .08em;
        margin-bottom: 8px;
    }

    .track-stat-value {
        color: #2f2a26;
        font-size: 20px;
        font-weight: 600;
    }

    .track-info-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
        margin-bottom: 24px;
    }

    .track-info-card h3 {
        margin: 0 0 14px;
        font-size: 24px;
        font-family: "Marcellus", serif;
        color: #2d2a26;
    }

    .track-address-lines p {
        margin: 0 0 6px;
        color: #5f584f;
        line-height: 1.7;
    }

    .track-summary-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 12px 0;
        border-bottom: 1px solid #efe5d8;
    }

    .track-summary-row:last-child {
        border-bottom: 0;
    }

    .track-summary-name {
        color: #2f2a26;
        font-weight: 600;
        line-height: 1.5;
    }

    .track-summary-meta {
        color: #8b8073;
        font-size: 13px;
        margin-top: 3px;
    }

    .track-summary-price {
        color: #8f6f4c;
        font-weight: 700;
        white-space: nowrap;
    }

    .track-summary-total {
        margin-top: 14px;
        padding-top: 16px;
        border-top: 1px solid #e7dccd;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        font-size: 18px;
        font-weight: 700;
        color: #2d2a26;
    }

    .track-summary-total strong {
        color: #b08b66;
        font-size: 24px;
    }

    .track-actions {
        display: flex;
        align-items: center;
        gap: 14px;
        flex-wrap: wrap;
    }

    .track-actions .btn-style {
        min-height: 54px;
        border-radius: 16px;
        padding: 12px 26px;
        font-weight: 700;
    }

    .track-actions .track-link {
        text-decoration: underline;
        text-underline-offset: 3px;
    }

    .track-side-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding-bottom: 20px;
        margin-bottom: 20px;
        border-bottom: 1px solid #eee4d8;
    }

    .track-side-head h2 {
        margin: 0;
        font-size: 28px;
        font-family: "Marcellus", serif;
        color: #2d2a26;
    }

    .track-side-note {
        color: #8b8073;
        font-size: 14px;
    }

    .track-record {
        position: relative;
    }

    .track-step {
        position: relative;
        display: grid;
        grid-template-columns: 64px minmax(0, 1fr);
        gap: 16px;
        padding-bottom: 28px;
    }

    .track-step:last-child {
        padding-bottom: 0;
    }

    .track-step::after {
        content: "";
        position: absolute;
        top: 64px;
        left: 31px;
        width: 2px;
        height: calc(100% - 40px);
        background: #eadfce;
    }

    .track-step:last-child::after {
        display: none;
    }

    .track-step-icon {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #fff;
        border: 1px solid #e8dece;
        color: #8f6f4c;
        font-size: 24px;
        box-shadow: 0 10px 24px rgba(176, 139, 102, 0.08);
    }

    .track-step.active .track-step-icon {
        background: #b08b66;
        color: #fff;
        border-color: #b08b66;
    }

    .track-step.done::after,
    .track-step.active::after {
        background: #b08b66;
    }

    .track-step-title {
        font-size: 24px;
        font-family: "Marcellus", serif;
        color: #2d2a26;
        margin: 0 0 6px;
    }

    .track-step-date {
        color: #8b8073;
        font-size: 14px;
        margin-bottom: 12px;
    }

    .track-step-note {
        color: #544d45;
        line-height: 1.7;
    }

    .track-review-btn {
        margin-top: 28px;
    }

    .track-review-btn .btn-style {
        min-height: 54px;
        border-radius: 16px;
        font-weight: 700;
    }

    @media (max-width: 991px) {
        .track-main-card {
            margin-bottom: 22px;
        }
    }

    @media (max-width: 767px) {
        .track-main-card,
        .track-side-card {
            padding: 18px;
            border-radius: 20px;
        }

        .track-header,
        .track-side-head {
            flex-direction: column;
            align-items: flex-start;
        }

        .track-header-title,
        .track-side-head h2,
        .track-step-title {
            font-size: 24px;
        }

        .track-stats-grid,
        .track-info-grid {
            grid-template-columns: 1fr;
        }

        .track-step {
            grid-template-columns: 54px minmax(0, 1fr);
        }

        .track-step-icon {
            width: 54px;
            height: 54px;
            font-size: 21px;
        }

        .track-step::after {
            left: 26px;
            top: 54px;
        }

        .track-summary-row,
        .track-summary-total {
            align-items: flex-start;
            flex-direction: column;
        }
    }
</style>
@endpush

@section('content')
<div class="breadcrumb-area ptb-15" data-bgimg="{{ asset('assets/images/other/breadcrumb-bgimg.jpg') }}">
    <div class="container">
        <span class="d-block extra-color"><a href="{{ url('/') }}" class="extra-color">Home</a> / Track Order</span>
    </div>
</div>

@php
    $statusOrder = ['placed', 'packed', 'shipping', 'out_for_delivery', 'delivered'];
    $currentStatusIndex = array_search($order->status, $statusOrder);
    if ($currentStatusIndex === false) {
        $currentStatusIndex = 0;
    }

    $statusClass = 'track-status-pill';
    if ($order->status === 'delivered') $statusClass .= ' status-delivered';
    if ($order->status === 'cancelled') $statusClass .= ' status-cancelled';

    $steps = [
        [
            'label' => 'Order Placed',
            'icon' => 'ri-shopping-bag-line',
            'note' => 'Your order has been placed successfully and is now being prepared.',
            'date' => $order->created_at->format('jS M Y, g:i a'),
        ],
        [
            'label' => 'Packed',
            'icon' => 'ri-gift-line',
            'note' => 'Your items are packed and ready to move to the next shipping stage.',
            'date' => null,
        ],
        [
            'label' => 'Shipping',
            'icon' => 'ri-truck-line',
            'note' => 'Your parcel has left the warehouse and is on the way.',
            'date' => null,
        ],
        [
            'label' => 'Out For Delivery',
            'icon' => 'ri-e-bike-line',
            'note' => 'Your package is out for delivery and should reach you soon.',
            'date' => null,
        ],
        [
            'label' => 'Delivered',
            'icon' => 'ri-draft-line',
            'note' => 'The order has been delivered successfully.',
            'date' => $order->status === 'delivered' ? $order->updated_at->format('jS M Y, g:i a') : null,
        ],
    ];
@endphp

<section class="order-info section-ptb">
    <div class="container track-shell">
        <div class="row g-4 align-items-start">
            <div class="col-12 col-lg-7">
                <div class="track-main-card">
                    <a href="{{ route('profile.orders') }}" class="track-back-link">
                        <i class="ri-arrow-left-line"></i>
                        <span>Return to all orders</span>
                    </a>

                    <div class="track-header">
                        <div>
                            <h1 class="track-header-title">#{{ $order->order_number }}</h1>
                            <div class="track-header-meta">{{ $order->created_at->format('jS M, Y, g:i a') }}</div>
                        </div>
                        <span class="{{ $statusClass }}">{{ ucfirst(str_replace('_', ' ', $order->status)) }}</span>
                    </div>

                    <div class="track-stats-grid">
                        <div class="track-stat-box">
                            <div class="track-stat-label">Payment</div>
                            <div class="track-stat-value text-uppercase">{{ $order->payment_method }}</div>
                        </div>
                        <div class="track-stat-box">
                            <div class="track-stat-label">Status</div>
                            <div class="track-stat-value">{{ ucfirst(str_replace('_', ' ', $order->status)) }}</div>
                        </div>
                        <div class="track-stat-box">
                            <div class="track-stat-label">Total</div>
                            <div class="track-stat-value">₹{{ number_format($order->total_amount, 2) }}</div>
                        </div>
                    </div>

                    <div class="track-info-grid">
                        <div class="track-info-card">
                            <div class="track-info-label">Shipping Address</div>
                            <h3>Delivery Details</h3>
                            <div class="track-address-lines">
                                <p>{{ $order->first_name }} {{ $order->last_name }}</p>
                                <p>{{ $order->address }}</p>
                                <p>{{ $order->city }}, {{ $order->state }} {{ $order->pincode }}</p>
                                <p>{{ $order->country }}</p>
                                <p>Phone: {{ $order->phone }}</p>
                            </div>
                        </div>

                        <div class="track-info-card">
                            <div class="track-info-label">Order Summary</div>
                            <h3>Items Ordered</h3>
                            @foreach($order->items as $item)
                                <div class="track-summary-row">
                                    <div>
                                        <div class="track-summary-name">{{ $item->product->name ?? 'Product' }}</div>
                                        <div class="track-summary-meta">Qty: {{ $item->quantity }}</div>
                                    </div>
                                    <div class="track-summary-price">₹{{ number_format($item->total, 2) }}</div>
                                </div>
                            @endforeach

                            <div class="track-summary-total">
                                <span>Total Amount</span>
                                <strong>₹{{ number_format($order->total_amount, 2) }}</strong>
                            </div>
                        </div>
                    </div>

                    <div class="track-actions">
                        <a href="{{ route('products') }}" class="btn-style secondary-btn">Buy Again</a>
                        <a href="{{ route('profile.orders') }}" class="track-link body-dominant-color">Back to Orders</a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-5">
                <div class="track-side-card">
                    <div class="track-side-head">
                        <div>
                            <h2>Tracking Details</h2>
                            <div class="track-side-note">Follow each stage of your order journey.</div>
                        </div>
                    </div>

                    <div class="track-record">
                        @foreach($steps as $index => $step)
                            @php
                                $stepClass = '';
                                if ($currentStatusIndex > $index) $stepClass = 'done';
                                if ($currentStatusIndex === $index) $stepClass = 'active';
                            @endphp
                            <div class="track-step {{ $stepClass }}">
                                <span class="track-step-icon">
                                    <i class="{{ $step['icon'] }}"></i>
                                </span>
                                <div>
                                    <h3 class="track-step-title">{{ $step['label'] }}</h3>
                                    @if($step['date'])
                                        <div class="track-step-date">{{ $step['date'] }}</div>
                                    @endif
                                    @if($currentStatusIndex >= $index)
                                        <div class="track-step-note">{{ $step['note'] }}</div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="track-review-btn">
                        <button type="button" class="w-100 btn-style primary-btn {{ $order->status === 'delivered' ? '' : 'opacity-50' }}" {{ $order->status === 'delivered' ? '' : 'disabled' }}>
                            Write A Review
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
