@php
    use App\Models\Setting;
    // Pre-fetch settings once to minimize DB queries in the template
    $site_logo = setting('site_logo');
    $site_addr = setting('address', setting('site_address', '1234 MG road, Bengaluru, Karnataka 560001'));
    $site_email = setting('email', setting('site_email', 'info@trezajewels.com'));
    $site_phone = setting('phone', setting('site_phone', '+91 98765-43210'));
    
    // Socials
    $instagram = setting('instagram', setting('instagram_link', '#'));
    $twitter = setting('twitter', setting('twitter_link', '#'));
    $facebook = setting('facebook', setting('facebook_link', '#'));
    $linkedin = setting('linkedin', setting('linkedin_link', '#'));
@endphp

<!-- footer start -->
<footer id="footer" class="footer-luxury pt-3 pb-2 mt-4">
    <div class="container text-center">
        <!-- Top Logo Section -->
        <div class="footer-logo-header">
            <a href="{{ url('/') }}" class="d-inline-block">
                <img src="{{ imgPath('uploads/settings/'.$site_logo) }}" class="footer-brand-logo" alt="Treza Jewels">
            </a>
        </div>

        <!-- Middle Info Section -->
        <div class="row justify-content-center gy-5 pb-0">
            <!-- (1) Policies -->
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0 text-center text-lg-start ps-lg-5">
                <div class="d-inline-block text-start">
                    <h6 class="footer-heading text-uppercase mb-4">Policies</h6>
                    <ul class="list-unstyled footer-nav-links">
                        <li class="mb-2"><a href="{{ route('payment.policy') }}" class="{{ request()->routeIs('payment.policy') ? 'footer-link-active' : '' }}">Payment Policy</a></li>
                        <li class="mb-2"><a href="{{ route('privacy.policy') }}" class="{{ request()->routeIs('privacy.policy') ? 'footer-link-active' : '' }}">Privacy Policy</a></li>
                        <li class="mb-2"><a href="{{ route('return.policy') }}" class="{{ request()->routeIs('return.policy') ? 'footer-link-active' : '' }}">Return Policy</a></li>
                        <li class="mb-2"><a href="{{ route('shipping.policy') }}" class="{{ request()->routeIs('shipping.policy') ? 'footer-link-active' : '' }}">Shipping Policy</a></li>
                        <li class="mb-2"><a href="{{ route('terms.condition') }}" class="{{ request()->routeIs('terms.condition') ? 'footer-link-active' : '' }}">Terms &amp; Conditions</a></li>
                    </ul>
                </div>
            </div>

            <!-- (2) Location & Contact -->
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0 text-center">
                <div class="d-inline-block text-start">
                    <h6 class="footer-heading text-uppercase mb-4">Location & Contact</h6>
                    <div class="footer-contact-info">
                        <p class="mb-3 d-flex align-items-start">
                            <i class="ri-map-pin-line me-3 text-gold mt-1 fs-5" style="width: 25px;"></i>
                            <span class="text-secondary">{!! nl2br($site_addr) !!}</span>
                        </p>
                        <p class="mb-3 d-flex align-items-center">
                            <i class="ri-mail-line me-3 text-gold fs-5" style="width: 25px;"></i>
                            <a href="mailto:{{ $site_email }}" class="text-secondary text-decoration-none hover-gold">{{ $site_email }}</a>
                        </p>
                        <p class="mb-3 d-flex align-items-center">
                            <i class="ri-phone-line me-3 text-gold fs-5" style="width: 25px;"></i>
                            <a href="tel:{{ $site_phone }}" class="text-secondary text-decoration-none hover-gold">{{ $site_phone }}</a>
                        </p>
                    </div>
                </div>
            </div>

            <!-- (3) Follow Us -->
            <div class="col-lg-4 col-md-12 text-center text-lg-end pe-lg-5">
                <div class="d-inline-block text-start">
                    <h6 class="footer-heading text-uppercase mb-4">Follow Us</h6>
                    <div class="footer-social-panel d-flex justify-content-start gap-3">
                        <a href="{{ $instagram }}" target="_blank" class="luxury-social-icon" title="Instagram">
                            <i class="ri-instagram-line"></i>
                        </a>
                        <a href="{{ $twitter }}" target="_blank" class="luxury-social-icon" title="Twitter">
                            <i class="ri-twitter-x-line"></i>
                        </a>
                        <a href="{{ $facebook }}" target="_blank" class="luxury-social-icon" title="Facebook">
                            <i class="ri-facebook-fill"></i>
                        </a>
                        <a href="{{ $linkedin }}" target="_blank" class="luxury-social-icon" title="LinkedIn">
                            <i class="ri-linkedin-fill"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Copyright Section -->
        <div class="footer-bottom-bar pt-4 border-top">
            <p class="mb-0 text-muted fs-8">© {{ date('Y') }} Treza Jewels. All rights reserved.</p>
        </div>
    </div>

    <style>
        .footer-luxury {
            background-color: #fcfbf7; /* Elegant off-white/beige */
            border-top: 1px solid rgba(201, 169, 110, 0.15);
            font-family: 'Outfit', sans-serif;
            color: #4a4a4a;
        }

        .footer-brand-logo {
            max-height: 180px; /* Big & Prominent */
            width: auto;
            transition: transform 0.3s ease;
        }

        .footer-brand-logo:hover {
            transform: scale(1.02);
        }

        .footer-heading {
            color: #C9A96E;
            font-weight: 600;
            letter-spacing: 3px; /* Luxury spacing */
            font-size: 0.95rem;
        }

        .footer-nav-links a {
            color: #777;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            display: inline-block;
        }

        .footer-nav-links a.footer-link-active {
            color: #C9A96E;
            transform: translateX(3px);
            font-weight: 600;
        }

        .footer-nav-links a:hover {
            color: #C9A96E;
            transform: translateX(3px);
        }

        .text-gold {
            color: #C9A96E;
        }

        .hover-gold:hover {
            color: #C9A96E !important;
        }

        .luxury-social-icon {
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            color: #C9A96E;
            border-radius: 50%;
            border: 1px solid rgba(201, 169, 110, 0.3);
            text-decoration: none;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            font-size: 1.1rem;
        }

        .luxury-social-icon:hover {
            background: #C9A96E;
            color: white !important;
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(201, 169, 110, 0.2);
            border-color: #C9A96E;
        }

        .footer-bottom-bar {
            border-color: rgba(201, 169, 110, 0.1) !important;
        }

        .fs-8 {
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .cart-drawer {
            width: min(460px, 100%);
            border-left: 1px solid rgba(176, 139, 102, 0.14);
            box-shadow: -18px 0 55px rgba(78, 57, 32, 0.16) !important;
        }

        .cart-drawer .drawer-fixed-header,
        .cart-drawer .drawer-footer {
            background: #fff;
        }

        .cart-drawer .drawer-header h6 {
            font-size: 26px;
            font-family: 'Marcellus', serif;
            margin: 0;
        }

        .cart-drawer .drawer-close-btn {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #f7f0e7;
            color: #8f6f4c;
            transition: all .25s ease;
        }

        .cart-drawer .drawer-close-btn:hover {
            background: #eadbc9;
        }

        .cart-drawer-item-list {
            display: grid;
            gap: 16px;
            padding: 8px 0 18px;
        }

        .cart-drawer-card {
            display: grid;
            grid-template-columns: 108px minmax(0, 1fr);
            gap: 16px;
            padding: 14px;
            background: #fff;
            border: 1px solid #eee4d8;
            border-radius: 22px;
            box-shadow: 0 14px 30px rgba(143, 111, 76, 0.07);
        }

        .cart-drawer-thumb {
            display: flex;
            align-items: center;
            justify-content: center;
            aspect-ratio: 1 / 1.15;
            border-radius: 18px;
            background: #fcfaf7;
            overflow: hidden;
        }

        .cart-drawer-thumb img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .cart-drawer-title {
            color: #2d2a26;
            font-size: 22px;
            font-family: 'Marcellus', serif;
            line-height: 1.15;
            text-decoration: none;
        }

        .cart-drawer-title:hover {
            color: #b08b66;
        }

        .cart-drawer-variants {
            margin-top: 6px;
            color: #8b8073;
            font-size: 13px;
        }

        .cart-drawer-price {
            margin-top: 10px;
            color: #b08b66;
            font-size: 24px;
            font-weight: 700;
            line-height: 1;
        }

        .cart-drawer-bottom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            margin-top: 16px;
        }

        .cart-drawer .js-qty-wrap {
            background: #fcfaf7 !important;
            border: 1px solid #eadfce !important;
            border-radius: 999px !important;
            overflow: hidden;
            min-height: 44px;
        }

        .cart-drawer .js-qty-wrap button {
            width: 40px;
            color: #8f6f4c;
        }

        .cart-drawer .qty-num {
            width: 40px !important;
            color: #2f2a26;
            font-weight: 700;
            background: transparent;
        }

        .cart-drawer-remove {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #fff4f3 !important;
            color: #e25c55 !important;
            border: 1px solid #f6d7d5 !important;
        }

        .cart-drawer-remove:hover {
            background: #ffe6e4 !important;
        }

        .cart-drawer .drawer-footer {
            border-top: 1px solid #eee4d8;
        }

        .cart-drawer-summary {
            padding: 18px;
            border: 1px solid #eee4d8;
            border-radius: 22px;
            background: linear-gradient(180deg, #fffdf9 0%, #f8f1e8 100%);
        }

        .cart-drawer-summary-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .cart-drawer-summary-row strong {
            color: #2d2a26;
            font-size: 17px;
        }

        .cart-drawer-total {
            color: #b08b66;
            font-size: 28px;
            font-weight: 700;
        }

        .cart-drawer-note {
            margin-top: 8px;
            color: #8b8073;
            font-size: 13px;
            line-height: 1.6;
        }

        .cart-drawer-checkout {
            margin-top: 16px;
        }

        .cart-drawer-checkout .checkbox-agree {
            padding: 12px 14px;
            background: #fff;
            border: 1px solid #eee4d8;
            border-radius: 16px;
        }

        .cart-drawer-checkout .btn-style {
            min-height: 54px;
            border-radius: 16px;
            font-weight: 700;
        }

        @media (max-width: 575px) {
            .cart-drawer-card {
                grid-template-columns: 88px minmax(0, 1fr);
                gap: 12px;
                padding: 12px;
            }

            .cart-drawer-title {
                font-size: 18px;
            }

            .cart-drawer-price {
                font-size: 20px;
            }
        }

        @media (max-width: 991px) {
            .footer-brand-logo {
                max-height: 110px;
            }
            .footer-heading {
                margin-top: 1rem;
            }
        }
    </style>
</footer>
<!-- footer end -->
        <!-- quickview-modal start -->
        <div class="quickview-modal modal fade" id="quickview-modal" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content body-bg border-0 br-hidden">
                    <div class="modal-body ptb-30 plr-15 plr-sm-30" id="quickview-modal-body">
                        <div class="quickview-modal-header d-flex align-items-center justify-content-between meb-30">
                            <h6 class="font-18">Quickview</h6>
                            <button type="button" class="body-secondary-color icon-16" data-bs-dismiss="modal" aria-label="Close"><i class="ri-close-large-line d-block lh-1"></i></button>
                        </div>
                        <div id="quickview-loader" class="text-center py-5" style="display: none;">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                        <div id="quickview-data" class="quickview-modal-content-wrapper">
                            <!-- Dynamic content will be loaded here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- quickview-modal end -->
        <!-- mobile-menu start -->
        <div class="mobile-menu d-xl-none position-fixed top-0 bottom-0 extra-bg z-index-5 invisible box-shadow" id="mobile-menu">
            <div class="mobile-contents d-flex flex-column">
                <div class="menu-close ptb-10 plr-15 beb">
                    <button type="button" class="menu-close-btn d-block body-secondary-color icon-16 ms-auto" aria-label="Menu close"><i class="ri-close-large-line d-block lh-1"></i></button>
                </div>
                <div class="mobilemenu-content beb">
                    <div class="main-wrap">
                        <ul class="menu-ul">
                            <li class="menu-li bst">
                                <div class="menu-btn d-flex flex-row-reverse">
                                    <button type="button" class="width-48 icon-16 ptb-10 bsl" data-bs-toggle="collapse" data-bs-target="#menu-home" aria-expanded="false" aria-label="Menu accordion"><i class="ri-add-line d-block lh-1"></i></button>
                                    <span class="width-calc-48 ptb-10 plr-15"><a href="{{ url('/') }}" class="d-inline-block body-color">Home</a></span>
                                </div>
                                <div class="menu-dropdown collapse" id="menu-home">
                                    <ul class="menudrop-ul">
                                        <li class="menudrop-li bst">
                                            <span class="d-block ptb-10 psl-20 per-15"><a href="index.html" class="d-inline-block body-color">01 Clean demo</a></span>
                                        </li>
                                        <li class="menudrop-li bst">
                                            <span class="d-block ptb-10 psl-20 per-15"><a href="index2.html" class="d-inline-block body-color">02 Classic demo</a></span>
                                        </li>
                                        <li class="menudrop-li bst">
                                            <span class="d-block ptb-10 psl-20 per-15"><a href="index3.html" class="d-inline-block body-color">03 Modern demo</a></span>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="menu-li bst">
                                <div class="menu-btn d-flex flex-row-reverse">
                                    <button type="button" class="width-48 icon-16 ptb-10 bsl" data-bs-toggle="collapse" data-bs-target="#menu-product" aria-expanded="false" aria-label="Menu accordion"><i class="ri-add-line d-block lh-1"></i></button>
                                    <span class="width-calc-48 ptb-10 plr-15"><a href="javascript:void(0)" class="d-inline-block">Product</a></span>
                                </div>
                                <div class="menu-dropdown collapse" id="menu-product">
                                    <ul class="menudrop-ul">
                                        <li class="menudrop-li bst">
                                            <span class="d-block ptb-10 psl-20 per-15"><a href="collections.html" class="d-inline-block body-color">Collections</a></span>
                                        </li>
                                        <li class="menudrop-li bst">
                                            <span class="d-block ptb-10 psl-20 per-15"><a href="collection-category.html" class="d-inline-block body-color">Collection category</a></span>
                                        </li>
                                        <li class="menudrop-li bst">
                                            <span class="d-block ptb-10 psl-20 per-15"><a href="collection-without.html" class="d-inline-block body-color">Collection full</a></span>
                                        </li>
                                        <li class="menudrop-li bst">
                                            <span class="d-block ptb-10 psl-20 per-15"><a href="collection.html" class="d-inline-block body-color">Collection left</a></span>
                                        </li>
                                        <li class="menudrop-li bst">
                                            <span class="d-block ptb-10 psl-20 per-15"><a href="collection-right.html" class="d-inline-block body-color">Collection right</a></span>
                                        </li>
                                        <li class="menudrop-li bst">
                                            <span class="d-block ptb-10 psl-20 per-15"><a href="collection-list-without.html" class="d-inline-block body-color">Collection list full</a></span>
                                        </li>
                                        <li class="menudrop-li bst">
                                            <span class="d-block ptb-10 psl-20 per-15"><a href="collection-list.html" class="d-inline-block body-color">Collection list left</a></span>
                                        </li>
                                        <li class="menudrop-li bst">
                                            <span class="d-block ptb-10 psl-20 per-15"><a href="collection-list-right.html" class="d-inline-block body-color">Collection list right</a></span>
                                        </li>
                                        <li class="menudrop-li bst">
                                            <span class="d-block ptb-10 psl-20 per-15"><a href="search-empty.html" class="d-inline-block body-color">Search empty</a></span>
                                        </li>
                                        <li class="menudrop-li bst">
                                            <span class="d-block ptb-10 psl-20 per-15"><a href="search-product.html" class="d-inline-block body-color">Search product</a></span>
                                        </li>
                                        <li class="menudrop-li bst">
                                            <div class="menu-btn d-flex flex-row-reverse">
                                                <button type="button" class="width-48 icon-16 ptb-10 bsl" data-bs-toggle="collapse" data-bs-target="#menu-productlayout" aria-expanded="false" aria-label="Menu accordion"><i class="ri-add-line d-block lh-1"></i></button>
                                                <span class="width-calc-48 ptb-10 psl-20 per-15"><a href="javascript:void(0)" class="d-inline-block">Product layout</a></span>
                                            </div>
                                            <div class="menusub-dropdown collapse" id="menu-productlayout">
                                                <ul class="menusub-ul">
                                                    <li class="menusub-li bst">
                                                        <span class="d-block ptb-10 psl-25 per-15"><a href="product.html" class="d-inline-block body-color">01 Bottom thumbnail frequently together</a></span>
                                                    </li>
                                                    <li class="menusub-li bst">
                                                        <span class="d-block ptb-10 psl-25 per-15"><a href="product2.html" class="d-inline-block body-color">02 Right thumbnail tab details</a></span>
                                                    </li>
                                                    <li class="menusub-li bst">
                                                        <span class="d-block ptb-10 psl-25 per-15"><a href="product3.html" class="d-inline-block body-color">03 Left thumbnail simple layout</a></span>
                                                    </li>
                                                    <li class="menusub-li bst">
                                                        <span class="d-block ptb-10 psl-25 per-15"><a href="product4.html" class="d-inline-block body-color">04 Solo modern vertical-tab full layout</a></span>
                                                    </li>
                                                    <li class="menusub-li bst">
                                                        <span class="d-block ptb-10 psl-25 per-15"><a href="product5.html" class="d-inline-block body-color">05 Full thumbnail creative layout</a></span>
                                                    </li>
                                                    <li class="menusub-li bst">
                                                        <span class="d-block ptb-10 psl-25 per-15"><a href="product6.html" class="d-inline-block body-color">06 Advance accordion-tab layout</a></span>
                                                    </li>
                                                    <li class="menusub-li bst">
                                                        <span class="d-block ptb-10 psl-25 per-15"><a href="product-comparison.html" class="d-inline-block body-color">Product comparision</a></span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="menudrop-li bst">
                                            <span class="d-block ptb-10 psl-20 per-15"><a href="collection.html" class="d-inline-block body-color">Featured collection</a></span>
                                        </li>
                                        <li class="menudrop-li bst">
                                            <span class="d-block ptb-10 psl-20 per-15"><a href="collection.html" class="d-inline-block body-color">New collection</a></span>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="menu-li bst">
                                <div class="menu-btn d-flex flex-row-reverse">
                                    <button type="button" class="width-48 icon-16 ptb-10 bsl" data-bs-toggle="collapse" data-bs-target="#menu-shop" aria-expanded="false" aria-label="Menu accordion"><i class="ri-add-line d-block lh-1"></i></button>
                                    <span class="width-calc-48 ptb-10 plr-15"><a href="{{ route('products') }}" class="d-inline-block body-color">Shop</a></span>
                                </div>
                                <div class="menu-dropdown collapse" id="menu-shop">
                                    <ul class="menudrop-ul">
                                        <li class="menudrop-li bst">
                                            <div class="menu-btn d-flex flex-row-reverse">
                                                <button type="button" class="width-48 icon-16 ptb-10 bsl" data-bs-toggle="collapse" data-bs-target="#menu-account" aria-expanded="false" aria-label="Menu accordion"><i class="ri-add-line d-block lh-1"></i></button>
                                                <span class="width-calc-48 ptb-10 psl-20 per-15"><a href="javascript:void(0)" class="d-inline-block">Account</a></span>
                                            </div>
                                            <div class="menusub-dropdown collapse" id="menu-account">
                                                <ul class="menusub-ul">
                                                    <li class="menusub-li bst">
                                                        <span class="d-block ptb-10 psl-25 per-15"><a href="login.html" class="d-inline-block body-color">Login</a></span>
                                                    </li>
                                                    <li class="menusub-li bst">
                                                        <span class="d-block ptb-10 psl-25 per-15"><a href="forgot-password.html" class="d-inline-block body-color">Forgot password</a></span>
                                                    </li>
                                                    <li class="menusub-li bst">
                                                        <span class="d-block ptb-10 psl-25 per-15"><a href="register.html" class="d-inline-block body-color">Register</a></span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="menudrop-li bst">
                                            <div class="menu-btn d-flex flex-row-reverse">
                                                <button type="button" class="width-48 icon-16 ptb-10 bsl" data-bs-toggle="collapse" data-bs-target="#menu-other" aria-expanded="false" aria-label="Menu accordion"><i class="ri-add-line d-block lh-1"></i></button>
                                                <span class="width-calc-48 ptb-10 psl-20 per-15"><a href="javascript:void(0)" class="d-inline-block">Other</a></span>
                                            </div>
                                            <div class="menusub-dropdown collapse" id="menu-other">
                                                <ul class="menusub-ul">
                                                    <li class="menusub-li bst">
                                                        <span class="d-block ptb-10 psl-25 per-15"><a href="cancellation.html" class="d-inline-block body-color">404</a></span>
                                                    </li>
                                                    <li class="menusub-li bst">
                                                        <span class="d-block ptb-10 psl-25 per-15"><a href="cart-empty.html" class="d-inline-block body-color">Cart empty</a></span>
                                                    </li>
                                                    <li class="menusub-li bst">
                                                        <span class="d-block ptb-10 psl-25 per-15"><a href="cart-page.html" class="d-inline-block body-color">Cart</a></span>
                                                    </li>
                                                    <li class="menusub-li bst">
                                                        <span class="d-block ptb-10 psl-25 per-15"><a href="checkout.html" class="d-inline-block body-color">Checkout</a></span>
                                                    </li>
                                                    <li class="menusub-li bst">
                                                        <span class="d-block ptb-10 psl-25 per-15"><a href="coming-soon.html" class="d-inline-block body-color">Comingsoon</a></span>
                                                    </li>
                                                    <li class="menusub-li bst">
                                                        <span class="d-block ptb-10 psl-25 per-15"><a href="invoice.html" class="d-inline-block body-color">Invoice</a></span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="menudrop-li bst">
                                            <div class="menu-btn d-flex flex-row-reverse">
                                                <button type="button" class="width-48 icon-16 ptb-10 bsl" data-bs-toggle="collapse" data-bs-target="#menu-order" aria-expanded="false" aria-label="Menu accordion"><i class="ri-add-line d-block lh-1"></i></button>
                                                <span class="width-calc-48 ptb-10 psl-20 per-15"><a href="javascript:void(0)" class="d-inline-block">Order</a></span>
                                            </div>
                                            <div class="menusub-dropdown collapse" id="menu-order">
                                                <ul class="menusub-ul">
                                                    <li class="menusub-li bst">
                                                        <span class="d-block ptb-10 psl-25 per-15"><a href="order-complete.html" class="d-inline-block body-color">Order complete</a></span>
                                                    </li>
                                                    <li class="menusub-li bst">
                                                        <span class="d-block ptb-10 psl-25 per-15"><a href="order.html" class="d-inline-block body-color">Order</a></span>
                                                    </li>
                                                    <li class="menusub-li bst">
                                                        <span class="d-block ptb-10 psl-25 per-15"><a href="order-info.html" class="d-inline-block body-color">Order info</a></span>
                                                    </li>
                                                    <li class="menusub-li bst">
                                                        <span class="d-block ptb-10 psl-25 per-15"><a href="order-info-default.html" class="d-inline-block body-color">Order default</a></span>
                                                    </li>
                                                    <li class="menusub-li bst">
                                                        <span class="d-block ptb-10 psl-25 per-15"><a href="order-info-unfulfilled.html" class="d-inline-block body-color">Order unfulfilled</a></span>
                                                    </li>
                                                    <li class="menusub-li bst">
                                                        <span class="d-block ptb-10 psl-25 per-15"><a href="order-info-fulfilled.html" class="d-inline-block body-color">Order fulfilled</a></span>
                                                    </li>
                                                    <li class="menusub-li bst">
                                                        <span class="d-block ptb-10 psl-25 per-15"><a href="order-info-inprogress.html" class="d-inline-block body-color">Order inprogress</a></span>
                                                    </li>
                                                    <li class="menusub-li bst">
                                                        <span class="d-block ptb-10 psl-25 per-15"><a href="order-info-intransit.html" class="d-inline-block body-color">Order intransit</a></span>
                                                    </li>
                                                    <li class="menusub-li bst">
                                                        <span class="d-block ptb-10 psl-25 per-15"><a href="order-info-indelivery.html" class="d-inline-block body-color">Order indelivery</a></span>
                                                    </li>
                                                    <li class="menusub-li bst">
                                                        <span class="d-block ptb-10 psl-25 per-15"><a href="order-info-delivered.html" class="d-inline-block body-color">Order delivered</a></span>
                                                    </li>
                                                    <li class="menusub-li bst">
                                                        <span class="d-block ptb-10 psl-25 per-15"><a href="order-info-pickup.html" class="d-inline-block body-color">Order pickup</a></span>
                                                    </li>
                                                    <li class="menusub-li bst">
                                                        <span class="d-block ptb-10 psl-25 per-15"><a href="order-info-cancel.html" class="d-inline-block body-color">Order cancel</a></span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="menudrop-li bst">
                                            <div class="menu-btn d-flex flex-row-reverse">
                                                <button type="button" class="width-48 icon-16 ptb-10 bsl" data-bs-toggle="collapse" data-bs-target="#menu-profile" aria-expanded="false" aria-label="Menu accordion"><i class="ri-add-line d-block lh-1"></i></button>
                                                <span class="width-calc-48 ptb-10 psl-20 per-15"><a href="javascript:void(0)" class="d-inline-block">Profile</a></span>
                                            </div>
                                            <div class="menusub-dropdown collapse" id="menu-profile">
                                                <ul class="menusub-ul">
                                                    <li class="menusub-li bst">
                                                        <span class="d-block ptb-10 psl-25 per-15"><a href="profile.html" class="d-inline-block body-color">Profile</a></span>
                                                    </li>
                                                    <li class="menusub-li bst">
                                                        <span class="d-block ptb-10 psl-25 per-15"><a href="profile-address.html" class="d-inline-block body-color">Profile address</a></span>
                                                    </li>
                                                    <li class="menusub-li bst">
                                                        <span class="d-block ptb-10 psl-25 per-15"><a href="profile-notification.html" class="d-inline-block body-color">Profile notification</a></span>
                                                    </li>
                                                    <li class="menusub-li bst">
                                                        <span class="d-block ptb-10 psl-25 per-15"><a href="profile-order.html" class="d-inline-block body-color">Profile order</a></span>
                                                    </li>
                                                    <li class="menusub-li bst">
                                                        <span class="d-block ptb-10 psl-25 per-15"><a href="profile-order-empty.html" class="d-inline-block body-color">Profile order empty</a></span>
                                                    </li>
                                                    <li class="menusub-li bst">
                                                        <span class="d-block ptb-10 psl-25 per-15"><a href="profile-ticket.html" class="d-inline-block body-color">Profile ticket</a></span>
                                                    </li>
                                                    <li class="menusub-li bst">
                                                        <span class="d-block ptb-10 psl-25 per-15"><a href="profile-ticket-empty.html" class="d-inline-block body-color">Profile ticket empty</a></span>
                                                    </li>
                                                    <li class="menusub-li bst">
                                                        <span class="d-block ptb-10 psl-25 per-15"><a href="profile-wishlist.html" class="d-inline-block body-color">Profile wishlist</a></span>
                                                    </li>
                                                    <li class="menusub-li bst">
                                                        <span class="d-block ptb-10 psl-25 per-15"><a href="profile-wishlist-empty.html" class="d-inline-block body-color">Profile wishlist empty</a></span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="menudrop-li bst">
                                            <div class="menu-btn d-flex flex-row-reverse">
                                                <button type="button" class="width-48 icon-16 ptb-10 bsl" data-bs-toggle="collapse" data-bs-target="#menu-ticket" aria-expanded="false" aria-label="Menu accordion"><i class="ri-add-line d-block lh-1"></i></button>
                                                <span class="width-calc-48 ptb-10 psl-20 per-15"><a href="javascript:void(0)" class="d-inline-block">Ticket</a></span>
                                            </div>
                                            <div class="menusub-dropdown collapse" id="menu-ticket">
                                                <ul class="menusub-ul">
                                                    <li class="menusub-li bst">
                                                        <span class="d-block ptb-10 psl-25 per-15"><a href="ticket.html" class="d-inline-block body-color">Ticket</a></span>
                                                    </li>
                                                    <li class="menusub-li bst">
                                                        <span class="d-block ptb-10 psl-25 per-15"><a href="ticket-create.html" class="d-inline-block body-color">Ticket create</a></span>
                                                    </li>
                                                    <li class="menusub-li bst">
                                                        <span class="d-block ptb-10 psl-25 per-15"><a href="ticket-edit.html" class="d-inline-block body-color">Ticket edit</a></span>
                                                    </li>
                                                    <li class="menusub-li bst">
                                                        <span class="d-block ptb-10 psl-25 per-15"><a href="ticket-info.html" class="d-inline-block body-color">Ticket info</a></span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="menudrop-li bst">
                                            <div class="menu-btn d-flex flex-row-reverse">
                                                <button type="button" class="width-48 icon-16 ptb-10 bsl" data-bs-toggle="collapse" data-bs-target="#menu-features" aria-expanded="false" aria-label="Menu accordion"><i class="ri-add-line d-block lh-1"></i></button>
                                                <span class="width-calc-48 ptb-10 psl-20 per-15"><a href="javascript:void(0)" class="d-inline-block">Features</a></span>
                                            </div>
                                            <div class="menusub-dropdown collapse" id="menu-features">
                                                <ul class="menusub-ul">
                                                    <li class="menusub-li bst">
                                                        <span class="d-block ptb-10 psl-25 per-15"><a href="button.html" class="d-inline-block body-color">Button</a></span>
                                                    </li>
                                                    <li class="menusub-li bst">
                                                        <span class="d-block ptb-10 psl-25 per-15"><a href="cart-drawer-empty.html" class="d-inline-block body-color">Cart drawer empty</a></span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="menudrop-li bst">
                                            <div class="menu-btn d-flex flex-row-reverse">
                                                <button type="button" class="width-48 icon-16 ptb-10 bsl" data-bs-toggle="collapse" data-bs-target="#menu-policies" aria-expanded="false" aria-label="Menu accordion"><i class="ri-add-line d-block lh-1"></i></button>
                                                <span class="width-calc-48 ptb-10 psl-20 per-15"><a href="javascript:void(0)" class="d-inline-block">Policies</a></span>
                                            </div>
                                            <div class="menusub-dropdown collapse" id="menu-policies">
                                                <ul class="menusub-ul">
                                                    <li class="menusub-li bst">
                                                        <span class="d-block ptb-10 psl-25 per-15"><a href="cancellation.html" class="d-inline-block body-color">Cancellation</a></span>
                                                    </li>
                                                    <li class="menusub-li bst">
                                                        <span class="d-block ptb-10 psl-25 per-15"><a href="cookie.html" class="d-inline-block body-color">Cookie</a></span>
                                                    </li>
                                                    <li class="menusub-li bst">
                                                        <span class="d-block ptb-10 psl-25 per-15"><a href="legal.html" class="d-inline-block body-color">Legal</a></span>
                                                    </li>
                                                    <li class="menusub-li bst">
                                                        <span class="d-block ptb-10 psl-25 per-15"><a href="payment-policy.html" class="d-inline-block body-color">Payment policy</a></span>
                                                    </li>
                                                    <li class="menusub-li bst">
                                                        <span class="d-block ptb-10 psl-25 per-15"><a href="privacy-policy.html" class="d-inline-block body-color">Privacy policy</a></span>
                                                    </li>
                                                    <li class="menusub-li bst">
                                                        <span class="d-block ptb-10 psl-25 per-15"><a href="return-policy.html" class="d-inline-block body-color">Return policy</a></span>
                                                    </li>
                                                    <li class="menusub-li bst">
                                                        <span class="d-block ptb-10 psl-25 per-15"><a href="shipping-policy.html" class="d-inline-block body-color">Shipping policy</a></span>
                                                    </li>
                                                    <li class="menusub-li bst">
                                                        <span class="d-block ptb-10 psl-25 per-15"><a href="terms-condition.html" class="d-inline-block body-color">Terms & condition</a></span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="menu-li bst">
                                <div class="menu-btn d-flex flex-row-reverse">
                                    <button type="button" class="width-48 icon-16 ptb-10 bsl" data-bs-toggle="collapse" data-bs-target="#menu-blog" aria-expanded="false" aria-label="Menu accordion"><i class="ri-add-line d-block lh-1"></i></button>
                                    <span class="width-calc-48 ptb-10 plr-15"><a href="javascript:void(0)" class="d-inline-block">Blog</a></span>
                                </div>
                                <div class="menu-dropdown collapse" id="menu-blog">
                                    <ul class="menudrop-ul">
                                        <li class="menudrop-li bst">
                                            <span class="d-block ptb-10 psl-20 per-15"><a href="blog-without.html" class="d-inline-block body-color">Blog</a></span>
                                        </li>
                                        <li class="menudrop-li bst">
                                            <span class="d-block ptb-10 psl-20 per-15"><a href="blog.html" class="d-inline-block body-color">Blog left</a></span>
                                        </li>
                                        <li class="menudrop-li bst">
                                            <span class="d-block ptb-10 psl-20 per-15"><a href="blog-right.html" class="d-inline-block body-color">Blog right</a></span>
                                        </li>
                                        <li class="menudrop-li bst">
                                            <span class="d-block ptb-10 psl-20 per-15"><a href="article-without.html" class="d-inline-block body-color">Article</a></span>
                                        </li>
                                        <li class="menudrop-li bst">
                                            <span class="d-block ptb-10 psl-20 per-15"><a href="article.html" class="d-inline-block body-color">Article left</a></span>
                                        </li>
                                        <li class="menudrop-li bst">
                                            <span class="d-block ptb-10 psl-20 per-15"><a href="article-right.html" class="d-inline-block body-color">Article right</a></span>
                                        </li>
                                        <li class="menudrop-li bst">
                                            <span class="d-block ptb-10 psl-20 per-15"><a href="search-blog.html" class="d-inline-block body-color">Search blog</a></span>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="menu-li bst">
                                <div class="menu-btn d-flex">
                                    <span class="w-100 ptb-10 plr-15"><a href="{{ route('about') }}" class="d-inline-block body-color">About us</a></span>
                                </div>
                            </li>
                            <li class="menu-li bst">
                                <div class="menu-btn d-flex">
                                    <span class="w-100 ptb-10 plr-15"><a href="{{ route('contact') }}" class="d-inline-block body-color">Contact us</a></span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- mobile-menu end -->
        <!-- search-modal start -->
        <div class="search-modal modal fade" id="searchmodal">
            <div class="modal-dialog mw-100 m-0">
                <div class="modal-content body-bg border-0 rounded-0">
                    <div class="modal-body p-0">
                        <div class="container">
                            <div class="search-content ptb-30">
                                <div class="search-box d-flex flex-row-reverse">
                                    <button type="button" class="d-block search-close body-secondary-color icon-16" data-bs-dismiss="modal" aria-label="Close"><i class="ri-close-large-line d-block lh-1"></i></button>
                                    <form method="get" action="javascript:void(0)" class="search-form w-100">
                                        <div class="search-bar position-relative">
                                            <div class="form-search d-flex flex-row-reverse">
                                                <input type="search" name="search-input" class="search-input w-100 h-auto ptb-0 plr-15 bg-transparent border-0" value="" placeholder="Search here" required>
                                                <button type="submit" onclick="window.location.href='search-product.html'" class="d-block search-btn body-secondary-color icon-16" aria-label="Go to search" disabled><i class="ri-search-line d-block lh-1"></i></button>
                                            </div>
                                            <div class="d-none search-results position-absolute top-100 start-0 end-0 body-bg z-1 border-full border-radius box-shadow">
                                                <div class="search-for ptb-10 plr-15 beb">Search for <span class="search-text">a</span></div>
                                                <ul class="search-ul">
                                                    <li class="search-li ptb-5 plr-15 bst">
                                                        <a href="product.html" class="body-dominant-color d-flex flex-wrap align-items-center">
                                                            <span class="width-48"><img src="{{ asset('assets/images/search/search-product1.jpg') }}" class="w-100 img-fluid border-radius" alt="search-product1"></span>
                                                            <span class="width-calc-48 psl-15 text-truncate">Gleam band</span>
                                                        </a>
                                                    </li>
                                                    <li class="search-li ptb-5 plr-15 bst">
                                                        <a href="product.html" class="body-dominant-color d-flex flex-wrap align-items-center">
                                                            <span class="width-48"><img src="{{ asset('assets/images/search/search-product2.jpg') }}" class="w-100 img-fluid border-radius" alt="search-product2"></span>
                                                            <span class="width-calc-48 psl-15 text-truncate">Luxe loop</span>
                                                        </a>
                                                    </li>
                                                    <li class="search-li ptb-5 plr-15 bst">
                                                        <a href="product.html" class="body-dominant-color d-flex flex-wrap align-items-center">
                                                            <span class="width-48"><img src="{{ asset('assets/images/search/search-product3.jpg') }}" class="w-100 img-fluid border-radius" alt="search-product3"></span>
                                                            <span class="width-calc-48 psl-15 text-truncate">Opal stud</span>
                                                        </a>
                                                    </li>
                                                    <li class="search-li ptb-5 plr-15 bst">
                                                        <a href="product.html" class="body-dominant-color d-flex flex-wrap align-items-center">
                                                            <span class="width-48"><img src="{{ asset('assets/images/search/search-product4.jpg') }}" class="w-100 img-fluid border-radius" alt="search-product4"></span>
                                                            <span class="width-calc-48 psl-15 text-truncate">Ruby hoop</span>
                                                        </a>
                                                    </li>
                                                    <li class="search-li ptb-5 plr-15 bst">
                                                        <a href="product.html" class="body-dominant-color d-flex flex-wrap align-items-center">
                                                            <span class="width-48"><img src="{{ asset('assets/images/search/search-product5.jpg') }}" class="w-100 img-fluid border-radius" alt="search-product5"></span>
                                                            <span class="width-calc-48 psl-15 text-truncate">Pearl link</span>
                                                        </a>
                                                    </li>
                                                    <li class="search-li ptb-5 plr-15 bst">
                                                        <a href="product.html" class="body-dominant-color d-flex flex-wrap align-items-center">
                                                            <span class="width-48"><img src="{{ asset('assets/images/search/search-product6.jpg') }}" class="w-100 img-fluid border-radius" alt="search-product6"></span>
                                                            <span class="width-calc-48 psl-15 text-truncate">Gold bead</span>
                                                        </a>
                                                    </li>
                                                    <li class="search-li ptb-5 plr-15 bst">
                                                        <a href="product.html" class="body-dominant-color d-flex flex-wrap align-items-center">
                                                            <span class="width-48"><img src="{{ asset('assets/images/search/search-product7.jpg') }}" class="w-100 img-fluid border-radius" alt="search-product7"></span>
                                                            <span class="width-calc-48 psl-15 text-truncate">Sway drop</span>
                                                        </a>
                                                    </li>
                                                    <li class="search-li ptb-5 plr-15 bst">
                                                        <a href="product.html" class="body-dominant-color d-flex flex-wrap align-items-center">
                                                            <span class="width-48"><img src="{{ asset('assets/images/search/search-product8.jpg') }}" class="w-100 img-fluid border-radius" alt="search-product8"></span>
                                                            <span class="width-calc-48 psl-15 text-truncate">Star charm</span>
                                                        </a>
                                                    </li>
                                                    <li class="search-li ptb-5 plr-15 bst">
                                                        <a href="product.html" class="body-dominant-color d-flex flex-wrap align-items-center">
                                                            <span class="width-48"><img src="{{ asset('assets/images/search/search-product9.jpg') }}" class="w-100 img-fluid border-radius" alt="search-product9"></span>
                                                            <span class="width-calc-48 psl-15 text-truncate">Glim cuff</span>
                                                        </a>
                                                    </li>
                                                    <li class="search-li ptb-5 plr-15 bst">
                                                        <a href="product.html" class="body-dominant-color d-flex flex-wrap align-items-center">
                                                            <span class="width-48"><img src="{{ asset('assets/images/search/search-product10.jpg') }}" class="w-100 img-fluid border-radius" alt="search-product10"></span>
                                                            <span class="width-calc-48 psl-15 text-truncate">Jade bead</span>
                                                        </a>
                                                    </li>
                                                    <li class="search-li ptb-5 plr-15 bst">
                                                        <a href="product.html" class="body-dominant-color d-flex flex-wrap align-items-center">
                                                            <span class="width-48"><img src="{{ asset('assets/images/search/search-product11.jpg') }}" class="w-100 img-fluid border-radius" alt="search-product11"></span>
                                                            <span class="width-calc-48 psl-15 text-truncate">Twist bangle</span>
                                                        </a>
                                                    </li>
                                                    <li class="search-li ptb-5 plr-15 bst">
                                                        <a href="product.html" class="body-dominant-color d-flex flex-wrap align-items-center">
                                                            <span class="width-48"><img src="{{ asset('assets/images/search/search-product12.jpg') }}" class="w-100 img-fluid border-radius" alt="search-product12"></span>
                                                            <span class="width-calc-48 psl-15 text-truncate">Shiny choke</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                                <div class="search-more ptb-10 plr-15 bst"><a href="search-product.html" class="body-secondary-color text-decoration-underline">See all results (12)</a></div>
                                                <div class="search-fail ptb-10 plr-15">Search not found</div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="search-example-text mst-15">Trending search: a, e, rings...</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- search-modal end -->
        <!-- cart-drawer start -->
        <div class="cart-drawer position-fixed top-0 bottom-0 body-bg z-index-5 invisible box-shadow" id="cart-drawer">
            <form method="post" action="javascript:void(0)" class="drawer-contents d-flex flex-column">
                <div class="drawer-fixed-header ptb-10 plr-15 beb">
                    <div class="drawer-header d-flex align-items-center justify-content-between">
                        <h6 class="font-18">Cart</h6>
                        <div class="drawer-close">
                            <button type="button" class="drawer-close-btn body-secondary-color icon-16" aria-label="Close"><i class="ri-close-large-line d-block lh-1"></i></button>
                        </div>
                    </div>
                </div>
                <div class="drawer-cart-empty d-none h-100 ptb-30 plr-15">
                    <div class="drawer-scrollable h-100 d-flex flex-column align-items-center justify-content-center text-center">
                        <span class="secondary-color icon-32 meb-24"><i class="ri-shopping-bag-3-line d-block lh-1"></i></span>
                        <h2 class="font-24">Your cart is currently empty</h2>
                        <a href="collection.html" class="link-secondary-color mst-21">Continue shopping</a>
                    </div>
                </div>
                <div class="drawer-inner h-100 d-flex flex-column justify-content-between overflow-hidden">
                    <div class="drawer-scrollable h-100 overflow-auto">
                        <div class="cart-drawer-table plr-15">
                            <div class="cart-drawer-item-list">
                                <!-- AJAX dynamically pushes frontend.partials.cart_drawer_items into here -->
                            </div>
                        </div>

                    </div>
                    <div class="drawer-footer ptb-15 plr-15 bst">
                        <div class="cart-drawer-summary">
                            <div class="cart-drawer-summary-row">
                                <strong>Subtotal</strong>
                                <span class="cart-drawer-total subtotal-amount">0.00</span>
                            </div>
                            <div class="cart-drawer-note">Shipping, taxes, and discount codes are calculated at checkout.</div>
                        </div>
                        <div class="drawer-cart-checkout cart-drawer-checkout mst-12">
                            <div class="drawer-cart-box meb-11">
                                <label class="cust-checkbox-label checkbox-agree">
                                    <input type="checkbox" id="drawer-terms" name="drawer-terms" class="cust-checkbox checkboxbtn">
                                    <span class="d-block cust-check"></span>
                                    <span class="login-read">I have agree with the <a href="{{ route('terms.condition') }}" class="body-secondary-color text-decoration-underline">terms & conditions</a>.</span>
                                </label>
                            </div>
                            <div class="row btn-row15">
                                <div class="col-sm-6 col-12">
                                    <a href="{{ route('cart.page') }}" class="w-100 btn-style quaternary-btn">View cart</a>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <a href="{{ url('checkout') }}" class="w-100 btn-style secondary-btn checkout-btn-sidebar disabled">Checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- cart-drawer end -->
        <!-- bottom-menu start -->
        <div class="bottom-menu d-md-none position-sticky bottom-0 extra-bg z-1 box-shadow">
            <div class="bottom-menu-element d-flex flex-wrap align-items-center">
                <div class="col">
                    <a href="{{ url('/') }}" class="d-flex flex-column align-items-center ptb-10 text-center">
                        <span class="bottom-menu-icon heading-color icon-16"><i class="ri-home-8-line d-block lh-1"></i></span>
                        <span class="bottom-menu-title body-color font-10 mst-4 text-uppercase lh-1">Home</span>
                    </a>
                </div>
                <div class="col">
                    <a href="account.html" class="d-flex flex-column align-items-center ptb-10 text-center">
                        <span class="bottom-menu-icon heading-color icon-16"><i class="ri-user-3-line d-block lh-1"></i></span>
                        <span class="bottom-menu-title body-color font-10 mst-4 text-uppercase lh-1">Account</span>
                    </a>
                </div>
                <div class="col">
                    <a href="{{ route('products') }}" class="d-flex flex-column align-items-center ptb-10 text-center">
                        <span class="bottom-menu-icon heading-color icon-16"><i class="ri-layout-grid-line d-block lh-1"></i></span>
                        <span class="bottom-menu-title body-color font-10 mst-4 text-uppercase lh-1">Shop</span>
                    </a>
                </div>
                <div class="col">
                    <a href="{{ route('wishlist') }}" class="d-flex flex-column align-items-center ptb-10 text-center">
                        <span class="bottom-menu-icon-wrap position-relative per-7">
                            <span class="d-block bottom-menu-icon heading-color icon-16"><i class="ri-heart-line d-block lh-1"></i></span>
                            <span class="bottom-menu-counter wishlist-counter extra-color font-10 position-absolute end-0 dominant-bg d-flex align-items-center justify-content-center rounded-circle">0</span>
                        </span>
                        <span class="bottom-menu-title body-color font-10 mst-4 text-uppercase lh-1">Wishlist</span>
                    </a>
                </div>
                <div class="col">
                    <a href="javascript:void(0)" class="js-cart-drawer d-flex flex-column align-items-center ptb-10 text-center">
                        <span class="bottom-menu-icon-wrap position-relative per-7">
                            <span class="d-block bottom-menu-icon heading-color icon-16"><i class="ri-shopping-bag-3-line d-block lh-1"></i></span>
                            <span class="bottom-menu-counter cart-counter extra-color font-10 position-absolute end-0 dominant-bg d-flex align-items-center justify-content-center rounded-circle">0</span>
                        </span>
                        <span class="bottom-menu-title body-color font-10 mst-4 text-uppercase lh-1">Cart</span>
                    </a>
                </div>
            </div>
        </div>
        <!-- bottom-menu end -->
        <!-- bg-screen start -->
        <div class="bg-screen">
            <div class="bg-back position-fixed top-0 end-0 bottom-0 start-0 bg-black z-index-4 opacity-0 invisible"></div>
            <div class="bg-shop position-fixed top-0 end-0 bottom-0 start-0 bg-black z-index-4 opacity-0 invisible"></div>
        </div>
        <!-- bg-screen end -->
        <!-- back-to-top start -->
        <a href="javascript:void(0)" id="top" class="icon-16 secondary-btn position-fixed width-32 height-32 d-flex align-items-center justify-content-center z-1 opacity-0 invisible border-radius" aria-label="Back to top"><i class="ri-arrow-up-line d-block lh-1"></i></a>
        <!-- back-to-top end -->
