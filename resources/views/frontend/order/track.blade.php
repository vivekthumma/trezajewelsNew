@extends('layouts.app')

@section('title', 'Track Order - Treza Jewels')

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/account.css') }}">
<style>
    .track-record .track-li.active .track-icon {
        background-color: var(--dominant-color);
        color: #fff;
    }
    .track-record .track-li.active .track-text span {
        color: var(--dominant-color);
    }
</style>
@endpush

@section('content')
<!-- breadcrumb-area start -->
<div class="breadcrumb-area ptb-15" data-bgimg="{{ asset('assets/images/other/breadcrumb-bgimg.jpg') }}">
    <div class="container">
        <span class="d-block extra-color"><a href="{{ url('/') }}" class="extra-color">Home</a> / Track Order</span>
    </div>
</div>
<!-- breadcrumb-area end -->

<!-- main start -->
<section class="order-info section-ptb">
    <div class="container">
        <div class="row row-mtm align-items-lg-start">
            <div class="col-12 col-lg-7">
                <!-- order-info return start -->
                <div class="oi-return peb-30 meb-30 beb">
                    <a href="{{ route('profile.orders') }}" class="body-dominant-color text-decoration-underline">Return to all orders</a>
                </div>
                <!-- order-info return end -->
                
                <div class="row row-mtm">
                    <!-- order-info view start -->
                    <div class="oi-view">
                        <div class="oi-view-wrap ul-mtm30">
                            <div class="oi-id">
                                <h6 class="font-18">Order id: #{{ $order->order_number }}</h6>
                                <span class="d-inline-block mst-12">{{ $order->created_at->format('jS M, Y, g:i a') }}</span>
                            </div>
                            <div class="oi-status">
                                <ul class="oi-status-ul ul-mtm20">
                                    <li class="oi-status-li">
                                        <div class="row">
                                            <div class="col-6">Payment</div>
                                            <div class="col-6 text-uppercase">{{ $order->payment_method }}</div>
                                        </div>
                                    </li>
                                    <li class="oi-status-li">
                                        <div class="row">
                                            <div class="col-6">Status</div>
                                            <div class="col-6 text-uppercase">{{ $order->status }}</div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="oi-link">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="javascript:void(0)" class="d-inline-block body-dominant-color text-decoration-underline opacity-50">View invoice</a>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ route('products') }}" class="d-inline-block body-dominant-color text-decoration-underline">Buy again</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="oi-contact mt-4">
                    <div class="row">
                        <div class="col-12 col-md-6 mb-4">
                            <span class="d-inline-block heading-color heading-weight mb-2">Shipping Address</span>
                            <div class="address-details">
                                <p class="mb-0">{{ $order->first_name }} {{ $order->last_name }}</p>
                                <p class="mb-0">{{ $order->address }}</p>
                                <p class="mb-0">{{ $order->city }}, {{ $order->state }} {{ $order->pincode }}</p>
                                <p class="mb-0">{{ $order->country }}</p>
                                <p class="mb-0">Phone: {{ $order->phone }}</p>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mb-4">
                            <span class="d-inline-block heading-color heading-weight mb-2">Order Summary</span>
                            <div class="summary-details">
                                @foreach($order->items as $item)
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>{{ $item->product->name }} x {{ $item->quantity }}</span>
                                        <span class="heading-weight">₹{{ number_format($item->total, 2) }}</span>
                                    </div>
                                @endforeach
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <span class="heading-weight">Total Amount</span>
                                    <span class="heading-weight dominant-color font-18">₹{{ number_format($order->total_amount, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tracking Logic -->
            @php
                $statusOrder = ['placed', 'packed', 'shipping', 'out_for_delivery', 'delivered'];
                $currentStatusIndex = array_search($order->status, $statusOrder);
                if($currentStatusIndex === false) $currentStatusIndex = 0; // default to placed
            @endphp
            
            <div class="col-12 col-lg-5">
                <div class="track-record ptb-30 plr-15 plr-sm-30 extra-bg border-radius">
                    <h6 class="font-18 meb-30 peb-25 beb">Tracking Details</h6>
                    <ul class="track-ul pst-40">
                        <li class="track-li {{ $currentStatusIndex >= 0 ? 'active' : '' }}">
                            <div class="track-icon-text d-flex flex-wrap align-items-center">
                                <span class="track-icon width-64 height-64 d-flex align-items-center justify-content-center rounded-circle"><i class="ri-shopping-bag-line d-block icon-24 lh-1"></i></span>
                                <div class="track-text psl-15">
                                    <span class="heading-color heading-weight">Order placed</span>
                                    @if($currentStatusIndex >= 0)
                                        <span>{{ $order->created_at->format('jS M Y') }}</span>
                                    @endif
                                </div>
                            </div>
                            @if($currentStatusIndex >= 0)
                            <div class="track-info ul-mtm-15 pst-30 psl-79">
                                <span class="heading-color heading-weight">An order has been placed</span>
                                <span>{{ $order->created_at->format('jS M Y, g:i a') }}</span>
                            </div>
                            @endif
                        </li>
                        <li class="track-li {{ $currentStatusIndex >= 1 ? 'active' : '' }}">
                            <div class="track-icon-text d-flex flex-wrap align-items-center">
                                <span class="track-icon width-64 height-64 d-flex align-items-center justify-content-center rounded-circle"><i class="ri-gift-line d-block icon-24 lh-1"></i></span>
                                <div class="track-text psl-15">
                                    <span class="heading-color heading-weight">Packed</span>
                                </div>
                            </div>
                        </li>
                        <li class="track-li {{ $currentStatusIndex >= 2 ? 'active' : '' }}">
                            <div class="track-icon-text d-flex flex-wrap align-items-center">
                                <span class="track-icon width-64 height-64 d-flex align-items-center justify-content-center rounded-circle"><i class="ri-truck-line d-block icon-24 lh-1"></i></span>
                                <div class="track-text psl-15">
                                    <span class="heading-color heading-weight">Shipping</span>
                                </div>
                            </div>
                        </li>
                        <li class="track-li {{ $currentStatusIndex >= 3 ? 'active' : '' }}">
                            <div class="track-icon-text d-flex flex-wrap align-items-center">
                                <span class="track-icon width-64 height-64 d-flex align-items-center justify-content-center rounded-circle"><i class="ri-e-bike-line d-block icon-24 lh-1"></i></span>
                                <div class="track-text psl-15">
                                    <span class="heading-color heading-weight">Out for delivery</span>
                                </div>
                            </div>
                        </li>
                        <li class="track-li {{ $currentStatusIndex >= 4 ? 'active' : '' }}">
                            <div class="track-icon-text d-flex flex-wrap align-items-center">
                                <span class="track-icon width-64 height-64 d-flex align-items-center justify-content-center rounded-circle"><i class="ri-draft-line d-block icon-24 lh-1"></i></span>
                                <div class="track-text psl-15">
                                    <span class="heading-color heading-weight">Delivered</span>
                                    @if($currentStatusIndex >= 4)
                                        <span>{{ $order->updated_at->format('jS M Y') }}</span>
                                    @endif
                                </div>
                            </div>
                        </li>
                    </ul>

                    <div class="oi-btn mst-30">
                        <div class="row">
                            <div class="col-12">
                                <button type="button" class="w-100 btn-style primary-btn {{ $order->status == 'delivered' ? '' : 'opacity-50' }}" {{ $order->status == 'delivered' ? '' : 'disabled' }}>WRITE A REVIEW</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
