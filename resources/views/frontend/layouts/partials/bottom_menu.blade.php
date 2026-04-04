<!-- bottom-menu start -->
<div class="bottom-menu d-md-none position-fixed bottom-0 start-0 end-0 extra-bg z-index-4 box-shadow">
    <div class="bottom-menu-content ptb-10 plr-15">
        <ul class="d-flex flex-wrap align-items-center justify-content-between text-center">
            <li class="bottom-menu-wrap">
                <a href="{{ url('/') }}" class="d-block body-dominant-color icon-16" aria-label="Go to home"><i class="ri-home-line d-block lh-1"></i></a>
            </li>
            <li class="bottom-menu-wrap">
                <a href="{{ url('/products') }}" class="d-block body-dominant-color icon-16" aria-label="Go to collection"><i class="ri-shopping-bag-3-line d-block lh-1"></i></a>
            </li>
            <li class="bottom-menu-wrap">
                <a href="{{ route('wishlist') }}" class="d-block body-secondary-color icon-16 position-relative" aria-label="Wishlist">
                    <i class="ri-heart-line d-block lh-1"></i>
                    <span class="header-block-counter wishlist-counter dominant-bg extra-color border-radius position-absolute translate-middle-y top-0 start-100">{{ $wishlistCount ?? 0 }}</span>
                </a>
            </li>
            <li class="bottom-menu-wrap">
                <a href="{{ route('profile') }}" class="d-block body-dominant-color icon-16" aria-label="Go to profile"><i class="ri-user-3-line d-block lh-1"></i></a>
            </li>
        </ul>
    </div>
</div>
<!-- bottom-menu end -->
