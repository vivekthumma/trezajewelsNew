<div class="ap-info">
    <div class="ap-author ptb-30 plr-15 extra-bg text-center border-radius">
        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=D4AF37&color=fff" class="width-72 img-fluid rounded-circle" alt="customer-img">
        <div class="ap-ac mst-26">
            <h6 class="font-18">{{ $user->name }}</h6>
            <span class="d-inline-block mst-7">Joined {{ $user->created_at->format('jS M, Y') }}</span>
        </div>
    </div>
    <div class="ap-profile">
        <a href="{{ route('profile') }}" class="{{ Route::is('profile') ? 'dominant-color' : 'body-dominant-color' }} d-flex align-items-center justify-content-between ptb-15 plr-15">
            <span class="ap-icon {{ Route::is('profile') ? 'dominant-color' : 'body-color' }} icon-16 mer-5"><i class="ri-user-settings-line"></i></span>
            <span class="ap-name me-auto">Profile</span>
        </a>
        
        <a href="{{ route('profile.orders') }}" class="{{ Route::is('profile.orders') ? 'dominant-color' : 'body-dominant-color' }} d-flex align-items-center justify-content-between ptb-15 plr-15">
            <span class="ap-icon {{ Route::is('profile.orders') ? 'dominant-color' : 'body-color' }} icon-16 mer-5"><i class="ri-shopping-bag-3-line"></i></span>
            <span class="ap-name me-auto">Orders</span>
            {{-- <span class="ap-count extra-color font-12 d-flex align-items-center justify-content-center dominant-bg rounded-circle">3</span> --}}
        </a>
        <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="body-dominant-color d-flex align-items-center justify-content-between ptb-15 plr-15 bg-transparent border-0 w-100 text-start">
                <span class="ap-icon body-color icon-16 mer-5"><i class="ri-logout-box-line"></i></span>
                <span class="ap-name me-auto">Logout</span>
            </button>
        </form>
    </div>
</div>
