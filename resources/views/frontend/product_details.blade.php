@extends('layouts.app')

@section('title', $product->name . ' - Treza Jewels')

@push('css')
<style>
.pd-shell{background:radial-gradient(circle at top left,rgba(208,178,117,.14),transparent 28rem),linear-gradient(180deg,#fbf7f1 0%,#f7f1e8 100%);padding-top:24px}
.pd-shell .breadcrumb-area{background:transparent!important;border-bottom:1px solid rgba(73,54,25,.08)}
.pd-stage{padding:4.5rem 0 2rem}
.pd-stage .container,.pd-shell .section-pb .container{max-width:1320px}
.pd-stage .row.g-4.align-items-start{margin-top:30px}
.pd-card,.pd-tabs,.pd-related{background:rgba(255,255,255,.82);border:1px solid rgba(73,54,25,.08);border-radius:28px;box-shadow:0 24px 60px rgba(67,45,18,.08);backdrop-filter:blur(12px)}
.pd-card{padding:1.25rem}.pd-info{padding:2rem}
.pd-badges,.pd-services{display:flex;flex-wrap:wrap;gap:1rem}
.pd-cta{display:flex;flex-wrap:nowrap;align-items:end;gap:1rem}
.pd-badge{display:inline-flex;align-items:center;gap:.45rem;padding:.55rem .95rem;border-radius:999px;background:#fffaf2;border:1px solid rgba(177,137,73,.22);color:#8f6a2e;font-size:.8rem;font-weight:600;letter-spacing:.08em;text-transform:uppercase}
.pd-title{font-family:"Playfair Display",serif;font-size:clamp(2rem,3vw,3.4rem);line-height:1.04;color:#2f2619;margin:.9rem 0}
.pd-price{display:flex;align-items:end;gap:.8rem;margin:1.25rem 0}.pd-price strong{font-size:clamp(1.8rem,2.6vw,2.7rem);line-height:1;color:#a67c39}.pd-price span{color:#8f8578;font-size:.92rem}
.pd-copy{color:#6c6257;line-height:1.9}
.pd-meta{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:.9rem;margin:1.5rem 0}
.pd-meta-item,.pd-side-card,.pd-service,.pd-related-item{border-radius:22px;background:linear-gradient(180deg,#fff 0%,#f8f2ea 100%);border:1px solid rgba(73,54,25,.08)}
.pd-meta-item{padding:1rem}.pd-meta-item small{display:block;font-size:.76rem;letter-spacing:.08em;text-transform:uppercase;color:#9b907f;margin-bottom:.35rem}.pd-meta-item strong{color:#2f2619;font-size:.98rem}
.pd-stock{border-radius:22px;padding:1rem 1.1rem;background:#fffaf3;border:1px solid rgba(177,137,73,.18);margin-bottom:1.5rem}.pd-stock-line{display:flex;justify-content:space-between;gap:1rem;font-weight:600;color:#463729;margin-bottom:.7rem}.pd-stock-bar{height:10px;border-radius:999px;background:rgba(166,124,57,.14);overflow:hidden}.pd-stock-bar span{display:block;height:100%;background:linear-gradient(90deg,#b4883f 0%,#d5ae62 100%)}
.pd-shell .product-action-detail{padding-top:0!important;border-top:0!important}
.pd-shell .product-action-detail .product-action{display:flex!important;gap:.75rem!important;align-items:center}
.pd-shell .product-action-detail .product-action{position:static!important;transform:none!important;opacity:1!important;visibility:visible!important;width:auto!important}
.pd-shell .product-action-detail .product-quantity{flex:0 0 160px;max-width:160px}
.pd-shell .product-action-detail .product-action{flex:1 1 auto;justify-content:flex-start}
.pd-shell .product-action-detail .btn-style.secondary-btn{min-width:190px;min-height:52px;padding:0 1.5rem;border-radius:999px;background:linear-gradient(135deg,#1f1912 0%,#5c4523 100%)!important;border-color:transparent!important;color:#fff!important;box-shadow:0 18px 35px rgba(41,28,13,.18)}
.pd-shell .product-action a,.pd-related-item .product-action a{width:48px!important;height:48px!important}
.pd-shell .js-qty-wrap{padding:.2rem;border-radius:999px!important;background:#fff!important;border:1px solid rgba(73,54,25,.12);min-width:150px}
.pd-shell .js-qty-wrap button,.pd-shell .js-qty-wrap input{height:44px}
.pd-card .product-img-big .product-item-img{min-height:620px;display:flex;align-items:center;justify-content:center;background:#fff;padding:1rem}
.pd-card .product-img-big .product-item-img img{display:block;width:auto!important;height:auto!important;max-width:100%!important;max-height:560px!important;object-fit:contain!important;object-position:center}
.pd-card .product-img-small .product-item-img{height:92px;display:flex;align-items:center;justify-content:center;background:#fff}
.pd-card .product-img-small .product-item-img img{width:100%!important;height:100%!important;object-fit:contain}
.pd-services{margin-top:1.75rem}.pd-service{padding:1.1rem .9rem;text-align:center;flex:1 1 160px;color:#43392e}.pd-service i{font-size:1.45rem;color:#a67c39;margin-bottom:.75rem}
.pd-tabs,.pd-related{padding:2rem}.pd-tab-nav{margin-bottom:1.75rem;border-bottom:1px solid rgba(73,54,25,.08)}.pd-tab-nav .nav-tabs{gap:1rem}.pd-tab-nav .nav-tabs a{padding:0 0 1rem!important;color:#8f8578;position:relative}.pd-tab-nav .nav-tabs a.active{color:#2f2619}.pd-tab-nav .nav-tabs a.active:after{content:"";position:absolute;left:0;right:0;bottom:-1px;height:2px;background:#b4883f}
.pd-tab-grid{display:grid;grid-template-columns:1.3fr .7fr;gap:1.5rem}.pd-side-card{padding:1.5rem}.pd-side-card h6{color:#2f2619;margin-bottom:.9rem;font-size:1.15rem}.pd-side-card .pd-copy{white-space:pre-wrap}
.pd-specs{display:grid;gap:.8rem}.pd-spec{display:flex;justify-content:space-between;gap:1rem;padding:.9rem 1rem;border-radius:18px;background:#f8f1e7;color:#43392e}.pd-spec span:first-child{color:#8f8578}
.pd-head{display:flex;justify-content:space-between;align-items:end;gap:1rem;margin-bottom:1.5rem}.pd-head h2{margin:0;font-family:"Playfair Display",serif;font-size:clamp(2rem,3vw,2.8rem);color:#2f2619}.pd-head p{margin:0;color:#8f8578}
.pd-related-grid{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:1.25rem}
.pd-related-item{height:100%;padding:1rem}.pd-related-item .product-content{padding-top:1rem}.pd-related-item .product-title{margin-bottom:.55rem}.pd-related-item .product-title a{color:#2f2619;font-size:1rem;line-height:1.5}.pd-related-item .product-cat{color:#8f8578;font-size:.86rem}
.pd-related-item .product-image{position:relative}
.pd-related-item .product-action{position:absolute!important;left:50%!important;bottom:14px!important;transform:translateX(-50%)!important;display:flex!important;gap:10px!important;opacity:1!important;visibility:visible!important;width:auto!important;z-index:6!important}
.pd-related-item .product-action a{width:38px!important;height:38px!important;min-width:38px!important;border-radius:50%!important;background:#fff!important;color:#2f2619!important;border:1px solid rgba(73,54,25,.08)!important;box-shadow:0 10px 24px rgba(41,28,13,.14)!important}
.pd-related-item .product-action a:hover{background:var(--dominant-font-color)!important;color:#fff!important}
.pd-related-item .product-action .product-icon{display:flex!important;align-items:center!important;justify-content:center!important;width:100%!important;height:100%!important}
.pd-related-item .product-action .product-icon i{font-size:16px!important;line-height:1!important}
.pd-related-item .product-action .tooltip-text{display:none!important}
.pd-related-item .product-loader-icon,.pd-related-item .product-check-icon{display:none!important}
@media (max-width:1199.98px){.pd-meta,.pd-tab-grid{grid-template-columns:1fr}.pd-services{gap:.8rem}.pd-card .product-img-big .product-item-img{min-height:520px}.pd-card .product-img-big .product-item-img img{max-height:460px!important}}
@media (max-width:991.98px){.pd-related-grid{grid-template-columns:repeat(2,minmax(0,1fr))}}
@media (max-width:767.98px){.pd-shell{padding-top:16px}.pd-stage{padding:2.75rem 0 1.5rem}.pd-card,.pd-tabs,.pd-related{padding:1.2rem;border-radius:22px}.pd-meta,.pd-related-grid{grid-template-columns:1fr}.pd-cta{flex-direction:column;align-items:stretch}.pd-shell .product-action-detail .product-quantity{flex:1 1 auto;max-width:none}.pd-shell .product-action-detail .btn-style.secondary-btn,.pd-shell .product-action-detail .product-action{width:100%}.pd-card .product-img-big .product-item-img{min-height:360px;padding:.75rem}.pd-card .product-img-big .product-item-img img{max-height:300px!important}.pd-card .product-img-small .product-item-img{height:72px}}
</style>
@endpush

@section('content')
@php
    $galleryImages = ($product->gallery ?? collect())->filter(fn ($image) => filled($image->image))->values();
    $mainImage = filled($product->main_image) ? imgPath($product->main_image) : null;
    $allImages = $galleryImages->isNotEmpty() ? $galleryImages->pluck('image')->map(fn ($image) => imgPath($image)) : collect($mainImage ? [$mainImage] : []);
    $hasProductImages = $allImages->isNotEmpty();
    $price = number_format($product->effectivePrice(), 2);
    $originalPrice = $product->hasDiscount() ? number_format($product->price, 2) : null;
    $stockPercent = min(100, max(8, $product->quantity));
    $specs = collect([
        'Metal Type' => $product->metal_type,
        'Purity' => $product->purity,
        'Weight' => $product->weight,
        'Stone Type' => $product->stone_type,
        'Stone Weight' => $product->stone_weight,
        'SKU' => $product->sku,
    ])->filter(fn ($value) => filled($value));
@endphp

<div class="pd-shell">
    <div class="breadcrumb-area ptb-15">
        <div class="container">
            <span class="d-block extra-color"><a href="{{ url('/') }}" class="extra-color">Home</a> / <a href="{{ route('products') }}" class="extra-color">Shop</a> / {{ $product->name }}</span>
        </div>
    </div>

    <main id="main">
        <section class="pd-stage">
            <div class="container">
                <div class="row g-4 align-items-start">
                    @if($hasProductImages)
                    <div class="col-12 col-lg-7" data-animate="animate__fadeIn">
                        <div class="pd-card">
                            <div class="product-detail-slider">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <div class="product-img-big slider-big-h position-relative br-hidden">
                                            <div class="swiper" id="slider-big-h">
                                                <div class="swiper-wrapper product-swiper-wrapper">
                                                    @foreach($allImages as $image)
                                                    <div class="swiper-slide product-swiper-slide">
                                                        <div class="product-item-img position-relative">
                                                            <a href="{{ $image }}" class="full-view product-thumbnail heading-color position-absolute top-0 end-0 width-40 height-40 d-flex align-items-center justify-content-center body-bg z-1 mst-15 mer-15 rounded-circle box-shadow" aria-label="Image full view"><i class="ri-fullscreen-line d-block lh-1"></i></a>
                                                            <img src="{{ $image }}" data-zoom="{{ $image }}" class="w-100 img-fluid zoom" alt="{{ $product->name }}">
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="swiper-buttons">
                                                <button type="button" class="swiper-prev swiper-prev-big secondary-btn icon-16 width-40 height-40 position-absolute top-50 translate-middle-y z-1 rounded-circle" aria-label="Arrow previous"><i class="ri-arrow-left-line d-block lh-1"></i></button>
                                                <button type="button" class="swiper-next swiper-next-big secondary-btn icon-16 width-40 height-40 position-absolute top-50 translate-middle-y z-1 rounded-circle" aria-label="Arrow next"><i class="ri-arrow-right-line d-block lh-1"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="product-img-small slider-small-h">
                                            <div class="swiper" id="slider-small-h">
                                                <div class="swiper-wrapper">
                                                    @foreach($allImages as $image)
                                                    <div class="swiper-slide product-swiper-slide">
                                                        <div class="product-item-img br-hidden">
                                                            <a href="javascript:void(0)" class="d-block product-thumbnail"><img src="{{ $image }}" class="w-100 img-fluid" alt="{{ $product->name }}"></a>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="col-12 {{ $hasProductImages ? 'col-lg-5' : 'col-lg-12' }}" data-animate="animate__fadeIn">
                        <div class="pd-card pd-info">
                            <div class="pd-badges">
                                <span class="pd-badge"><i class="ri-sparkling-2-line"></i>{{ $product->category->name ?? 'Jewelry' }}</span>
                                <span class="pd-badge"><i class="ri-shield-check-line"></i>{{ $product->quantity > 0 ? 'Ready to ship' : 'Currently unavailable' }}</span>
                            </div>
                            <h1 class="pd-title">{{ $product->name }}</h1>
                            <div class="pd-price-wrap" style="margin: 1.25rem 0;">
                                <div class="pd-price m-0" style="align-items: center; gap: .8rem; flex-wrap: wrap;">
                                    <strong style="white-space: nowrap;">₹{{ $price }}</strong>
                                    @if($originalPrice)
                                        <small class="text-decoration-line-through text-muted" style="font-size: 1.1rem; white-space: nowrap;">₹{{ $originalPrice }}</small>
                                    @endif
                                </div>
                                <span style="display: block; margin-top: .5rem; color: #8f8578; font-size: .92rem;">Crafted for timeless everyday elegance.</span>
                            </div>
                            <div class="pd-copy">{!! $product->description ?: 'This piece is designed to bring refined elegance, balanced detailing, and a polished finish to your jewelry collection.' !!}</div>

                            <div class="pd-meta">
                                <div class="pd-meta-item"><small>Availability</small><strong>{{ $product->quantity > 0 ? 'In stock ('.$product->quantity.')' : 'Out of stock' }}</strong></div>
                                <div class="pd-meta-item"><small>SKU</small><strong>{{ $product->sku ?? 'N/A' }}</strong></div>
                                <div class="pd-meta-item"><small>Metal</small><strong>{{ $product->metal_type ?? 'Premium finish' }}</strong></div>
                                <div class="pd-meta-item"><small>Purity / Style</small><strong>{{ $product->purity ?? 'Signature design' }}</strong></div>
                            </div>

                            @if($product->quantity > 0)
                            <div class="pd-stock">
                                <div class="pd-stock-line"><span>Only {{ $product->quantity }} piece{{ $product->quantity > 1 ? 's' : '' }} left</span><span>Fast moving</span></div>
                                <div class="pd-stock-bar"><span style="width: {{ $stockPercent }}%;"></span></div>
                            </div>
                            @endif

                            <form method="post" action="javascript:void(0)" class="product-form">
                                <div class="product-action-detail">
                                    <div class="pd-cta">
                                        <div class="product-quantity">
                                            <span class="d-inline-block text-uppercase heading-color heading-weight meb-11">Quantity</span>
                                            <div class="js-qty-wrapper">
                                                <div class="js-qty-wrap d-flex extra-bg border-full br-hidden">
                                                    <button type="button" class="js-qty-adjust js-qty-adjust-minus body-color icon-16" aria-label="Remove item"><i class="ri-subtract-line d-block lh-1"></i></button>
                                                    <input type="number" name="quantity" class="js-qty-num qty-num p-0 text-center border-0" value="1" min="1" max="{{ $product->quantity > 0 ? $product->quantity : 1 }}">
                                                    <button type="button" class="js-qty-adjust js-qty-adjust-plus body-color icon-16" aria-label="Add item"><i class="ri-add-line d-block lh-1"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-action">
                                            <button type="button" class="btn-style secondary-btn add-to-cart ajax-add-to-cart @if($product->quantity <= 0) disabled @endif" data-product-id="{{ $product->id }}" @if($product->quantity <= 0) disabled @endif>
                                                <span class="product-bag-icon mer-5"><i class="ri-shopping-bag-3-line icon-16 lh-1"></i></span>
                                                <span class="product-loader-icon icon-16 lh-1 mer-5" style="display:none;"><i class="ri-loader-4-line"></i></span>
                                                <span class="product-check-icon icon-16 lh-1 mer-5" style="display:none;"><i class="ri-check-line"></i></span>
                                                Add to cart
                                            </button>
                                            <a href="javascript:void(0)" class="add-to-wishlist d-inline-flex align-items-center justify-content-center body-color" title="Add to Wishlist" data-product-id="{{ $product->id }}"><i class="ri-heart-line d-block icon-16 lh-1"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div class="pd-services">
                                <div class="pd-service"><i class="ri-box-3-line d-block lh-1"></i><div>Easy return & exchange</div></div>
                                <div class="pd-service"><i class="ri-hand-coin-line d-block lh-1"></i><div>Cash on delivery</div></div>
                                <div class="pd-service"><i class="ri-truck-line d-block lh-1"></i><div>Secure delivery</div></div>
                                <div class="pd-service"><i class="ri-secure-payment-line d-block lh-1"></i><div>Protected checkout</div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-pb">
            <div class="container">
                <div class="pd-tabs" data-animate="animate__fadeIn">
                    <div class="pd-tab-nav">
                        <ul class="nav nav-tabs ul-tab border-0" role="tablist">
                            <li><a href="#pro-desc-tab" class="d-block heading-weight active" data-bs-toggle="tab" role="tab" aria-selected="true">Description</a></li>
                            <li><a href="#pro-ai-tab" class="d-block heading-weight" data-bs-toggle="tab" role="tab" aria-selected="false">Additional Info</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="pro-desc-tab">
                            <div class="pd-tab-grid">
                                <div class="pd-side-card"><h6>About this piece</h6><div class="pd-copy">{!! $product->description ?? 'No description available for this product.' !!}</div></div>
                                <div class="pd-side-card">
                                    <h6>Quick details</h6>
                                    <div class="pd-specs">
                                        <div class="pd-spec"><span>Category</span><strong>{{ $product->category->name ?? 'Jewelry' }}</strong></div>
                                        <div class="pd-spec"><span>Availability</span><strong>{{ $product->quantity > 0 ? 'In stock' : 'Out of stock' }}</strong></div>
                                        <div class="pd-spec"><span>SKU</span><strong>{{ $product->sku ?? 'N/A' }}</strong></div>
                                        <div class="pd-spec"><span>Price</span><strong>₹{{ $price }}</strong></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pro-ai-tab">
                            <div class="pd-tab-grid">
                                <div class="pd-side-card">
                                    <h6>Product specifications</h6>
                                    @if($specs->isNotEmpty())
                                    <div class="pd-specs">
                                        @foreach($specs as $label => $value)
                                        <div class="pd-spec"><span>{{ $label }}</span><strong>{{ $value }}</strong></div>
                                        @endforeach
                                    </div>
                                    @else
                                    <div class="pd-copy">No additional information available for this product yet.</div>
                                    @endif
                                </div>
                                <div class="pd-side-card"><h6>Why you'll love it</h6><div class="pd-copy">A refined silhouette, balanced detailing, and a polished presentation make this piece easy to dress up or wear every day. It is designed to feel elegant without becoming difficult to style.</div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @if($relatedProducts->count() > 0)
        <section class="section-pb">
            <div class="container">
                <div class="pd-related">
                    <div class="pd-head" data-animate="animate__fadeIn"><div><h2>Related pieces</h2><p>More styles you may want to explore next.</p></div></div>
                    <div class="pd-related-grid">
                        @foreach($relatedProducts as $relProduct)
                        @php
                            $relatedMainImage = filled($relProduct->main_image) ? imgPath($relProduct->main_image) : null;
                            $relatedHoverImage = $relProduct->gallery && $relProduct->gallery->count() > 0 && filled($relProduct->gallery->first()->image) ? imgPath($relProduct->gallery->first()->image) : $relatedMainImage;
                        @endphp
                        <div class="pd-related-item" data-animate="animate__fadeIn">
                            <div class="single-product w-100">
                                <div class="row single-product-wrap">
                                    <div class="product-image-col">
                                        <div class="product-image-cat-variant">
                                            <div class="product-image">
                                                <a href="{{ route('products.show', $relProduct->id) }}" class="pro-img">
                                                    @if($relatedMainImage)
                                                    <img src="{{ $relatedMainImage }}" class="w-100 img-fluid img1" alt="{{ $relProduct->name }}">
                                                    <img src="{{ $relatedHoverImage }}" class="w-100 img-fluid img2" alt="{{ $relProduct->name }}">
                                                    @endif
                                                </a>
                                                <div class="product-action">
                                                    <a href="javascript:void(0)" class="add-to-wishlist" data-product-id="{{ $relProduct->id }}">
                                                        <i class="ri-heart-line d-block icon-16 lh-1"></i>
                                                        <span class="tooltip-text">wishlist</span>
                                                    </a>
                                                    <a href="javascript:void(0)" class="quick-view dynamic-quickview" data-product-id="{{ $relProduct->id }}">
                                                        <i class="ri-eye-line d-block icon-16 lh-1"></i>
                                                        <span class="tooltip-text">quickview</span>
                                                    </a>
                                                    <a href="javascript:void(0)" class="add-to-cart ajax-add-to-cart" data-product-id="{{ $relProduct->id }}">
                                                        <span class="product-bag-icon icon-16"><i class="ri-shopping-cart-line d-block lh-1"></i></span>
                                                        <span class="product-loader-icon icon-16"><i class="ri-loader-4-line d-block lh-1"></i></span>
                                                        <span class="product-check-icon icon-16"><i class="ri-check-line d-block lh-1"></i></span>
                                                        <span class="tooltip-text">add to cart</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="product-cat-variant"><div class="pro-cat-variant"><div class="product-cat"><span class="d-block">{{ $relProduct->category->name ?? 'Jewelry' }}</span></div></div></div>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <div class="pro-content">
                                            <div class="product-title"><span class="d-block heading-weight"><a href="{{ route('products.show', $relProduct->id) }}" class="d-block w-100 dominant-link">{{ $relProduct->name }}</a></span></div>
                                            <div class="product-price">
                                                <div class="price-box heading-weight">
                                                    <span class="new-price dominant-color">₹{{ number_format($relProduct->effectivePrice(), 2) }}</span>
                                                    @if($relProduct->hasDiscount())
                                                        <span class="old-price ms-2 text-decoration-line-through">₹{{ number_format($relProduct->price, 2) }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        @endif
    </main>
</div>
@endsection
