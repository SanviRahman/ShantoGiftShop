@extends('home.layout')

@section('title', 'Home - ShantoGiftShop')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container hero-container">
        <!-- Sidebar Categories -->
        <aside class="sidebar">
            <ul>
                @forelse($sidebarCategories as $category)
                    <li>
                        <a href="{{ route('products.index', ['category' => $category->slug]) }}">
                            {{ $category->name }}
                            @if($category->children->count())
                                <i class="fas fa-chevron-right"></i>
                            @endif
                        </a>
                    </li>
                @empty
                    <li><a href="#">No Category Found</a></li>
                @endforelse
            </ul>
        </aside>

        <!-- Hero Banner -->
        <div class="hero-banner">
            <div class="banner-content">
                <div class="brand-row">
                    <i class="fab fa-apple"></i>
                    <span>iPhone 14 Series</span>
                </div>
                <h2>Up to 10% <br> off Voucher</h2>
                <a href="{{ route('products.index') }}" class="shop-now-btn">
                    Shop Now <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="banner-image">
                <div class="slider-track">
                    <img src="https://images.unsplash.com/photo-1678652197831-2d180705cd2c?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                        alt="iPhone 14 - 1">
                    <img src="https://images.unsplash.com/photo-1512496015851-a90fb38ba796?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                        alt="iPhone 14 - 2">
                    <img src="https://images.unsplash.com/photo-1678652197831-2d180705cd2c?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                        alt="iPhone 14 - 3">
                    <img src="https://images.unsplash.com/photo-1503602642458-232111445657?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                        alt="iPhone 14 - 4">
                    <img src="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                        alt="iPhone 14 - 5">
                </div>
            </div>

            <!-- Pagination Dots -->
            <div class="pagination-dots">
                <span class="dot active"></span>
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
            </div>
        </div>
    </div>
</section>

<!-- Flash Sales Section -->
<section class="flash-sales-section">
    <div class="container">
        <!-- Section Header -->
        <div class="section-header">
            <div class="today-tag">
                <span class="red-block"></span>
                <span class="tag-text">Today's</span>
            </div>

            <div class="flash-sales-row">
                <div class="title-timer">
                    <h2>Flash Sales</h2>
                    <div class="countdown">
                        <div class="time-unit">
                            <span class="label">Days</span>
                            <span class="value">03</span>
                        </div>
                        <span class="separator">:</span>
                        <div class="time-unit">
                            <span class="label">Hours</span>
                            <span class="value">23</span>
                        </div>
                        <span class="separator">:</span>
                        <div class="time-unit">
                            <span class="label">Minutes</span>
                            <span class="value">19</span>
                        </div>
                        <span class="separator">:</span>
                        <div class="time-unit">
                            <span class="label">Seconds</span>
                            <span class="value">56</span>
                        </div>
                    </div>
                </div>

                <div class="nav-arrows">
                    <button class="arrow-btn"><i class="fas fa-arrow-left"></i></button>
                    <button class="arrow-btn"><i class="fas fa-arrow-right"></i></button>
                </div>
            </div>
        </div>

        <!-- Product List -->
        <div class="product-list">
            @forelse($flashSales as $product)
                @include('partials.home-product-card', ['product' => $product, 'showDiscount' => true])
            @empty
                <p>No flash sale product found.</p>
            @endforelse
        </div>

        <!-- View All Button -->
        <div class="view-all-container">
            <a href="{{ route('products.index') }}" class="view-all-btn">View All Products</a>
        </div>

        <hr class="section-divider">
    </div>
</section>

<!-- Categories Section -->
<section class="categories-section">
    <div class="container">
        <!-- Section Header -->
        <div class="section-header">
            <div class="today-tag">
                <span class="red-block"></span>
                <span class="tag-text">Categories</span>
            </div>
            <div class="section-title-row">
                <h2>Available Categories</h2>
            </div>
        </div>

        <!-- Categories Grid -->
        <div class="categories-grid">
            @forelse($homeCategories as $category)
                <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="category-card">
                    <i class="{{ $category->icon_class ?? 'fas fa-tag' }}"></i>
                    <span>{{ $category->name }}</span>
                </a>
            @empty
                <p>No categories found.</p>
            @endforelse
        </div>

        <hr class="section-divider">
    </div>
</section>

<!-- Best Selling Products Section -->
<section class="best-selling-section">
    <div class="container">
        <!-- Section Header -->
        <div class="section-header">
            <div class="today-tag">
                <span class="red-block"></span>
                <span class="tag-text">This Month</span>
            </div>
            <div class="best-selling-row">
                <h2>Best Selling Products</h2>
                <a href="{{ route('products.index') }}" class="view-all-btn-small">View All</a>
            </div>
        </div>

        <!-- Product List -->
        <div class="product-list">
            @forelse($bestSellers as $product)
                @include('partials.home-product-card', ['product' => $product, 'showDiscount' => false])
            @empty
                <p>No best selling product found.</p>
            @endforelse
        </div>
    </div>
