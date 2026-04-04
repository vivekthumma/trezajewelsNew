<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('landing');
Route::get('/home', [App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('home.frontend');
Route::get('/get-category-products/{categoryId}', [App\Http\Controllers\Frontend\HomeController::class, 'getCategoryProducts'])->name('get-category-products');

Route::get('/products', [App\Http\Controllers\Frontend\ProductController::class, 'index'])->name('products');
Route::get('/product/{id}', [App\Http\Controllers\Frontend\ProductController::class, 'show'])->name('products.show');
Route::get('/products/{id}/quickview', [App\Http\Controllers\Frontend\ProductController::class, 'quickview'])->name('products.quickview');
Route::get('/about-us', [App\Http\Controllers\Frontend\AboutController::class, 'index'])->name('about');
Route::get('/payment-policy', [App\Http\Controllers\Frontend\HomeController::class, 'paymentPolicy'])->name('payment.policy');
Route::get('/privacy-policy', [App\Http\Controllers\Frontend\HomeController::class, 'privacyPolicy'])->name('privacy.policy');
Route::get('/return-policy', [App\Http\Controllers\Frontend\HomeController::class, 'returnPolicy'])->name('return.policy');
Route::get('/shipping-policy', [App\Http\Controllers\Frontend\HomeController::class, 'shippingPolicy'])->name('shipping.policy');
Route::get('/terms-condition', [App\Http\Controllers\Frontend\HomeController::class, 'termsCondition'])->name('terms.condition');

// Contact Us Routes
Route::get('/contact-us', [App\Http\Controllers\Frontend\ContactController::class, 'index'])->name('contact');
Route::post('/contact-us', [App\Http\Controllers\Frontend\ContactController::class, 'store'])->name('contact.store');

// Cart Routes
Route::get('/cart', [App\Http\Controllers\Frontend\CartController::class, 'page'])->name('cart.page');
Route::post('/add-to-cart', [App\Http\Controllers\Frontend\CartController::class, 'addToCart'])->name('cart.add');
Route::get('/get-cart', [App\Http\Controllers\Frontend\CartController::class, 'getCart'])->name('cart.get');
Route::post('/update-cart-qty', [App\Http\Controllers\Frontend\CartController::class, 'updateQty'])->name('cart.update');
Route::post('/remove-cart-item', [App\Http\Controllers\Frontend\CartController::class, 'removeItem'])->name('cart.remove');
Route::post('/clear-cart', [App\Http\Controllers\Frontend\CartController::class, 'clear'])->name('cart.clear');
Route::get('/checkout', [App\Http\Controllers\Frontend\CheckoutController::class, 'index'])->name('checkout');
Route::post('/payments/razorpay/order', [App\Http\Controllers\Frontend\OrderController::class, 'createRazorpayOrder'])->name('payment.razorpay.order');
Route::post('/place-order', [App\Http\Controllers\Frontend\OrderController::class, 'placeOrder'])->name('order.place');
Route::get('/thank-you/{id}', [App\Http\Controllers\Frontend\OrderController::class, 'thankYou'])->name('thank-you');

// Wishlist Routes (guests + auth)
Route::get('/wishlist', [App\Http\Controllers\Frontend\WishlistController::class, 'index'])->name('wishlist');
Route::post('/wishlist/toggle', [App\Http\Controllers\Frontend\WishlistController::class, 'toggle'])->name('wishlist.toggle');
Route::post('/wishlist/remove', [App\Http\Controllers\Frontend\WishlistController::class, 'remove'])->name('wishlist.remove');
Route::post('/wishlist/clear', [App\Http\Controllers\Frontend\WishlistController::class, 'clear'])->name('wishlist.clear');
Route::get('/wishlist/count', [App\Http\Controllers\Frontend\WishlistController::class, 'getCount'])->name('wishlist.count');
Route::get('/wishlist/ids', [App\Http\Controllers\Frontend\WishlistController::class, 'getIds'])->name('wishlist.ids');

// Frontend Auth Routes
Route::get('/login', [App\Http\Controllers\Frontend\AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Frontend\AuthController::class, 'login']);
Route::get('/register', [App\Http\Controllers\Frontend\AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [App\Http\Controllers\Frontend\AuthController::class, 'register']);
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [App\Http\Controllers\Frontend\ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/orders', [App\Http\Controllers\Frontend\ProfileController::class, 'orders'])->name('profile.orders');
    Route::get('/order/{order_number}/track', [App\Http\Controllers\Frontend\OrderController::class, 'track'])->name('order.track');
    Route::post('/profile/update', [App\Http\Controllers\Frontend\ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [App\Http\Controllers\Frontend\ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::post('/logout', [App\Http\Controllers\Frontend\AuthController::class, 'logout'])->name('logout');
});

// Dedicated Admin Login Routes
Route::get('admin/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);

Auth::routes(['login' => false, 'register' => false, 'logout' => false]);

// Admin CRUD Routes
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    
    Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class)->except(['show']);
    Route::resource('sliders', App\Http\Controllers\Admin\SliderController::class);
    
    // Product Routes
    Route::post('products/upload-gallery', [App\Http\Controllers\Admin\ProductController::class, 'uploadGallery'])->name('products.upload-gallery');
    Route::post('products/remove-gallery-image', [App\Http\Controllers\Admin\ProductController::class, 'removeGalleryImage'])->name('products.remove-gallery-image');
    Route::resource('products', App\Http\Controllers\Admin\ProductController::class)->names([
        'show' => 'admin.products.show',
    ]);
    Route::resource('orders', App\Http\Controllers\Admin\OrderController::class)->only(['index', 'show', 'update', 'destroy']);
    Route::resource('users', App\Http\Controllers\Admin\UserController::class)->only(['index', 'show', 'destroy']);
    Route::get('/contact', [App\Http\Controllers\Admin\ContactController::class, 'index'])->name('admin.contact.index');
    Route::get('/contact/{id}', [App\Http\Controllers\Admin\ContactController::class, 'show'])->name('admin.contact.show');
    Route::delete('/contact/{id}', [App\Http\Controllers\Admin\ContactController::class, 'destroy'])->name('admin.contact.destroy');
    Route::get('/settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::resource('home-sections', App\Http\Controllers\Admin\HomeCategorySectionController::class);
    Route::post('/settings/update', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
});

