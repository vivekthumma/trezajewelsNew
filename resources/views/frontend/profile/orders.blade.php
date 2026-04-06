@extends('layouts.app')

@section('title', 'My Orders - Treza Jewels')

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/account.css') }}">
<style>
    .profile-orders-shell {
        max-width: 1320px;
        margin: 0 auto;
    }

    .profile-sidebar-wrap,
    .orders-panel,
    .order-card {
        background: #fff;
        border: 1px solid rgba(176, 139, 102, 0.14);
        border-radius: 26px;
        box-shadow: 0 24px 60px rgba(143, 111, 76, 0.08);
    }

    .profile-sidebar-wrap {
        padding: 22px;
    }

    .profile-sidebar-wrap .ap-author {
        background: linear-gradient(180deg, #fffdf9 0%, #f7f0e7 100%);
        border: 1px solid #efe4d7;
        border-radius: 22px;
        padding: 32px 20px;
        margin-bottom: 16px;
    }

    .profile-sidebar-wrap .ap-author img {
        width: 86px;
        height: 86px;
        object-fit: cover;
        border: 4px solid #fff;
        box-shadow: 0 16px 30px rgba(176, 139, 102, 0.18);
    }

    .profile-sidebar-wrap .ap-profile {
        display: grid;
        gap: 10px;
    }

    .profile-sidebar-wrap .ap-profile > a,
    .profile-sidebar-wrap .ap-profile > form > button {
        border-radius: 16px;
        border: 1px solid transparent;
        background: #fcfaf7;
        min-height: 56px;
        transition: all .25s ease;
    }

    .profile-sidebar-wrap .ap-profile > a:hover,
    .profile-sidebar-wrap .ap-profile > form > button:hover {
        border-color: #e8d8c6;
        background: #fff;
        transform: translateY(-1px);
    }

    .profile-sidebar-wrap .ap-profile > a.dominant-color {
        background: #f7f0e7;
        border-color: #ead8c3;
        color: #b08b66 !important;
        font-weight: 600;
    }

    .orders-panel {
        padding: 28px;
    }

    .orders-panel-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 24px;
    }

    .orders-panel-head h6 {
        margin: 0;
        font-size: 28px;
        font-family: "Marcellus", serif;
        color: #2d2a26;
    }

    .orders-panel-subtitle {
        color: #8b8073;
        font-size: 14px;
    }

    .orders-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 8px 14px;
        border-radius: 999px;
        background: #f7f0e7;
        color: #b08b66;
        font-weight: 600;
        font-size: 13px;
        letter-spacing: .08em;
        text-transform: uppercase;
    }

    .orders-grid {
        display: grid;
        gap: 20px;
    }

    .order-card {
        padding: 22px 24px;
    }

    .order-card-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 18px;
        margin-bottom: 18px;
    }

    .order-card-id {
        margin: 0;
        font-size: 22px;
        font-family: "Marcellus", serif;
        color: #2d2a26;
    }

    .order-card-date {
        margin-top: 6px;
        color: #8b8073;
        font-size: 14px;
    }

    .order-status-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 10px 14px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: .08em;
        text-transform: uppercase;
        background: #fff3da;
        color: #d79a07;
    }

    .order-status-badge.status-delivered {
        background: #e8f7ef;
        color: #15915a;
    }

    .order-status-badge.status-cancelled {
        background: #fdeceb;
        color: #d14c45;
    }

    .order-card-meta {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px;
        margin-bottom: 20px;
    }

    .order-meta-box {
        background: #fcfaf7;
        border: 1px solid #eee4d8;
        border-radius: 18px;
        padding: 14px 16px;
    }

    .order-meta-label {
        color: #8b8073;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .08em;
        margin-bottom: 6px;
    }

    .order-meta-value {
        color: #2f2a26;
        font-size: 17px;
        font-weight: 600;
    }

    .order-card-actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        flex-wrap: wrap;
        padding-top: 18px;
        border-top: 1px solid #efe5d8;
    }

    .order-card-links {
        display: flex;
        align-items: center;
        gap: 18px;
        flex-wrap: wrap;
    }

    .order-card-actions .btn-style {
        min-height: 52px;
        border-radius: 16px;
        font-weight: 700;
        letter-spacing: .02em;
        padding: 12px 26px;
    }

    .order-link-muted,
    .order-link-plain {
        text-decoration: underline;
        text-underline-offset: 3px;
    }

    @media (max-width: 991px) {
        .profile-sidebar-wrap {
            margin-bottom: 22px;
        }
    }

    @media (max-width: 767px) {
        .orders-panel,
        .order-card,
        .profile-sidebar-wrap {
            padding: 18px;
            border-radius: 20px;
        }

        .profile-sidebar-wrap .ap-author {
            padding: 24px 16px;
        }

        .orders-panel-head {
            flex-direction: column;
            align-items: flex-start;
        }

        .orders-panel-head h6 {
            font-size: 24px;
        }

        .order-card-top {
            flex-direction: column;
        }

        .order-card-meta {
            grid-template-columns: 1fr;
        }

        .order-card-actions {
            align-items: flex-start;
        }

        .order-card-links {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }
    }
