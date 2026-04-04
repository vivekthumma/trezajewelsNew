import axios from 'axios';

// CSRF configuration
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
const token = document.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
}

// Global state / Fetchers
const fetchCart = async () => {
    try {
        const res = await axios.get('/cart/get');
        if (res.data.success) {
            updateCartUI(res.data);
        }
    } catch (err) {
        console.error("Cart Fetch Error:", err);
    }
};

const updateCartUI = (data) => {
    const list = document.querySelector('.cart-drawer-item-list');
    const container = document.getElementById('main-cart-container');
    const counters = document.querySelectorAll('.cart-counter');
    const subtotals = document.querySelectorAll('.subtotal-amount, .cart-total');

    if (list) list.innerHTML = data.html;
    if (container) container.innerHTML = data.page_html;
    counters.forEach(el => el.textContent = data.cart_count);
    subtotals.forEach(el => el.textContent = '₹' + data.subtotal);
};

// Global state / Fetchers for Wishlist
const fetchWishlist = async () => {
    try {
        const res = await axios.get('/wishlist/count');
        if (res.data.success) {
            const counters = document.querySelectorAll('.wishlist-counter');
            counters.forEach(el => el.textContent = res.data.wishlist_count);
        }
    } catch (err) {
        console.error("Wishlist Fetch Error:", err);
    }
};

// Event Listeners (Delegation)
document.addEventListener('DOMContentLoaded', () => {
    // Sync cart & wishlist on load
    fetchCart();
    fetchWishlist();

    // 1. Quickview
    document.addEventListener('click', async (e) => {
        const btn = e.target.closest('.dynamic-quickview');
        if (!btn) return;
        e.preventDefault();

        const productId = btn.dataset.productId;
        const modalEl = document.getElementById('quickview-modal');
        const loader = document.getElementById('quickview-loader');
        const content = document.getElementById('quickview-data');

        if (typeof bootstrap !== 'undefined') {
            const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
            modal.show();
        }

        content.style.display = 'none';
        content.innerHTML = '';
        loader.style.display = 'block';

        try {
            const res = await axios.get(`/products/${productId}/quickview`);
            loader.style.display = 'none';
            content.innerHTML = res.data;
            content.style.display = 'block';

            // Swiper Re-init
            if (typeof Swiper !== 'undefined') {
                new Swiper(".swiper#quickview-slider-small", {
                    loop: false,
                    slidesPerView: 4,
                    spaceBetween: 15,
                    freeMode: true,
                    watchSlidesProgress: true
                });
                new Swiper(".swiper#quickview-slider-big", {
                    loop: false,
                    slidesPerView: 1,
                    spaceBetween: 0,
                    navigation: {
                        prevEl: ".swiper-prev-quickview-big",
                        nextEl: ".swiper-next-quickview-big"
                    }
                });
            }
        } catch (err) {
            loader.style.display = 'none';
            content.innerHTML = '<div class="alert alert-danger m-3">Failed to load product details.</div>';
            content.style.display = 'block';
        }
    });

    // 2. Add To Cart
    document.addEventListener('click', async (e) => {
        const btn = e.target.closest('.ajax-add-to-cart');
        if (!btn) return;
        e.preventDefault();

        const productId = btn.dataset.productId;
        const form = btn.closest('form');
        const qty = form ? (form.querySelector('.qty-num, .js-qty-num')?.value || 1) : 1;
        const size = form ? (form.querySelector('select[name$="size"]')?.value || null) : null;
        const color = form ? (form.querySelector('select[name$="color"]')?.value || null) : null;

        const iconBag = btn.querySelector('.product-bag-icon');
        const iconLoader = btn.querySelector('.product-loader-icon');
        const iconCheck = btn.querySelector('.product-check-icon');

        if (iconBag) iconBag.style.display = 'none';
        if (iconLoader) {
            iconLoader.classList.add('ri-spin');
            iconLoader.style.display = 'inline-block';
        }

        try {
            const res = await axios.post('/cart/add', { product_id: productId, quantity: qty, size: size, color: color });
            if (res.data.success) {
                fetchCart();
                if (iconLoader) iconLoader.style.display = 'none';
                if (iconCheck) iconCheck.style.display = 'inline-block';
                setTimeout(() => {
                    if (iconCheck) iconCheck.style.display = 'none';
                    if (iconBag) iconBag.style.display = 'inline-block';
                }, 2000);
            } else {
                alert(res.data.message || 'Error');
            }
        } catch (err) {
            alert('Error adding product.');
            if (iconLoader) iconLoader.style.display = 'none';
            if (iconBag) iconBag.style.display = 'inline-block';
        }
    });

    // 3. Wishlist
    document.addEventListener('click', async (e) => {
        const btn = e.target.closest('.add-to-wishlist');
        if (!btn) return;
        e.preventDefault();

        const productId = btn.dataset.productId;
        try {
            const res = await axios.post('/wishlist/toggle', { product_id: productId });
            if (res.data.success) {
                const icon = btn.querySelector('i');
                if (res.data.in_wishlist) {
                    icon.classList.replace('ri-heart-line', 'ri-heart-fill');
                    btn.classList.add('wishlist-active');
                } else {
                    icon.classList.replace('ri-heart-fill', 'ri-heart-line');
                    btn.classList.remove('wishlist-active');
                }
                const counters = document.querySelectorAll('.wishlist-counter');
                counters.forEach(c => c.textContent = res.data.wishlist_count);
            }
        } catch (err) {
            console.error('Wishlist error:', err);
        }
    });

    // Lazy Loading Images & Animations
    const lazyObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                if (img.dataset.src) {
                    img.src = img.dataset.src;
                    img.classList.add('loaded');
                }
                lazyObserver.unobserve(img);
            }
        });
    }, { rootMargin: '50px' });

    document.querySelectorAll('img[loading="lazy"], img.lazy-load').forEach(img => {
        lazyObserver.observe(img);
    });

    // Performance Optimization: Smooth Scrolling handled by CSS
});
