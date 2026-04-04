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
                            <span class="width-calc-48 ptb-10 plr-15"><a href="{{ url('/') }}" class="d-inline-block body-color">Home</a></span>
                        </div>
                    </li>
                    <li class="menu-li bst">
                        <div class="menu-btn d-flex flex-row-reverse">
                            <button type="button" class="width-48 icon-16 ptb-10 bsl" data-bs-toggle="collapse" data-bs-target="#menu-product-mobile" aria-expanded="false" aria-label="Menu accordion"><i class="ri-add-line d-block lh-1"></i></button>
                            <span class="width-calc-48 ptb-10 plr-15"><a href="{{ route('products') }}" class="d-inline-block">Collections</a></span>
                        </div>
                        <div class="menu-dropdown collapse" id="menu-product-mobile">
                            <ul class="menudrop-ul">
                                @foreach($categories as $category)
                                <li class="menudrop-li bst">
                                    <span class="d-block ptb-10 psl-20 per-15"><a href="{{ route('products', ['category' => $category->slug]) }}" class="d-inline-block body-color">{{ $category->name }}</a></span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                    <li class="menu-li bst">
                        <div class="menu-btn d-flex flex-row-reverse">
                            <span class="width-calc-48 ptb-10 plr-15"><a href="{{ route('about') }}" class="d-inline-block body-color">About Us</a></span>
                        </div>
                    </li>
                    <li class="menu-li bst">
                        <div class="menu-btn d-flex flex-row-reverse">
                            <span class="width-calc-48 ptb-10 plr-15"><a href="{{ route('contact') }}" class="d-inline-block body-color">Contact Us</a></span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- mobile-menu end -->
