/**
 * HOME PAGE - SWIPER SLIDER INITIALIZATION
 * Modern Jewelry Store - Treza Jewels
 */

document.addEventListener('DOMContentLoaded', function() {
    // Initialize Home Slider
    if (document.getElementById('home-slider')) {
        const homeSlider = new Swiper('#home-slider', {
            loop: true,
            autoplay: {
                delay: 6000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination-homeslider',
                clickable: true,
                dynamicBullets: true,
            },
            navigation: {
                prevEl: '.swiper-prev-homeslider',
                nextEl: '.swiper-next-homeslider',
            },
            /* speed: 1000, */
            speed: 1000,
            on: {
                init: function() {
                    console.log('Home slider initialized');
                },
            },
        });
    }

    // Add hover effects to product cards
    const productCards = document.querySelectorAll('.product-card');
    productCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.boxShadow = '0 10px 28px rgba(0, 0, 0, 0.15)';
        });
        card.addEventListener('mouseleave', function() {
            this.style.boxShadow = '0 2px 8px rgba(0, 0, 0, 0.08)';
        });
    });

    // Add hover effects to category cards
    const categoryCards = document.querySelectorAll('.category-card');
    categoryCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.boxShadow = '0 12px 32px rgba(201, 169, 97, 0.2)';
        });
        card.addEventListener('mouseleave', function() {
            this.style.boxShadow = '0 2px 8px rgba(0, 0, 0, 0.08)';
        });
    });

    // Animate elements on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -100px 0px',
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observe animated elements
    document.querySelectorAll('[data-animate]').forEach(el => {
        /* el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'all 0.6s ease'; */
        observer.observe(el);
    });
});
