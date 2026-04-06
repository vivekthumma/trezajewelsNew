@extends('layouts.app')

@section('title', 'Shopping Cart - Treza Jewels')

@push('css')
<style>
    .cart-shell {
        max-width: 1320px;
        margin: 0 auto;
    }

    .cart-panel,
    .cart-summary-panel,
    .cart-line-card,
    .cart-empty-panel {
        background: #fff;
        border: 1px solid rgba(176, 139, 102, 0.14);
        border-radius: 28px;
        box-shadow: 0 24px 60px rgba(143, 111, 76, 0.08);
    }

    .cart-panel,
    .cart-summary-panel {
        padding: 28px;
    }

    .cart-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 22px;
    }

    .cart-header h2 {
        margin: 0;
        font-size: 30px;
        font-family: "Marcellus", serif;
        color: #2d2a26;
    }

    .cart-header p {
        margin: 6px 0 0;
        color: #8b8073;
        font-size: 14px;
    }

    .cart-badge {
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

    .cart-lines {
        display: grid;
        gap: 18px;
    }

    .cart-line-card {
        padding: 18px;
    }

    .cart-line-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.8fr) minmax(150px, .7fr) minmax(130px, .6fr) minmax(54px, .2fr);
        gap: 16px;
        align-items: center;
    }

    .cart-line-product {
        display: grid;
        grid-template-columns: 92px minmax(0, 1fr);
        gap: 16px;
        align-items: center;
    }

    .cart-line-thumb {
        border-radius: 18px;
        overflow: hidden;
        background: #fcfaf7;
        aspect-ratio: 1 / 1.08;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .cart-line-thumb img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .cart-line-title {
        color: #2d2a26;
        font-size: 22px;
        font-family: "Marcellus", serif;
        line-height: 1.12;
        text-decoration: none;
    }

    .cart-line-title:hover {
        color: #b08b66;
    }

    .cart-line-meta {
        margin-top: 8px;
        color: #8b8073;
        font-size: 13px;
    }

    .cart-line-price {
        margin-top: 10px;
        color: #b08b66;
        font-size: 22px;
        font-weight: 700;
    }

    .cart-label-mobile {
        display: none;
        margin-bottom: 6px;
        color: #8b8073;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .08em;
    }

    .cart-value-strong {
        color: #2f2a26;
        font-weight: 700;
        font-size: 20px;
    }

    .cart-page-qty .js-qty-wrap {
        display: inline-flex !important;
        align-items: center;
        background: #fcfaf7 !important;
        border: 1px solid #eadfce !important;
        border-radius: 999px !important;
        overflow: hidden;
        min-height: 46px;
    }

    .cart-page-qty .js-qty-wrap button {
        width: 42px;
        color: #8f6f4c;
    }

    .cart-page-qty .qty-num {
        width: 42px !important;
        color: #2f2a26;
        font-weight: 700;
        background: transparent;
    }

    .cart-remove-btn {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #fff4f3;
        color: #e25c55;
        border: 1px solid #f6d7d5;
    }

    .cart-remove-btn:hover {
        background: #ffe6e4;
    }

    .cart-actions-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        flex-wrap: wrap;
        margin-top: 22px;
    }

    .cart-actions-row .btn-style {
        min-height: 54px;
        border-radius: 16px;
        font-weight: 700;
        padding: 12px 28px;
    }

    .cart-summary-panel {
        position: sticky;
        top: 24px;
    }

    .cart-summary-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 20px;
    }

    .cart-summary-head h3 {
        margin: 0;
        font-size: 28px;
        font-family: "Marcellus", serif;
        color: #2d2a26;
    }

    .cart-summary-note {
        color: #8b8073;
        font-size: 14px;
        margin-bottom: 20px;
    }

    .cart-summary-box {
        padding: 18px;
        border: 1px solid #eee4d8;
        border-radius: 22px;
        background: linear-gradient(180deg, #fffdf9 0%, #f8f1e8 100%);
    }

    .cart-summary-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 10px 0;
        color: #6e665d;
    }

    .cart-summary-row span:last-child {
        color: #2d2a26;
        font-weight: 600;
    }

    .cart-summary-row.discount span:last-child {
        color: #f04452;
    }

    .cart-summary-row.shipping span:last-child {
        color: #15915a;
    }

    .cart-summary-total {
        margin-top: 12px;
        padding-top: 16px;
        border-top: 1px solid #e9dece;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
    }

    .cart-summary-total strong:first-child {
        font-size: 20px;
        color: #2d2a26;
    }

    .cart-summary-total strong:last-child {
        font-size: 30px;
        color: #b08b66;
    }

    .cart-summary-panel .btn-style {
        min-height: 56px;
        border-radius: 16px;
        font-weight: 700;
    }

    .cart-empty-panel {
        padding: 40px 24px;
    }

    @media (max-width: 991px) {
        .cart-summary-panel {
            position: static;
        }
    }

    @media (max-width: 767px) {
        .cart-panel,
        .cart-summary-panel,
        .cart-line-card,
        .cart-empty-panel {
            padding: 18px;
            border-radius: 20px;
        }

        .cart-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .cart-header h2,
        .cart-summary-head h3,
        .cart-line-title {
            font-size: 24px;
        }

        .cart-line-grid {
            grid-template-columns: 1fr;
        }

        .cart-line-product {
            grid-template-columns: 74px minmax(0, 1fr);
            gap: 12px;
        }

        .cart-label-mobile {
            display: block;
        }

        .cart-actions-row {
            flex-direction: column;
            align-items: stretch;
        }

        .cart-summary-total strong:last-child,
        .cart-value-strong,
        .cart-line-price {
            font-size: 22px;
        }
    }
</style>
@endpush

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
    <div class="container cart-shell">
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