</section>

<!-- Music Experience Banner Section -->
<section class="music-banner-section">
    <div class="container">
        <div class="music-banner">
            <div class="music-content">
                <span class="category-label">Categories</span>
                <h2>Enhance Your <br> Music Experience</h2>

                <div class="music-countdown">
                    <div class="circle-timer">
                        <span class="number">05</span>
                        <span class="unit">Days</span>
                    </div>
                    <div class="circle-timer">
                        <span class="number">23</span>
                        <span class="unit">Hours</span>
                    </div>
                    <div class="circle-timer">
                        <span class="number">59</span>
                        <span class="unit">Minutes</span>
                    </div>
                    <div class="circle-timer">
                        <span class="number">35</span>
                        <span class="unit">Seconds</span>
                    </div>
                </div>

                <a href="{{ route('products.index') }}" class="buy-now-btn-green">Buy Now!</a>
            </div>

            <div class="music-image">
                <div class="image-glow"></div>
                <img src="{{ asset('images/jbl.png') }}" alt="JBL Speaker" style="object-fit: contain;">
            </div>
        </div>
    </div>
</section>

<!-- Explore Our Products Section -->
<section class="explore-products-section">
    <div class="container">
        <!-- Section Header -->
        <div class="section-header">
            <div class="today-tag">
                <span class="red-block"></span>
                <span class="tag-text">Our Products</span>
            </div>
            <div class="section-title-row">
                <h2>Explore Our Products</h2>
                <div class="nav-arrows">
                    <button class="arrow-btn"><i class="fas fa-arrow-left"></i></button>
                    <button class="arrow-btn"><i class="fas fa-arrow-right"></i></button>
                </div>
            </div>
        </div>

        <!-- Product Grid -->
        <div class="product-grid-explore">
            @forelse($exploreProducts as $product)
                @include('partials.home-product-card', ['product' => $product, 'showDiscount' => false])
            @empty
                <p>No product found.</p>
            @endforelse
        </div>

        <!-- View All Button -->
        <div class="view-all-container">
            <a href="{{ route('products.index') }}" class="view-all-btn">View All Products</a>
        </div>
    </div>
</section>

<!-- New Arrival Section -->
<section class="new-arrival-section">
    <div class="container">
        <!-- Section Header -->
        <div class="section-header">
            <div class="today-tag">
                <span class="red-block"></span>
                <span class="tag-text">Featured</span>
            </div>
            <h2>New Arrival</h2>
        </div>

        <!-- Bento Grid -->
        <div class="new-arrival-grid">
            <div class="grid-item item-large">
                <img src="https://images.unsplash.com/photo-1606813907291-d86efa9b94db?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                    alt="PlayStation 5">
                <div class="item-content">
                    <h3>PlayStation 5</h3>
                    <p>Black and White version of the PS5 coming out on sale.</p>
                    <a href="{{ route('products.index') }}" class="shop-now-link">Shop Now</a>
                </div>
            </div>

            <div class="grid-column-right">
                @if(isset($featuredProducts[0]))
                    <div class="grid-item item-wide">
                        <img src="{{ $featuredProducts[0]->image_url }}" alt="{{ $featuredProducts[0]->title }}">
                        <div class="item-content">
                            <h3>{{ $featuredProducts[0]->title }}</h3>
                            <p>{{ $featuredProducts[0]->short_description }}</p>
                            <a href="{{ route('products.show', $featuredProducts[0]) }}" class="shop-now-link">Shop Now</a>
                        </div>
                    </div>
                @endif

                <div class="grid-row-bottom">
                    @if(isset($featuredProducts[1]))
                        <div class="grid-item item-small">
                            <img src="{{ $featuredProducts[1]->image_url }}" alt="{{ $featuredProducts[1]->title }}">
                            <div class="item-content">
                                <h3>{{ $featuredProducts[1]->title }}</h3>
                                <p>{{ $featuredProducts[1]->short_description }}</p>
                                <a href="{{ route('products.show', $featuredProducts[1]) }}" class="shop-now-link">Shop Now</a>
                            </div>
                        </div>
                    @endif

                    @if(isset($featuredProducts[2]))
                        <div class="grid-item item-small">
                            <img src="{{ $featuredProducts[2]->image_url }}" alt="{{ $featuredProducts[2]->title }}">
                            <div class="item-content">
                                <h3>{{ $featuredProducts[2]->title }}</h3>
                                <p>{{ $featuredProducts[2]->short_description }}</p>
                                <a href="{{ route('products.show', $featuredProducts[2]) }}" class="shop-now-link">Shop Now</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="services-section">
    <div class="container">
        <div class="services-grid">
            <div class="service-item">
                <div class="service-icon-outer">
                    <div class="service-icon-inner">
                        <i class="fas fa-truck-fast"></i>
                    </div>
                </div>
                <h3>FREE AND FAST DELIVERY</h3>
                <p>Free delivery for all orders over $140</p>
            </div>

            <div class="service-item">
                <div class="service-icon-outer">
                    <div class="service-icon-inner">
                        <i class="fas fa-headset"></i>
                    </div>
                </div>
                <h3>24/7 CUSTOMER SERVICE</h3>
                <p>Friendly 24/7 customer support</p>
            </div>

            <div class="service-item">
                <div class="service-icon-outer">
                    <div class="service-icon-inner">
                        <i class="fas fa-shield-halved"></i>
                    </div>
                </div>
                <h3>MONEY BACK GUARANTEE</h3>
                <p>We return money within 30 days</p>
            </div>
        </div>
    </div>
