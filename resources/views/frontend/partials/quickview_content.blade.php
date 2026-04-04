<div class="row row-mtm quickview-modal-content">
                                <div class="col-12 col-md-6">
                                    <!-- quickview-detail-slider start -->
                                    <div class="quickview-detail-slider">
                                        <div class="row ul-mt15">
                                            <div class="col-12">
                                                <!-- quickview-img-big start -->
                                                <div class="quickview-img-big quickview-slider-big position-relative br-hidden">
                                                    <div class="swiper" id="quickview-slider-big">
                                                        <div class="swiper-wrapper">
                                                            <div class="swiper-slide">
                                                                <img src="{{ imgPath($product->main_image) }}" class="w-100 img-fluid" alt="{{ $product->name }}">
                                                            </div>
                                                            @foreach($product->gallery as $image)
                                                                <div class="swiper-slide">
                                                                    <img src="{{ imgPath($image->image) }}" class="w-100 img-fluid" alt="{{ $product->name }}">
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        <div class="swiper-buttons">
                                                            <button type="button" class="swiper-prev swiper-prev-quickview-big secondary-btn icon-16 width-32 height-32 position-absolute top-50 translate-middle-y z-1 rounded-circle" aria-label="Arrow previous"><i class="ri-arrow-left-line d-block lh-1"></i></button>
                                                            <button type="button" class="swiper-next swiper-next-quickview-big secondary-btn icon-16 width-32 height-32 position-absolute top-50 translate-middle-y z-1 rounded-circle" aria-label="Arrow next"><i class="ri-arrow-right-line d-block lh-1"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- quickview-img-big end -->
                                            </div>
                                            <div class="col-12">
                                                <!-- quickview-img-small start -->
                                                <div class="quickview-img-small quickview-slider-small">
                                                    <div class="swiper" id="quickview-slider-small">
                                                        <div class="swiper-wrapper">
                                                            <div class="swiper-slide">
                                                                <img src="{{ imgPath($product->main_image) }}" class="w-100 img-fluid border-radius" alt="{{ $product->name }}">
                                                            </div>
                                                            @foreach($product->gallery as $image)
                                                                <div class="swiper-slide">
                                                                    <img src="{{ imgPath($image->image) }}" class="w-100 img-fluid border-radius" alt="{{ $product->name }}">
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- quickview-img-small end -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- quickview-detail-slider end -->
                                </div>
                                <div class="col-12 col-md-6">
                                    <!-- quickview-info start -->
                                    <div class="quickview-info p-md-relative height-md-100">
                                        <form action="javascript:void(0)" class="quickview-form h-100">
                                            <div class="quickview-detail-info p-md-absolute top-0 bottom-0 start-0 psl-md-3 per-md-30">
                                                <div class="quick-info">
                                                    <div class="product-sku">
                                                        <span class="font-14 text-uppercase">SKU: {{ $product->sku }}</span>
                                                    </div>
                                                </div>
                                                <div class="quick-info mst-5">
                                                    <div class="product-title">
                                                        <h2 class="font-20">{{ $product->name }}</h2>
                                                    </div>
                                                </div>
                                                <div class="quick-info mst-10">
                                                    <div class="product-price">
                                                        <div class="price-box font-18">
                                                            <span class="new-price dominant-color heading-weight">${{ number_format($product->price, 2) }}</span>
                                                            @if($product->discount_price)
                                                                <span class="heading-weight">~ <span class="old-price text-decoration-line-through">${{ number_format($product->discount_price, 2) }}</span></span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="quick-info mst-10">
                                                    <div class="product-availability">
                                                        @if($product->quantity > 0)
                                                            <span class="d-inline-block text-success"><span class="heading-color heading-weight mer-10">Availability:</span>In stock</span>
                                                        @else
                                                            <span class="d-inline-block text-danger"><span class="heading-color heading-weight mer-10">Availability:</span>Out of stock</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                @if($product->quantity > 0)
                                                <div class="quick-info mst-10">
                                                    <div class="product-stock">
                                                        <span class="d-inline-block stock-fill text-success ptb-10 plr-15 bg-success heading-weight border-success border-radius">Hurry up! only <span class="available-stock">{{ $product->quantity }}</span> products left in stock!</span>
                                                    </div>
                                                </div>
                                                @endif
                                                
                                                <div class="quick-info mst-20">
                                                    <div class="product-border bst"></div>
                                                </div>
                                                <div class="quick-info mst-15">
                                                    <div class="product-desc">
                                                        <p>{!! $product->short_description !!}</p>
                                                    </div>
                                                </div>
                                                
                                                <div class="quick-info mst-20">
                                                    <div class="product-quantity d-flex flex-wrap align-items-center">
                                                        <span class="heading-color heading-weight mer-10">Quantity:</span>
                                                        <div class="js-qty-wrapper">
                                                            <div class="js-qty-wrap d-flex extra-bg border-full br-hidden">
                                                                <button type="button" class="js-qty-adjust js-qty-adjust-minus body-color icon-16" aria-label="Remove item"><i class="ri-subtract-line d-block lh-1"></i></button>
                                                                <input type="number" name="quantity" class="js-qty-num p-0 text-center border-0" value="1" min="1">
                                                                <button type="button" class="js-qty-adjust js-qty-adjust-plus body-color icon-16" aria-label="Add item"><i class="ri-add-line d-block lh-1"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="product-button mst-15">
                                                        <div class="row btn-row15">
                                                            <div class="col-12">
                                                                <button type="button" class="w-100 btn-style quaternary-btn add-to-cart ajax-add-to-cart" data-product-id="{{ $product->id }}">
                                                                    <span class="product-icon">
                                                                        <span class="product-bag-icon">Add to cart</span>
                                                                        <span class="product-loader-icon icon-16"><i class="ri-loader-4-line d-block lh-1"></i></span>
                                                                        <span class="product-check-icon icon-16"><i class="ri-check-line d-block lh-1"></i></span>
                                                                    </span>
                                                                </button>
                                                            </div>
                                                            <div class="col-12">
                                                                <a href="{{ route('products.show', $product->id) }}" class="w-100 btn-style secondary-btn">View full details</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="quick-info mst-20">
                                                    <div class="product-border bst"></div>
                                                </div>
                                                <div class="quick-info mst-20">
                                                    <div class="product-delivery">
                                                        <span class="d-inline-block"><i class="ri-check-line heading-color icon-16 mer-4"></i>Your order will reach you within 5-7 business days</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- quickview-info end -->
                                </div>
                            </div>
