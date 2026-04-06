<!-- preloader start -->
        <div class="preloader position-fixed top-0 start-0 w-100 h-100 body-bg z-index-5">
            <div class="loader-img position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                <img src="{{ setting_asset('site_logo', 'assets/images/index2/logo.png') }}" class="width-96 width-xl-144 img-fluid" alt="logo">
            </div>
        </div>
        <!-- preloader end -->
        <!-- header start -->
        <header id="header" class="main-header">
            <!-- header-top start -->
            <div class="header-top-area">
                <!-- header-top-first start -->
                <div class="header-top-first ptb-15 ptb-xl-20 position-relative extra-bg">
                    <div class="container-fluid">
                        <div class="row align-items-center header-area">
                            <!-- header-icon start -->
                            <div class="col-3 col-sm-4 d-xl-none header-element header-icon">
                                <div class="header-icon-block">
                                    <ul class="ul-mt30 header-icon-element">
                                        <li class="header-icon-wrap toggler-wrap d-xl-none">
                                            <div class="header-icon-wrapper">
                                                <a href="javascript:void(0)" class="d-block header-icon-toggler toggler-btn" aria-label="Menu toggler button">
                                                    <span class="d-block header-block-icon dominant-link icon-16"><i class="ri-menu-line d-block lh-1"></i></span>
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- header-icon end -->
                            <!-- header-menu start -->
                            <div class="col-xl-5 d-none d-xl-block header-element header-menu">
                                <div class="mainmenu-content">
                                    <div class="main-wrap">
                                        <ul class="menu-ul d-flex flex-wrap">
                                            <li class="menu-li">
                                                <a href="{{ url('/') }}" class="menu-link font-16 d-flex align-items-center plr-10 plr-xxl-15">
                                                    <span class="menu-title text-uppercase heading-weight">Home</span>
                                                </a>
                                            </li>
                                            <li class="menu-li">
                                                <a href="{{ route('products') }}" class="menu-link font-16 d-flex align-items-center plr-10 plr-xxl-15">
                                                    <span class="menu-title text-uppercase heading-weight">Product</span>
                                                </a>
                                            </li>
                                            
                                            <li class="menu-li">
                                                <a href="{{ route('about') }}" class="menu-link font-16 d-flex align-items-center plr-10 plr-xxl-15 text-uppercase heading-weight">
                                                    About Us
                                                </a>
                                            </li>
                                            <li class="menu-li">
                                                <a href="{{ route('contact') }}" class="menu-link font-16 d-flex align-items-center plr-10 plr-xxl-15 text-uppercase heading-weight">
                                                    Contact Us
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- header-menu end -->
                            <!-- header-logo start -->
                            <div class="col-6 col-sm-4 col-xl-2 text-center header-element header-logo">
                                <div class="header-theme-logo">
                                    <a href="{{ url('/') }}" class="d-inline-block theme-logo">
                                        <img src="{{ setting_asset('site_logo', 'assets/images/index2/logo.png') }}" class="width-96 width-xl-144 img-fluid main-logo" alt="logo">
                                    </a>
                                </div>
                            </div>
                            <!-- header-logo end -->
                            <!-- header-icon start -->
                            <div class="col-3 col-sm-4 col-xl-5 header-element header-icon">
                                <div class="header-icon-block d-flex justify-content-end">
                                    <ul class="ul-mt30 flex-nowrap align-items-center header-icon-element">
                                        @auth
                                        <li class="header-icon-wrap user-wrap d-none d-md-block">
                                            <div class="header-icon-wrapper dropdown">
                                                <a href="javascript:void(0)" class="d-block header-icon-user" data-bs-toggle="dropdown" aria-label="User account">
                                                    <span class="d-block header-block-icon dominant-link icon-16"><i class="ri-user-3-line"></i></span>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-3 p-2 rounded-3" style="min-width: 180px;">
                                                    <li>
                                                        <div class="px-3 py-2">
                                                            <div class="fw-bold text-dark small text-truncate">{{ Auth::user()->name }}</div>
                                                            <div class="text-muted extra-small text-truncate" style="font-size: 11px;">{{ Auth::user()->email }}</div>
                                                        </div>
                                                    </li>
                                                    <li><hr class="dropdown-divider opacity-10"></li>
                                                    <li><a class="dropdown-item py-2 rounded-2" href="{{ route('profile') }}"><i class="ri-user-line me-2"></i>My Profile</a></li>
                                                    @if(Auth::user()->isAdmin())
                                                        <li><a class="dropdown-item py-2 rounded-2" href="{{ route('home') }}"><i class="ri-settings-4-line me-2"></i>Admin Panel</a></li>
                                                    @endif
                                                    <li><hr class="dropdown-divider opacity-10"></li>
                                                    <li>
                                                        <form action="{{ route('logout') }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="dropdown-item py-2 rounded-2 text-danger w-100 text-start border-0 bg-transparent">
                                                                <i class="ri-logout-box-r-line me-2"></i>Logout
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        @else
                                        <li class="header-icon-wrap user-wrap d-none d-md-block">
                                            <div class="header-icon-wrapper">
                                                <a href="{{ route('login') }}" class="d-block header-icon-user" aria-label="Login user">
                                                    <span class="d-block header-block-icon dominant-link icon-16"><i class="ri-user-3-line"></i></span>
                                                </a>
                                            </div>
                                        </li>
                                        @endauth
                                        <li class="header-icon-wrap wishlist-wrap d-none d-md-block">
                                            <div class="header-icon-wrapper">
                                                <a href="{{ route('wishlist') }}" class="d-block header-icon-wishlist">
                                                    <span class="header-block-icon-wrap dominant-link d-flex align-items-center">
                                                        <span class="header-block-icon icon-16"><i class="ri-heart-line"></i></span>
                                                        <span class="header-block-counter wishlist-counter dominant-color msl-4 heading-weight text-nowrap">0</span>
                                                    </span>
                                                </a>
                                            </div>
                                        </li>
                                        <li class="header-icon-wrap cart-wrap d-none d-md-block">
                                            <div class="header-icon-wrapper">
                                                <a href="javascript:void(0)" class="d-block header-icon-cart js-cart-drawer">
                                                    <span class="header-block-icon-wrap dominant-link d-flex align-items-center">
                                                        <span class="header-block-icon icon-16"><i class="ri-shopping-bag-3-line"></i></span>
                                                        <span class="header-block-counter cart-counter dominant-color msl-4 heading-weight text-nowrap">0</span>
                                                        <span class="d-none d-xl-block cart-total dominant-color msl-4 heading-weight text-nowrap">0.00</span>
                                                    </span>
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- header-icon end -->
                        </div>
                    </div>
                </div>
                <!-- header-top-first end -->
            </div>
            <!-- header-top end -->
        </header>
        <!-- header end -->