</section>

<!-- Scroll to Top Button -->
<a href="#" class="scroll-to-top">
    <i class="fas fa-arrow-up"></i>
</a>

<script>
// JS for Banner Slider
(function() {
    const track = document.querySelector('.banner-image .slider-track');
    const slides = track ? Array.from(track.querySelectorAll('img')) : [];
    const dotsContainer = document.querySelector('.pagination-dots');
    const dots = dotsContainer ? Array.from(dotsContainer.querySelectorAll('.dot')) : [];
    if (!track || slides.length === 0) return;

    let index = 0,
        count = slides.length,
        timer = null,
        interval = 2600;

    if (dots.length !== count && dotsContainer) {
        dotsContainer.innerHTML = '';
        for (let i = 0; i < count; i++) {
            const span = document.createElement('span');
            span.className = 'dot' + (i === 0 ? ' active' : '');
            dotsContainer.appendChild(span);
        }
    }

    const getDots = () => Array.from(document.querySelectorAll('.pagination-dots .dot'));

    function updateActiveDot() {
        getDots().forEach((d, i) => d.classList.toggle('active', i === index));
    }

    function goTo(i) {
        index = (i + count) % count;
        track.style.transform = `translateX(-${index * 100}%)`;
        updateActiveDot();
    }

    getDots().forEach((d, i) => d.addEventListener('click', () => {
        stop();
        goTo(i);
        start();
    }));

    function next() {
        goTo(index + 1);
    }

    function start() {
        stop();
        timer = setInterval(next, interval);
    }

    function stop() {
        if (timer) clearInterval(timer);
        timer = null;
    }

    const hero = document.querySelector('.hero-banner');
    if (hero) {
        hero.addEventListener('mouseenter', stop);
        hero.addEventListener('mouseleave', start);
    }

    start();
})();

// Flash Sales Countdown & Slider
(function() {
    const countdownDate = new Date();
    countdownDate.setDate(countdownDate.getDate() + 3);

    function updateTimer() {
        const now = new Date().getTime();
        const distance = countdownDate - now;

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        const timeUnits = document.querySelectorAll('.flash-sales-row .time-unit .value');
        if (timeUnits.length === 4) {
            timeUnits[0].innerText = days < 10 ? '0' + days : days;
            timeUnits[1].innerText = hours < 10 ? '0' + hours : hours;
            timeUnits[2].innerText = minutes < 10 ? '0' + minutes : minutes;
            timeUnits[3].innerText = seconds < 10 ? '0' + seconds : seconds;
        }
    }

    setInterval(updateTimer, 1000);
    updateTimer();

    const productList = document.querySelector('.flash-sales-section .product-list');
    const leftArrow = document.querySelector('.flash-sales-row .nav-arrows .arrow-btn:first-child');
    const rightArrow = document.querySelector('.flash-sales-row .nav-arrows .arrow-btn:last-child');

    if (productList && leftArrow && rightArrow) {
        rightArrow.addEventListener('click', () => {
            productList.scrollBy({
                left: 270,
                behavior: 'smooth'
            });
        });

        leftArrow.addEventListener('click', () => {
            productList.scrollBy({
                left: -270,
                behavior: 'smooth'
            });
        });
    }

    // Music Banner Countdown
    (function() {
        const musicCountdownDate = new Date();
        musicCountdownDate.setDate(musicCountdownDate.getDate() + 5);

        function updateMusicTimer() {
            const now = new Date().getTime();
            const distance = musicCountdownDate - now;

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            const timerNumbers = document.querySelectorAll('.music-countdown .circle-timer .number');

            if (timerNumbers.length === 4) {
                timerNumbers[0].innerText = days < 10 ? '0' + days : days;
                timerNumbers[1].innerText = hours < 10 ? '0' + hours : hours;
                timerNumbers[2].innerText = minutes < 10 ? '0' + minutes : minutes;
                timerNumbers[3].innerText = seconds < 10 ? '0' + seconds : seconds;
            }
        }

        setInterval(updateMusicTimer, 1000);
        updateMusicTimer();
    })();

    // Explore Products Slider Navigation
    const exploreGrid = document.querySelector('.explore-products-section .product-grid-explore');
    const exploreLeftArrow = document.querySelector(
        '.explore-products-section .section-header .nav-arrows .arrow-btn:first-child'
    );
    const exploreRightArrow = document.querySelector(
        '.explore-products-section .section-header .nav-arrows .arrow-btn:last-child'
    );

    if (exploreGrid && exploreLeftArrow && exploreRightArrow) {
        exploreRightArrow.addEventListener('click', () => {
            exploreGrid.scrollBy({
                left: 270,
                behavior: 'smooth'
            });
        });

        exploreLeftArrow.addEventListener('click', () => {
            exploreGrid.scrollBy({
                left: -270,
                behavior: 'smooth'
            });
        });
    }
})();
</script>
@push('styles')
<style>
/* Hero Section */
.hero-section {
    padding-top: 40px;
}

