@php
    $site_logo = setting('site_logo');
    $site_addr = setting('address', setting('site_address', '1234 MG road, Bengaluru, Karnataka 560001, India'));
    $site_email = setting('email', setting('site_email', 'info@trezajewels.com'));
    $site_phone = setting('phone', setting('site_phone', '+91 98765-43210'));
    
    $instagram = setting('instagram', setting('instagram_link', '#'));
    $twitter = setting('twitter', setting('twitter_link', '#'));
    $facebook = setting('facebook', setting('facebook_link', '#'));

    $formatPhone = function($phone) {
        $number = preg_replace('/[^0-9]/', '', $phone);
        if (strlen($number) == 10) {
            return '+91 ' . substr($number, 0, 5) . ' ' . substr($number, 5);
        } elseif (strlen($number) == 12 && str_starts_with($number, '91')) {
            return '+91 ' . substr($number, 2, 5) . ' ' . substr($number, 7);
        }
        return $phone;
    };
@endphp

<!-- footer-top start -->
<footer id="footer" class="footer-area section-ptb">
    <div class="container">
        <div class="section-pb beb">
            <div class="row row-mtm">
                <div class="col-12 col-lg-3">
                    <div class="footer-theme-logo text-center text-lg-start">
                        <a href="{{ url('/') }}" class="d-inline-block theme-logo">
                            <img src="{{ $site_logo ? imgPath('settings/'.$site_logo) : asset('frontend/image/index2/logo.png') }}" class="width-96 width-xl-144 img-fluid" alt="logo">
                        </a>
                    </div>
                </div>
                <div class="col-12 col-lg-9">
                    <div class="footer-contact">
                        <div class="row row-mtm">
                            <div class="col-12 col-sm-6 col-xl-3">
                                <div class="d-flex">
                                    <span class="width-16 dominant-color icon-16"><i class="ri-map-pin-line"></i></span>
                                    <div class="psl-15 text-start">
                                        <div class="ul-ft">
                                            <span>{!! nl2br($site_addr) !!}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-xl-3">
                                <div class="d-flex">
                                    <span class="width-16 dominant-color icon-16"><i class="ri-mail-line"></i></span>
                                    <div class="psl-15 text-start">
                                        <div class="ul-ft">
                                            <span><a href="mailto:{{ $site_email }}" class="d-inline-block body-dominant-color">{{ $site_email }}</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-xl-3">
                                <div class="d-flex">
                                    <span class="width-16 dominant-color icon-16"><i class="ri-phone-line"></i></span>
                                    <div class="psl-15 text-start">
                                        <div class="ul-ft">
                                            <span><a href="tel:{{ $site_phone }}" class="d-inline-block body-dominant-color">{{ $formatPhone($site_phone) }}</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-xl-3">
                                <div class="ul-ft text-start">
                                    <a href="{{ $instagram }}" target="_blank" class="d-flex align-items-center body-dominant-color mb-2">
                                        <span class="width-16 dominant-color icon-16"><i class="ri-instagram-line"></i></span>
                                        <span class="psl-15">Instagram</span>
                                    </a>
                                    <a href="{{ $twitter }}" target="_blank" class="d-flex align-items-center body-dominant-color">
                                        <span class="width-16 dominant-color icon-16"><i class="ri-twitter-x-line"></i></span>
                                        <span class="psl-15">Twitter</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-pt">
            <div class="row row-mtm">
                <div class="col-12 col-xl-8 footer-list text-start">
                    <div class="row">
                        <div class="col-12 col-md-4 ft-list">
                            <div class="footer-menu">
                                <h6 class="ft-title d-none d-md-block font-18">Top Category</h6>
                                <a href="#collapse-top-category" class="ft-title font-18 d-flex d-md-none flex-wrap align-items-center justify-content-between" data-bs-toggle="collapse" aria-expanded="false">
                                    <span class="ftmenu-title width-calc-16 heading-weight">Top Category</span>
                                    <span class="ftmenu-icon width-16 icon-16"><i class="ri-add-line"></i></span>
                                </a>
                                <div class="ft-link collapse show" id="collapse-top-category">
                                    <ul class="ftlink-ul ul-ft pst-21 peb-1 peb-md-0">
                                        @foreach($categories->take(5) as $category)
                                        <li class="ftlink-li">
                                            <a href="{{ route('products', ['category' => $category->slug]) }}" class="d-inline-block body-dominant-color">{{ $category->name }}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 ft-list">
                            <div class="footer-menu">
                                <h6 class="ft-title d-none d-md-block font-18">Quick Links</h6>
                                <a href="#collapse-quick-links" class="ft-title font-18 d-flex d-md-none flex-wrap align-items-center justify-content-between" data-bs-toggle="collapse" aria-expanded="false">
                                    <span class="ftmenu-title width-calc-16 heading-weight">Quick Links</span>
                                    <span class="ftmenu-icon width-16 icon-16"><i class="ri-add-line"></i></span>
                                </a>
                                <div class="ft-link collapse show" id="collapse-quick-links">
                                    <ul class="ftlink-ul ul-ft pst-21 peb-1 peb-md-0">
                                        <li class="ftlink-li"><a href="{{ url('/') }}" class="d-inline-block body-dominant-color">Home</a></li>
                                        <li class="ftlink-li"><a href="{{ route('products') }}" class="d-inline-block body-dominant-color">Shop</a></li>
                                        <li class="ftlink-li"><a href="{{ route('about') }}" class="d-inline-block body-dominant-color">About Us</a></li>
                                        <li class="ftlink-li"><a href="{{ route('contact') }}" class="d-inline-block body-dominant-color">Contact Us</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 ft-list">
                            <div class="footer-menu">
                                <h6 class="ft-title d-none d-md-block font-18">Policies</h6>
                                <a href="#collapse-policies" class="ft-title font-18 d-flex d-md-none flex-wrap align-items-center justify-content-between" data-bs-toggle="collapse" aria-expanded="false">
                                    <span class="ftmenu-title width-calc-16 heading-weight">Policies</span>
                                    <span class="ftmenu-icon width-16 icon-16"><i class="ri-add-line"></i></span>
                                </a>
                                <div class="ft-link collapse show" id="collapse-policies">
                                    <ul class="ftlink-ul ul-ft pst-21 peb-1 peb-md-0">
                                        <li class="ftlink-li"><a href="{{ route('payment.policy') }}" class="d-inline-block body-dominant-color">Payment Policy</a></li>
                                        <li class="ftlink-li"><a href="{{ url('privacy-policy') }}" class="d-inline-block body-dominant-color">Privacy Policy</a></li>
                                        <li class="ftlink-li"><a href="{{ url('return-policy') }}" class="d-inline-block body-dominant-color">Return Policy</a></li>
                                        <li class="ftlink-li"><a href="{{ url('shipping-policy') }}" class="d-inline-block body-dominant-color">Shipping Policy</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-4 text-start">
                    <div class="footer-product position-relative">
                        <h6 class="font-18 meb-25">Best Our Store</h6>
                        <div class="footer-collection-slider swiper" id="footer-product-slider">
                            <div class="swiper-wrapper">
                                <!-- Pre-render static items or dynamic high-selling products if available -->
                                <div class="swiper-slide h-auto d-flex">
                                    <div class="single-product-list w-100">
                                        <p class="text-muted">High-end jewelry for every occasion.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer-bottom start -->
    <div class="copyright ptb-15 extra-bg mt-5">
        <div class="container">
            <div class="text-center">© {{ date('Y') }} Treza Jewels. Powered by spacingtech<sup>TM</sup></div>
        </div>
    </div>
    <!-- footer-bottom end -->
</footer>
<!-- footer end -->