</style>
@endpush

@section('content')
<div class="breadcrumb-area ptb-15" data-bgimg="{{ asset('assets/images/other/breadcrumb-bgimg.jpg') }}">
    <div class="container">
        <span class="d-block extra-color"><a href="{{ url('/') }}" class="extra-color">Home</a> / My Orders</span>
    </div>
</div>

<section class="account-page section-ptb">
    <div class="container profile-orders-shell">
        <div class="row row-mtm align-items-lg-start">
            <div class="col-12 col-lg-4 col-xl-3 p-lg-sticky top-0">
                <div class="profile-sidebar-wrap">
                    @include('frontend.profile.sidebar')
                </div>
            </div>
            <div class="col-12 col-lg-8 col-xl-9 p-lg-sticky top-0">
                <div class="orders-panel">
                    <div class="orders-panel-head">
                        <div>
                            <h6>My Orders</h6>
                            <div class="orders-panel-subtitle">Track your recent purchases and continue shopping anytime.</div>
                        </div>
                        <span class="orders-badge">{{ $orders->count() }} Order{{ $orders->count() > 1 ? 's' : '' }}</span>
                    </div>

                    <div class="ap-detail-info">
                        @if($orders->isEmpty())
                            <div class="text-center ptb-50">
                                <span class="d-block icon-64 body-color mb-3"><i class="ri-shopping-bag-line"></i></span>
                                <h6>No orders found yet.</h6>
                                <p class="mb-4">You haven't placed any orders with this account.</p>
                                <a href="{{ route('products') }}" class="btn-style secondary-btn">Start Shopping</a>
                            </div>
                        @else
                            <div class="orders-grid">
                                @foreach($orders as $order)
                                    @php
                                        $statusClass = 'order-status-badge';
                                        if($order->status === 'delivered') $statusClass .= ' status-delivered';
                                        if($order->status === 'cancelled') $statusClass .= ' status-cancelled';
                                    @endphp
                                    <div class="order-card">
                                        <div class="order-card-top">
                                            <div>
                                                <h3 class="order-card-id">#{{ $order->order_number }}</h3>
                                                <div class="order-card-date">{{ $order->created_at->format('jS M, Y') }}</div>
                                            </div>
                                            <span class="{{ $statusClass }}">{{ ucfirst($order->status) }}</span>
                                        </div>

                                        <div class="order-card-meta">
                                            <div class="order-meta-box">
                                                <div class="order-meta-label">Payment</div>
                                                <div class="order-meta-value text-uppercase">{{ $order->payment_method }}</div>
                                            </div>
                                            <div class="order-meta-box">
                                                <div class="order-meta-label">Total</div>
                                                <div class="order-meta-value">₹{{ number_format($order->total_amount, 2) }}</div>
                                            </div>
                                            <div class="order-meta-box">
                                                <div class="order-meta-label">Status</div>
                                                <div class="order-meta-value">{{ ucfirst($order->status) }}</div>
                                            </div>
                                        </div>

                                        <div class="order-card-actions">
                                            <div class="order-card-links">
                                                <a href="{{ route('products') }}" class="order-link-plain body-dominant-color">Shop More</a>
                                            </div>
                                            <a href="{{ route('order.track', $order->order_number) }}" class="btn-style secondary-btn">Track Order</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
