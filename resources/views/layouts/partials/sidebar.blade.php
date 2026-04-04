<!-- Main Sidebar Container -->
<aside class="app-sidebar shadow" data-bs-theme="dark" style="background-color: #1a1a1a !important;">
    <!-- Sidebar Brand -->
    <div class="sidebar-brand">
        <!-- Brand Link -->
        <a href="{{ route('home') }}" class="brand-link text-decoration-none d-flex align-items-center">
            <!-- Brand Image -->
            <img src="{{ setting_asset('site_logo', 'assets/images/index2/logo.png') }}" alt="Logo"
                class="brand-image img-circle elevation-3"
                style="opacity: .8; max-height: 33px; filter: brightness(0) invert(1);">
            <!-- Brand Text -->
            <span class="brand-text text-white ms-2">TREZA <b>JEWELS</b></span>
        </a>
    </div>
    <!-- Sidebar Brand -->

    <!-- Sidebar Menu -->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!-- Sidebar Menu -->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('home') }}"
                        class="nav-link {{ request()->is('home*') || request()->is('dashboard*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-header">MANAGEMENT</li>

                <li class="nav-item">
                    <a href="{{ route('categories.index') }}"
                        class="nav-link {{ request()->is('admin/categories*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tags"></i>
                        <p>Jewellery Categories</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('products.index') }}"
                        class="nav-link {{ request()->is('admin/products*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-box-open"></i>
                        <p>Jewellery Products</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('sliders.index') }}"
                        class="nav-link {{ request()->is('admin/sliders*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-images"></i>
                        <p>Homepage Sliders</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('home-sections.index') }}"
                        class="nav-link {{ request()->is('admin/home-sections*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Best Collection</p>
                    </a>
                </li>

                <li class="nav-header">SALES</li>

                <li class="nav-item">
                    <a href="{{ route('orders.index') }}"
                        class="nav-link {{ request()->is('admin/orders*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>Customer Orders</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('users.index') }}"
                        class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Registered Customers</p>
                    </a>
                </li>

                <li class="nav-header">CUSTOMER SERVICE</li>

                <li class="nav-item">
                    <a href="{{ route('admin.contact.index') }}"
                        class="nav-link {{ request()->is('admin/contact*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>Contact Inquiries</p>
                    </a>
                </li>

                <li class="nav-header">SYSTEM</li>

                <li class="nav-item">
                    <a href="{{ route('settings.index') }}"
                        class="nav-link {{ request()->is('admin/settings*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>Global Settings</p>
                    </a>
                </li>

            </ul>
            <!-- /.sidebar-menu -->
        </nav>
    </div>
    <!-- /.sidebar-wrapper -->
</aside>
<!-- /.app-sidebar -->