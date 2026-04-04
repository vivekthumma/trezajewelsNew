<!-- header start -->
<header id="header" class="main-header">
    <div class="header-top-area">
        <!-- notification-bar start -->
        <div class="notification-bar ptb-13 dominant-bg">
            <div class="notification-marquee d-flex overflow-hidden">
                <div class="notification-marquee-row d-flex">
                    <div class="extra-color text-uppercase heading-weight text-nowrap">Enjoy an extra 25% off with code <span class="blinking">TREZA25</span>!</div>
                    <div class="extra-color text-uppercase heading-weight text-nowrap">Grab free shipping on orders over <span class="blinking">500</span>!</div>
                    <div class="extra-color text-uppercase heading-weight text-nowrap">Need-help: <a href="tel:+911234567890" class="extra-color">+91 123 456 7890</a></div>
                    <div class="extra-color text-uppercase heading-weight text-nowrap">Flat <span class="blinking">30% off</span> sitewide-shop now!</div>
                </div>
            </div>
        </div>
        
        <!-- header-top-first start -->
        <div class="header-top-first ptb-15 ptb-xl-20 position-relative extra-bg">
            <div class="container-fluid">
                <div class="row align-items-center header-area">
                    <!-- mobile menu toggler -->
                    <div class="col-3 col-sm-4 d-xl-none header-element header-icon">
                        <div class="header-icon-block">
                            <ul class="header-icon-element">
                                <li class="header-icon-wrap toggler-wrap">
                                    <div class="header-icon-wrapper">
                                        <a href="javascript:void(0)" class="d-block header-icon-toggler toggler-btn" aria-label="Menu toggler">
                                            <span class="d-block header-block-icon dominant-link icon-16"><i class="ri-menu-line d-block lh-1"></i></span>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- header-menu desktop -->
                    <div class="col-xl-5 d-none d-xl-block header-element header-menu">
                        <div class="mainmenu-content">
                            <ul class="menu-ul d-flex flex-wrap">
                                <li class="menu-li">
                                    <a href="{{ url('/') }}" class="menu-link font-16 plr-10 plr-xxl-15 text-uppercase heading-weight">Home</a>
                                </li>
                                <li class="menu-li position-relative">
                                    <a href="{{ route('products') }}" class="menu-link font-16 plr-10 plr-xxl-15 text-uppercase heading-weight">Collections <i class="ri-arrow-down-s-line font-14"></i></a>
                                    <div class="menu-dropdown collapse position-absolute top-auto start-0 end-0 extra-bg z-2 DropDownSlide box-shadow">
                                        <div class="container ptb-25">
                                            <div class="row row-cols-xl-4 text-start">
                                                @foreach($categories as $category)
                                                <div class="col">
                                                    <div class="shop-title">
                                                        <span class="d-block ptb-5 text-uppercase heading-weight">
                                                            <a href="{{ route('products', ['category' => $category->slug]) }}" class="dominant-link font-14">{{ $category->name }}</a>
                                                        </span>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="menu-li">
                                    <a href="{{ route('about') }}" class="menu-link font-16 plr-10 plr-xxl-15 text-uppercase heading-weight">About Us</a>
                                </li>
                                <li class="menu-li">
                                    <a href="{{ route('contact') }}" class="menu-link font-16 plr-10 plr-xxl-15 text-uppercase heading-weight">Contact</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- header-logo -->
                    <div class="col-6 col-sm-4 col-xl-2 text-center header-element header-logo">
                        <div class="header-theme-logo">
                            <a href="{{ url('/') }}" class="d-inline-block theme-logo">
                                <img src="{{ setting('site_logo') ? imgPath('settings/' . setting('site_logo')) : asset('frontend/images/index2/logo.png') }}" class="width-96 width-xl-144 img-fluid" alt="logo">
                            </a>
                        </div>
                    </div>

                    <!-- header-icons -->
                    <div class="col-3 col-sm-4 col-xl-5 header-element header-icon text-end">
                        <div class="header-icon-block d-flex justify-content-end align-items-center">
                            <ul class="header-icon-element d-flex align-items-center flex-nowrap list-unstyled mb-0">
                                <!-- Search -->
                                <li class="header-icon-wrap search-wrap d-none d-xxl-block me-3">
                                    <form method="get" action="{{ route('products') }}" class="search-form d-flex align-items-center border-bottom border-dark">
                                        <input type="search" name="search" class="bg-transparent border-0 font-14" placeholder="Find our item" value="{{ request('search') }}" style="outline:none; width: 120px;">
                                        <button type="submit" class="bg-transparent border-0 p-0 text-dark"><i class="ri-search-line"></i></button>
                                    </form>
                                </li>
                                <!-- User -->
                                <li class="header-icon-wrap user-wrap me-3 d-none d-md-block">
                                    <a href="{{ route('profile') }}" class="dominant-link icon-16" aria-label="Profile">
                                        <i class="ri-user-3-line"></i>
                                    </a>
                                </li>
                                <!-- Wishlist -->
                                <li class="header-icon-wrap wishlist-wrap me-3 d-none d-md-block">
                                    <a href="{{ route('wishlist') }}" class="dominant-link d-flex align-items-center" aria-label="Wishlist">
                                        <i class="ri-heart-line icon-16"></i>
                                        <span class="ms-1 heading-weight wishlist-counter">{{ $wishlistCount ?? 0 }}</span>
                                    </a>
                                </li>
                                <!-- Cart -->
                                <li class="header-icon-wrap cart-wrap">
                                    <a href="javascript:void(0)" class="dominant-link d-flex align-items-center js-cart-drawer" aria-label="Cart">
                                        <i class="ri-shopping-bag-3-line icon-16"></i>
                                        <span class="ms-1 heading-weight cart-counter">{{ $cartCount ?? 0 }}</span>
                                        <span class="ms-2 d-none d-xl-inline-block cart-total heading-weight">{{ number_format($cartSubtotal ?? 0, 2) }}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
