@extends('layouts.app')

@section('title', 'My Orders - Treza Jewels')

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/account.css') }}">
@endpush

@section('content')
<!-- breadcrumb-area start -->
<div class="breadcrumb-area ptb-15" data-bgimg="{{ asset('assets/images/other/breadcrumb-bgimg.jpg') }}">
    <div class="container">
        <span class="d-block extra-color"><a href="{{ url('/') }}" class="extra-color">Home</a> / My Orders</span>
    </div>
</div>
<!-- breadcrumb-area end -->

<!-- account-page start -->
<section class="account-page section-ptb">
    <div class="container">
        <div class="row row-mtm align-items-lg-start">
            <div class="col-12 col-lg-4 col-xl-3 p-lg-sticky top-0">
                @include('frontend.profile.sidebar')
            </div>
            <div class="col-12 col-lg-8 col-xl-9 p-lg-sticky top-0">
                <div class="ap-detail">
                    <div class="ap-title peb-30 beb">
                        <h6 class="font-18">My Orders</h6>
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
                            @foreach($orders as $order)
                                <div class="od-wrap ptb-30 beb">
                                    <div class="od-view ul-mtm30">
                                        <div class="od-id">
                                            <div class="row">
                                                <div class="col-6 col-lg-3">Order id</div>
                                                <div class="col-6 col-lg-3">
                                                    <span class="d-inline-block heading-color heading-weight">#{{ $order->order_number }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="od-info">
                                            <div class="row row-mtm20">
                                                <div class="col-12 col-lg-6">
                                                    <div class="row">
                                                        <div class="col-6">Date</div>
                                                        <div class="col-6">{{ $order->created_at->format('jS M, Y') }}</div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-6">
                                                    <div class="row">
                                                        <div class="col-6">Payment</div>
                                                        <div class="col-6 text-uppercase">{{ $order->payment_method }}</div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-6">
                                                    <div class="row">
                                                        <div class="col-6">Total</div>
                                                        <div class="col-6 heading-color heading-weight">${{ number_format($order->total_amount, 2) }}</div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-6">
                                                     <div class="row">
                                                        <div class="col-6">Status</div>
                                                        <div class="col-6">
                                                            @php
                                                                $statusClass = 'text-warning';
                                                                if($order->status == 'delivered') $statusClass = 'text-success';
                                                                if($order->status == 'cancelled') $statusClass = 'text-danger';
                                                            @endphp
                                                            <span class="{{ $statusClass }} text-uppercase">{{ $order->status }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="od-link">
                                            <div class="row align-items-center">
                                                <div class="col-6 col-md-3">
                                                    <a href="javascript:void(0)" class="d-inline-block body-dominant-color text-decoration-underline opacity-50">View Invoice</a>
                                                </div>
                                                <div class="col-6 col-md-3">
                                                    <a href="{{ route('order.track', $order->order_number) }}" class="btn-style secondary-btn py-2 px-3">TRACK ORDER</a>
                                                </div>
                                                <div class="col-12 col-md-6 text-md-end mt-3 mt-md-0">
                                                    <a href="{{ route('products') }}" class="d-inline-block body-dominant-color text-decoration-underline">Shop More</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Optional: Show items summary or track button --}}
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