.hero-container {
    display: flex;
}

/* Sidebar */
.sidebar {
    width: 217px;
    border-right: 1px solid #D9D9D9;
    /* Divider line */
    padding-right: 16px;
    margin-right: 45px;
}

.sidebar ul li {
    margin-bottom: 16px;
}

.sidebar ul li a {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 14px;
    color: #000;
    transition: color 0.3s;
}

.sidebar ul li a:hover {
    color: #DB4444;
}

/* Hero Banner */
.hero-banner {
    flex: 1;
    background-color: #000;
    color: #FAFAFA;
    display: flex;
    align-items: center;
    padding: 0 64px;
    position: relative;
    overflow: hidden;
    height: 344px;
    /* Fixed height for banner */
}

.banner-content {
    z-index: 2;
    max-width: 50%;
}

.brand-row {
    display: flex;
    align-items: center;
    gap: 24px;
    margin-bottom: 20px;
}

.brand-row i {
    font-size: 40px;
}

.brand-row span {
    font-size: 16px;
}

.hero-banner h2 {
    font-size: 48px;
    font-weight: 600;
    line-height: 60px;
    letter-spacing: 0.04em;
    margin-bottom: 22px;
}

.shop-now-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 16px;
    font-weight: 500;
    border-bottom: 1px solid #FAFAFA;
    padding-bottom: 4px;
    color: #FAFAFA;
}

.banner-image {
    position: absolute;
    right: 0;
    top: 50%;
    transform: translateY(-50%);
    width: 50%;
    overflow: hidden;
}

.banner-image img {
    max-width: 100%;
    height: auto;
    object-fit: cover;
}

/* Pagination Dots */
.pagination-dots {
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 12px;
}

.dot {
    width: 12px;
    height: 12px;
    background-color: rgba(255, 255, 255, 0.5);
    border-radius: 50%;
    cursor: pointer;
}

.dot.active {
    background-color: #DB4444;
    /* Red active dot */
    border: 2px solid #fff;
    /* White border for active dot */
}


.slider-track {
    display: flex;
    width: 100%;
    height: 100%;
    transition: transform 0.6s ease;
}

.slider-track img {
    flex: 0 0 100%;
    display: block;
}





/*  Flash Sales Section  */

.flash-sales-section {
    padding-top: 140px;
    padding-bottom: 60px;
}

.section-header {
    margin-bottom: 40px;
}

.today-tag {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 24px;
}

.red-block {
    width: 20px;
    height: 40px;
    background-color: #DB4444;
    border-radius: 4px;
}

.tag-text {
    font-size: 16px;
    font-weight: 600;
    color: #DB4444;
}

.flash-sales-row {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
}

.title-timer {
    display: flex;
    align-items: flex-end;
    gap: 87px;
}

.title-timer h2 {
    font-size: 36px;
    font-weight: 600;
    letter-spacing: 0.04em;
    line-height: 1.2;
}

.countdown {
    display: flex;
    align-items: center;
    gap: 17px;
    margin-bottom: 4px;
    /* Align visually with text */
}

