@extends('layouts.app')

@section('title', 'Shopping Cart - Treza Jewels')

@section('content')
<!-- breadcrumb-area start -->
<div class="breadcrumb-area ptb-15" data-bgimg="{{ asset('assets/images/other/breadcrumb-bgimg.jpg') }}">
    <div class="container">
        <span class="d-block extra-color"><a href="{{ url('/') }}" class="extra-color">Home</a> / Cart</span>
    </div>
</div>
<!-- breadcrumb-area end -->

<!-- cart start -->
<section class="cart-area section-pt section-pb">
    <div class="container">
        <div class="row row-mtm" id="main-cart-container">
            @if(isset($cartItems))
                @include('frontend.partials.cart_page_items')
            @else
                <div class="text-center pt-5 pb-5 w-100">
                    <i class="ri-loader-4-line ri-spin ri-3x text-primary"></i>
                    <h4 class="mt-3">Loading your cart...</h4>
                </div>
            @endif
        </div>
    </div>
</section>
<!-- cart end -->
@endsection