.time-unit {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.time-unit .label {
    font-size: 12px;
    font-weight: 500;
}

.time-unit .value {
    font-size: 32px;
    font-weight: 700;
    line-height: 30px;
    letter-spacing: 0.04em;
}

.separator {
    color: #E07575;
    font-size: 24px;
    font-weight: 600;
    margin-top: 15px;
    /* Adjust to align with numbers */
}

.nav-arrows {
    display: flex;
    gap: 8px;
}

.arrow-btn {
    width: 46px;
    height: 46px;
    border-radius: 50%;
    background-color: #F5F5F5;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s;
}

.arrow-btn i {
    font-size: 16px;
}

.arrow-btn:hover {
    background-color: #E0E0E0;
}

/* Product List Grid */
.product-list {
    display: flex;
    gap: 30px;
    margin-bottom: 60px;
    overflow-x: auto;
    /* Allow scrolling */
    scroll-behavior: smooth;
    /* Smooth scrolling */
    padding-bottom: 10px;
    scrollbar-width: none;
    /* Hide scrollbar Firefox */
}

.product-list::-webkit-scrollbar {
    display: none;
    /* Hide scrollbar Chrome/Safari */
}

.product-card {
    min-width: 270px;
    /* Ensure fixed width for cards in slider */
    display: flex;
    flex-direction: column;
    gap: 16px;
}






.card-header {
    position: relative;
    background-color: #F5F5F5;
    height: 250px;
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    /* For the button slide up */
}

.card-header img {
    max-width: 80%;
    max-height: 80%;
    object-fit: contain;
}

.discount-badge {
    position: absolute;
    top: 12px;
    left: 12px;
    background-color: #DB4444;
    color: #fff;
    font-size: 12px;
    padding: 4px 12px;
    border-radius: 4px;
}

.card-icons {
    position: absolute;
    top: 12px;
    right: 12px;
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.card-icons button {
    width: 34px;
    height: 34px;
    border-radius: 50%;
    background-color: #fff;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    transition: all 0.3s;
}

.card-icons button:hover {
    background-color: #DB4444;
    color: #fff;
}

.add-to-cart-btn {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    background-color: #000;
    color: #fff;
    border: none;
    padding: 10px 0;
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
    transform: translateY(100%);
    /* Hidden by default */
    transition: transform 0.3s ease;
}

.card-header:hover .add-to-cart-btn {
    transform: translateY(0);
    /* Slide up on hover */
}

.card-details {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.product-name {
    font-size: 16px;
    font-weight: 500;
}

.price {
    display: flex;
    gap: 12px;
    font-size: 16px;
    font-weight: 500;
}

.current-price {
    color: #DB4444;
}

.original-price {
    color: #7D8184;
    /* Gray color */
    text-decoration: line-through;
}

.rating {
    display: flex;
    align-items: center;
    gap: 8px;
}

.stars {
    color: #FFAD33;
    /* Star color */
    font-size: 14px;
}

.review-count {
    font-size: 14px;
    font-weight: 600;
    color: #7D8184;
    /* Gray color */
}

/* View All Button */
.view-all-container {
    text-align: center;
    margin-bottom: 60px;
}

.view-all-btn {
    background-color: #DB4444;
    color: #fff;
    padding: 16px 48px;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.3s;
}

.view-all-btn:hover {
    background-color: #E07575;
}

.section-divider {
    border: none;
    border-top: 1px solid #D9D9D9;
    /* Light gray line */
    opacity: 0.3;
    /* Make it subtle */
}








/* Categories Section */
.categories-section {
    padding-top: 80px;
    padding-bottom: 70px;
}

.section-title-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.section-title-row h2 {
    font-size: 36px;
    font-weight: 600;
    letter-spacing: 0.04em;
}

/* Categories Grid */
.categories-grid {
    display: flex;
    justify-content: space-between;
    gap: 30px;
    margin-bottom: 70px;
    margin-top: 60px;
}

.category-card {
    width: 170px;
    height: 145px;
    border: 1px solid rgba(0, 0, 0, 0.3);
    border-radius: 4px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 16px;
    cursor: pointer;
    transition: all 0.3s;
}

.category-card i {
    font-size: 56px;
    /* font-weight: 300; Removed to fix icon rendering issue */
}

.category-card span {
    font-size: 16px;
    font-weight: 400;
}

.category-card:hover {
    background-color: #DB4444;
    color: #fff;
    border: 1px solid #DB4444;
}

.category-card.active {
    background-color: #DB4444;
    color: #fff;
    border: 1px solid #DB4444;
}

.view-all-container {
    text-align: center;
    margin-bottom: 60px;
}

.view-all-btn {
    background-color: #DB4444;
    color: #fff;
    padding: 16px 48px;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.3s;
}

.view-all-btn:hover {
    background-color: #E07575;
}

.section-divider {
    border: none;
    border-top: 1px solid #D9D9D9;
    /* Light gray line */
    opacity: 0.3;
    /* Make it subtle */
}






/* Best Selling Products Section */
.best-selling-section {
    padding-bottom: 60px;
}

.best-selling-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 40px;
    /* Reduced margin to match design */
}

.best-selling-row h2 {
    font-size: 36px;
    font-weight: 600;
    letter-spacing: 0.04em;
}

.view-all-btn-small {
    background-color: #DB4444;
    color: #fff;
    padding: 16px 48px;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.3s;
}

.view-all-btn-small:hover {
    background-color: #E07575;
}





/* Music Experience Banner Section */
.music-banner-section {
    padding: 40px 0;
    margin-bottom: 70px;
}

.music-banner {
    background-color: #000;
    color: #fff;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 70px;
    border-radius: 4px;
    position: relative;
    overflow: hidden;
}

.music-content {
    flex: 1;
    z-index: 2;
}

.category-label {
    color: #00FF66;
    /* Bright Green */
    font-size: 16px;
    font-weight: 600;
    display: block;
    margin-bottom: 32px;
}

.music-content h2 {
    font-size: 48px;
    font-weight: 600;
    line-height: 60px;
    letter-spacing: 0.04em;
    margin-bottom: 32px;
}

.music-countdown {
    display: flex;
    gap: 24px;
    margin-bottom: 40px;
}

.circle-timer {
    width: 62px;
    height: 62px;
    background-color: #fff;
    border-radius: 50%;
    color: #000;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    line-height: 1.2;
}

.circle-timer .number {
    font-size: 16px;
    font-weight: 600;
}

.circle-timer .unit {
    font-size: 11px;
    font-weight: 400;
}

.buy-now-btn-green {
    background-color: #00FF66;
    color: #fff;
    border: none;
    padding: 16px 48px;
    border-radius: 4px;
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.3s;
}

.buy-now-btn-green:hover {
    background-color: #00cc52;
}

.music-image {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
}

.music-image img {
    max-width: 100%;
    height: auto;
    z-index: 2;
    /* Adding drop shadow to simulate depth */
    filter: drop-shadow(0 0 20px rgba(255, 255, 255, 0.1));
}

/* Optional: Add a subtle glow behind the image if needed */
.image-glow {
    position: absolute;
    width: 300px;
    height: 300px;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, rgba(0, 0, 0, 0) 70%);
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 1;
}







/* Explore Our Products Section */
.explore-products-section {
    margin-bottom: 140px;
}

.product-grid-explore {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    display: flex;
    gap: 30px;
    margin-bottom: 60px;
    overflow-x: auto;
    scroll-behavior: smooth;
    scrollbar-width: none;
    /* Hide scrollbar Firefox */
    padding-bottom: 10px;
}

.product-grid-explore::-webkit-scrollbar {
    display: none;
    /* Hide scrollbar Chrome/Safari */
}

.view-all-container {
    display: flex;
    justify-content: center;
}

.view-all-btn {
    background-color: #DB4444;
    color: #fff;
    border: none;
    padding: 16px 48px;
    border-radius: 4px;
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.3s;
}

.view-all-btn:hover {
    background-color: #E07575;
}








/* New Arrival Section */
.new-arrival-section {
    margin-bottom: 140px;
}

.new-arrival-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
    height: 600px;
}

.grid-item {
    background-color: #000;
    position: relative;
    border-radius: 4px;
    overflow: hidden;
}

.grid-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    opacity: 0.8;
    transition: transform 0.3s ease;
}

.grid-item:hover img {
    transform: scale(1.05);
}

.item-content {
    position: absolute;
    bottom: 0;
    left: 0;
    padding: 32px;
    color: #fff;
    width: 100%;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
}

.item-content h3 {
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 8px;
}

.item-content p {
    font-size: 14px;
    color: #FAFAFA;
    margin-bottom: 16px;
    font-weight: 400;
    max-width: 240px;
}

.shop-now-link {
    color: #fff;
    font-weight: 500;
    text-decoration: underline;
    text-underline-offset: 4px;
    font-size: 16px;
}

.shop-now-link:hover {
    color: #DB4444;
}

.grid-column-right {
    display: flex;
    flex-direction: column;
    gap: 30px;
}

.item-wide {
    flex: 1;
}

.grid-row-bottom {
    display: flex;
    gap: 30px;
    flex: 1;
}

.item-small {
    flex: 1;
}

/* Services Section */
.services-section {
    margin-bottom: 140px;
}

.services-grid {
    display: flex;
    justify-content: center;
    gap: 88px;
    text-align: center;
}

.service-item {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.service-icon-outer {
    width: 80px;
    height: 80px;
    background-color: #2F2E30;
    /* Dark grey outer ring */
    background-color: rgba(47, 46, 48, 0.3);
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 24px;
}

.service-icon-inner {
    width: 58px;
    height: 58px;
    background-color: #000;
    color: #fff;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 20px;
}

.service-item h3 {
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 8px;
    text-transform: uppercase;
}

.service-item p {
    font-size: 14px;
    font-weight: 400;
}

/* Scroll to Top Button */
.scroll-to-top {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 46px;
    height: 46px;
    background-color: #F5F5F5;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #000;
    font-size: 20px;
    text-decoration: none;
    transition: background-color 0.3s;
    z-index: 1000;
}

.scroll-to-top:hover {
    background-color: #DB4444;
    color: #fff;
}








/* Responsive Styles */

/* Large Desktop (1200px and above) */
@media screen and (min-width: 1200px) {
    .container {
        max-width: 1170px;
    }
}

/* Desktop (992px to 1199px) */
@media screen and (max-width: 1199px) {
    .container {
        max-width: 960px;
    }

    .title-timer {
        gap: 40px;
    }

    .title-timer h2 {
        font-size: 32px;
    }

    .music-banner {
        padding: 50px;
    }

    .music-content h2 {
        font-size: 42px;
        line-height: 52px;
    }
}

/* Tablet Landscape (768px to 991px) */
@media screen and (max-width: 991px) {
    .container {
        max-width: 720px;
    }

    /* Hero Section */
    .hero-container {
        flex-direction: column;
    }

    .sidebar {
        width: 100%;
        border-right: none;
        border-bottom: 1px solid #D9D9D9;
        margin-right: 0;
        margin-bottom: 30px;
        padding-bottom: 20px;
    }

    .sidebar ul {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
    }

    .sidebar ul li {
        margin-bottom: 0;
    }

    .hero-banner {
        height: 300px;
        padding: 0 40px;
    }

    .hero-banner h2 {
        font-size: 36px;
        line-height: 46px;
    }

    /* Flash Sales Section */
    .flash-sales-section {
        padding-top: 80px;
    }

    .flash-sales-row {
        flex-direction: column;
        align-items: flex-start;
        gap: 30px;
    }

    .product-list {
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    /* Categories Section */
    .categories-grid {
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
    }

    .category-card {
        width: 150px;
        height: 130px;
    }

    /* Music Banner */
    .music-banner {
        flex-direction: column;
        text-align: center;
        padding: 40px 30px;
    }

    .music-content {
        margin-bottom: 40px;
    }

    .music-countdown {
        justify-content: center;
    }

    /* New Arrival */
    .new-arrival-grid {
        grid-template-columns: 1fr;
        height: auto;
        gap: 20px;
    }

    .grid-item {
        height: 300px;
    }

    /* Services */
    .services-grid {
        flex-wrap: wrap;
        gap: 40px;
    }

    .service-item {
        width: calc(50% - 40px);
    }
}

/* Tablet Portrait (576px to 767px) */
@media screen and (max-width: 767px) {
    .container {
        max-width: 540px;
    }

    /* Navigation adjustments */
    .nav-content {
        flex-direction: column;
        gap: 20px;
    }

    .nav-links {
        gap: 30px;
    }

    .nav-actions {
        width: 100%;
        justify-content: center;
    }

    .search-box {
        width: 200px;
    }

    /* Hero Section */
    .hero-banner h2 {
        font-size: 28px;
        line-height: 36px;
    }

    .brand-row i {
        font-size: 30px;
    }

    .brand-row span {
        font-size: 14px;
    }

    .banner-image {
        max-width: 40%;
    }

    /* Flash Sales */
    .flash-sales-section {
        padding-top: 60px;
    }

    .title-timer {
        flex-direction: column;
        align-items: flex-start;
        gap: 20px;
    }

    .countdown {
        gap: 10px;
    }

    .time-unit .value {
        font-size: 24px;
    }

    .separator {
        font-size: 20px;
    }

    .product-list {
        grid-template-columns: 1fr;
    }

    /* Categories */
    .categories-section {
        padding-top: 50px;
    }

    .section-title-row {
        flex-direction: column;
        align-items: flex-start;
        gap: 20px;
    }

    .section-title-row h2 {
        font-size: 28px;
    }

    .category-card {
        width: 130px;
        height: 120px;
    }

    .category-card i {
        font-size: 40px;
    }

    /* Music Banner */
    .music-content h2 {
        font-size: 32px;
        line-height: 42px;
    }

    .circle-timer {
        width: 50px;
        height: 50px;
    }

    .circle-timer .number {
        font-size: 14px;
    }

    .buy-now-btn-green {
        padding: 12px 32px;
    }

    /* Product Grid */
    .product-grid-explore {
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    /* New Arrival */
    .grid-row-bottom {
        flex-direction: column;
    }

    .item-content {
        padding: 20px;
    }

    .item-content h3 {
        font-size: 20px;
    }

    /* Services */
    .services-grid {
        gap: 30px;
    }

    .service-item {
        width: 100%;
    }

    /* View All Button */
    .view-all-btn,
    .view-all-btn-small {
        padding: 12px 32px;
        font-size: 14px;
    }
}

/* Mobile Landscape (480px to 575px) */
@media screen and (max-width: 575px) {
    .container {
        max-width: 100%;
        padding: 0 20px;
    }

    /* Top Header */
    .top-header-content {
        flex-direction: column;
        gap: 10px;
    }

    .promo-text {
        font-size: 12px;
    }

    /* Navigation */
    .nav-links {
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
    }

    .nav-actions {
        flex-direction: column;
        gap: 15px;
    }

    .search-box {
        width: 100%;
    }

    .icons {
        justify-content: center;
    }

    /* Hero Section */
    .hero-banner {
        height: 250px;
        padding: 0 20px;
    }

    .hero-banner h2 {
        font-size: 22px;
        line-height: 30px;
    }

    .brand-row {
        gap: 12px;
    }

    .banner-image {
        max-width: 35%;
    }

    .banner-image img {
        opacity: 0.7;
    }

    /* Sidebar */
    .sidebar ul {
        grid-template-columns: repeat(2, 1fr);
    }

    /* Flash Sales */
    .flash-sales-row {
        gap: 20px;
    }

    .title-timer h2 {
        font-size: 24px;
    }

    .countdown {
        gap: 5px;
    }

    .time-unit .value {
        font-size: 20px;
    }

    .time-unit .label {
        font-size: 10px;
    }

    .separator {
        font-size: 16px;
    }

    .nav-arrows {
        display: none;
    }

    /* Categories */
    .categories-grid {
        gap: 15px;
    }

    .category-card {
        width: calc(50% - 15px);
        height: 110px;
    }

    .category-card span {
        font-size: 14px;
    }

    /* Music Banner */
    .music-banner {
        padding: 30px 20px;
    }

    .category-label {
        margin-bottom: 20px;
        font-size: 14px;
    }

    .music-content h2 {
        font-size: 26px;
        line-height: 34px;
        margin-bottom: 24px;
    }

    .music-countdown {
        gap: 12px;
        flex-wrap: wrap;
    }

    .circle-timer {
        width: 45px;
        height: 45px;
    }

    /* Product Grid */
    .product-grid-explore {
        grid-template-columns: 1fr;
    }

    /* New Arrival */
    .new-arrival-section {
        margin-bottom: 80px;
    }

    .grid-item {
        height: 250px;
    }

    .item-content h3 {
        font-size: 18px;
    }

    .item-content p {
        font-size: 12px;
        max-width: 200px;
    }

    /* Services */
    .services-section {
        margin-bottom: 80px;
    }

    .service-icon-outer {
        width: 60px;
        height: 60px;
    }

    .service-icon-inner {
        width: 44px;
        height: 44px;
        font-size: 16px;
    }

    .service-item h3 {
        font-size: 16px;
    }

    .service-item p {
        font-size: 12px;
    }

    /* Scroll to Top */
    .scroll-to-top {
        width: 36px;
        height: 36px;
        font-size: 16px;
        bottom: 20px;
        right: 20px;
    }

    /* Pagination Dots */
    .pagination-dots {
        gap: 8px;
    }

    .dot {
        width: 8px;
        height: 8px;
    }
}

/* Mobile Portrait (320px to 479px) */
@media screen and (max-width: 479px) {
    .hero-banner h2 {
        font-size: 18px;
        line-height: 24px;
    }

    .brand-row i {
        font-size: 24px;
    }

    .brand-row span {
        font-size: 12px;
    }

    .shop-now-btn {
        font-size: 14px;
    }

    .sidebar ul {
        grid-template-columns: 1fr;
    }

    .title-timer h2 {
        font-size: 20px;
    }

    .countdown {
        flex-wrap: wrap;
        justify-content: center;
    }

    .category-card {
        width: 100%;
    }

    .music-content h2 {
        font-size: 22px;
        line-height: 28px;
    }

    .circle-timer {
        width: 40px;
        height: 40px;
    }

    .circle-timer .number {
        font-size: 12px;
    }

    .circle-timer .unit {
        font-size: 9px;
    }

    .buy-now-btn-green {
        padding: 10px 24px;
        font-size: 14px;
    }

    .grid-item {
        height: 200px;
    }

    .item-content {
        padding: 15px;
    }

    .item-content h3 {
        font-size: 16px;
    }

    .item-content p {
        font-size: 11px;
        margin-bottom: 12px;
    }

    .shop-now-link {
        font-size: 14px;
    }

    .service-item {
        padding: 0 10px;
    }
}

/* Fix for very small devices */
@media screen and (max-width: 359px) {
    .hero-banner {
        height: 220px;
    }

    .hero-banner h2 {
        font-size: 16px;
        line-height: 20px;
    }

    .banner-image {
        max-width: 30%;
    }

    .nav-links {
        gap: 15px;
    }

    .nav-links a {
        font-size: 14px;
    }

    .product-card {
        gap: 12px;
    }

    .card-header {
        height: 200px;
    }

    .price {
        font-size: 14px;
    }
}

/* Print Styles */
@media print {

    .top-header,
    .nav-actions,
    .icons,
    .add-to-cart-btn,
    .card-icons,
    .nav-arrows,
    .scroll-to-top,
    .view-all-container {
        display: none;
    }
}
</style>
@endpush
@endsection