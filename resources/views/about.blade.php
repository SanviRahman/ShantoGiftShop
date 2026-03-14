@extends('home.layout')

@section('title','About US - ShantoGiftShop')

@section('content')
<!-- Breadcrumb -->
<div class="container breadcrumb-container" style="margin-top: 90px;">
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <span class="separator">/</span>
        <span class="current">About</span>
    </div>
</div>
<!-- Our Story Section -->
<section class="our-story-section">
    <div class="container our-story-container">
        <div class="our-story-content">
            <h1 class="story-title">Our Story</h1>
            <p class="story-text" style="text-align: justify;">
                Launced in 2015, Exclusive is South Asia’s premier online shopping makterplace with an active presense
                in Bangladesh. Supported by wide range of tailored marketing, data and service solutions, Exclusive has
                10,500 sallers and 300 brands and serves 3 millioons customers across the region.
            </p>
            <p class="story-text" style="text-align: justify;">
                Exclusive has more than 1 Million products to offer, growing at a very fast. Exclusive offers a diverse
                assortment in categories ranging from consumer.
            </p>
        </div>
        <div class="our-story-image">
            <img src="{{ asset('images/about-01.png') }}" alt="Two women shopping">
        </div>
    </div>
</section>
<!-- Stats Section -->
<section class="stats-section">
    <div class="container stats-container">
        <!-- Stat Card 1 -->
        <div class="stat-card">
            <div class="stat-icon-wrapper">
                <div class="stat-icon">
                    <i class="fas fa-store"></i>
                </div>
            </div>
            <h3 class="stat-number">10.5k</h3>
            <p class="stat-desc">Sallers active our site</p>
        </div>

        <!-- Stat Card 2 -->
        <div class="stat-card">
            <div class="stat-icon-wrapper">
                <div class="stat-icon">
                    <i class="fas fa-dollar-sign"></i>
                </div>
            </div>
            <h3 class="stat-number">33k</h3>
            <p class="stat-desc">Mopnthly Produuct Sale</p>
        </div>

        <!-- Stat Card 3 -->
        <div class="stat-card">
            <div class="stat-icon-wrapper">
                <div class="stat-icon">
                    <i class="fas fa-shopping-bag"></i>
                </div>
            </div>
            <h3 class="stat-number">45.5k</h3>
            <p class="stat-desc">Customer active in our site</p>
        </div>

        <!-- Stat Card 4 -->
        <div class="stat-card">
            <div class="stat-icon-wrapper">
                <div class="stat-icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
            </div>
            <h3 class="stat-number">25k</h3>
            <p class="stat-desc">Anual gross sale in our site</p>
        </div>
    </div>
</section>
<!-- Team Section -->
<section class="team-section">
    <div class="container">
        <div class="team-slider-wrapper">
            <div class="team-slider">
                <!-- Team Member 1 -->
                <div class="team-card">
                    <div class="team-image">
                        <img src="{{ asset('images/sanvi-01.jpg') }}" alt="Tom Cruise">
                    </div>
                    <h3 class="team-name">Tom Cruise</h3>
                    <p class="team-role">Founder & Chairman</p>
                    <div class="team-socials">
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>

                <!-- Team Member 2 -->
                <div class="team-card">
                    <div class="team-image">
                        <img src="{{ asset('images/sanvi-02.jpg') }}" alt="Emma Watson">
                    </div>
                    <h3 class="team-name">Emma Watson</h3>
                    <p class="team-role">Managing Director</p>
                    <div class="team-socials">
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>

                <!-- Team Member 3 -->
                <div class="team-card">
                    <div class="team-image">
                        <img src="{{ asset('images/sanvi-01.jpg') }}" alt="Will Smith">
                    </div>
                    <h3 class="team-name">Will Smith</h3>
                    <p class="team-role">Product Designer</p>
                    <div class="team-socials">
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>

                <!-- Team Member 4 -->
                <div class="team-card">
                    <div class="team-image">
                        <img src="{{ asset('images/sanvi-02.jpg') }}" alt="Tom Cruise">
                    </div>
                    <h3 class="team-name">Tom Cruise</h3>
                    <p class="team-role">Founder & Chairman</p>
                    <div class="team-socials">
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>

                <!-- Team Member 5 -->
                <div class="team-card">
                    <div class="team-image">
                        <img src="{{ asset('images/sanvi-01.jpg') }}" alt="Emma Watson">
                    </div>
                    <h3 class="team-name">Emma Watson</h3>
                    <p class="team-role">Managing Director</p>
                    <div class="team-socials">
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>

                <!-- Team Member 6 -->
                <div class="team-card">
                    <div class="team-image">
                        <img src="{{ asset('images/sanvi-02.jpg') }}" alt="Tom Cruise">
                    </div>
                    <h3 class="team-name">Tom Cruise</h3>
                    <p class="team-role">Founder & Chairman</p>
                    <div class="team-socials">
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination Dots -->
        <div class="team-pagination">
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot active"></span>
            <span class="dot"></span>
            <span class="dot"></span>
        </div>
    </div>
</section>
<!-- Services Section -->
<section class="services-section">
    <div class="container">
        <div class="services-grid">
            <!-- Service 1 -->
            <div class="service-item">
                <div class="service-icon-outer">
                    <div class="service-icon-inner">
                        <i class="fas fa-truck-fast"></i>
                    </div>
                </div>
                <h3>FREE AND FAST DELIVERY</h3>
                <p>Free delivery for all orders over $140</p>
            </div>
            <!-- Service 2 -->
            <div class="service-item">
                <div class="service-icon-outer">
                    <div class="service-icon-inner">
                        <i class="fas fa-headset"></i>
                    </div>
                </div>
                <h3>24/7 CUSTOMER SERVICE</h3>
                <p>Friendly 24/7 customer support</p>
            </div>
            <!-- Service 3 -->
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


<script>
// Team Slider Logic with Right to Left Auto Scrolling
(function() {
    const slider = document.querySelector('.team-slider');
    const dots = document.querySelectorAll('.team-pagination .dot');
    const wrapper = document.querySelector('.team-slider-wrapper');

    if (!slider || !dots.length || !wrapper) return;

    let currentIndex = 0;
    let totalSlides = dots.length;
    let autoScrollInterval;
    let cardWidth = 0;
    let gap = 30;

    function calculateCardWidth() {
        const card = slider.querySelector('.team-card');
        if (!card) return;

        // Get actual card width including gap
        cardWidth = card.offsetWidth;

        // Get gap from computed style
        const sliderStyle = window.getComputedStyle(slider);
        gap = parseInt(sliderStyle.gap) || 30;
    }

    function updateSlider() {
        calculateCardWidth();

        if (cardWidth === 0) return;

        // Calculate total width to move
        const totalWidth = (cardWidth + gap) * currentIndex;

        // Apply transform with smooth transition
        slider.style.transition = 'transform 0.5s ease-in-out';
        slider.style.transform = `translateX(-${totalWidth}px)`;

        // Update dots
        dots.forEach((dot, index) => {
            if (index === currentIndex) {
                dot.classList.add('active');
                dot.style.backgroundColor = '#DB4444';
                dot.style.boxShadow = '0 0 0 2px #DB4444';
                dot.style.border = '2px solid #fff';
            } else {
                dot.classList.remove('active');
                dot.style.backgroundColor = 'rgba(0, 0, 0, 0.3)';
                dot.style.boxShadow = 'none';
                dot.style.border = '2px solid transparent';
            }
        });
    }

    function nextSlide() {
        calculateCardWidth();

        if (cardWidth === 0) return;

        currentIndex++;

        // Check if we've reached the end
        if (currentIndex >= totalSlides) {
            currentIndex = 0;
        }

        updateSlider();
    }

    function startAutoScroll() {
        if (autoScrollInterval) {
            clearInterval(autoScrollInterval);
        }
        autoScrollInterval = setInterval(nextSlide, 2600); // 2.6 seconds
    }

    function stopAutoScroll() {
        if (autoScrollInterval) {
            clearInterval(autoScrollInterval);
        }
    }

    // Dot click event
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            stopAutoScroll();
            currentIndex = index;
            updateSlider();
            startAutoScroll();
        });

        // Touch events for mobile
        dot.addEventListener('touchstart', (e) => {
            e.preventDefault();
            stopAutoScroll();
            currentIndex = index;
            updateSlider();
            startAutoScroll();
        });
    });

    // Pause auto scroll on hover/touch
    slider.addEventListener('mouseenter', stopAutoScroll);
    slider.addEventListener('mouseleave', startAutoScroll);

    // Touch events for mobile
    slider.addEventListener('touchstart', stopAutoScroll);
    slider.addEventListener('touchend', startAutoScroll);

    // Handle responsive resize
    let resizeTimer;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            calculateCardWidth();
            updateSlider();
        }, 250);
    });

    // Initial setup
    setTimeout(() => {
        calculateCardWidth();
        updateSlider();
        startAutoScroll();
    }, 100);

    // Handle visibility change (pause when tab is not active)
    document.addEventListener('visibilitychange', () => {
        if (document.hidden) {
            stopAutoScroll();
        } else {
            startAutoScroll();
        }
    });
})();
</script>
@endsection

@push('styles')
<style>
/* Breadcrumb */
.breadcrumb-container {
    margin-top: 80px;
    margin-bottom: 40px;
}

.breadcrumb a {
    color: #000;
    opacity: 0.5;
}

.breadcrumb .separator {
    margin: 0 10px;
    opacity: 0.5;
}

.breadcrumb .current {
    font-weight: 500;
}

/* About Page - Our Story Section */
.our-story-section {
    padding: 40px 0 140px 0;
}

.our-story-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 75px;
}

.our-story-content {
    flex: 1;
    max-width: 525px;
}

.story-title {
    font-size: 54px;
    font-weight: 600;
    letter-spacing: 0.06em;
    margin-bottom: 40px;
    line-height: 1.2;
}

.story-text {
    font-size: 16px;
    line-height: 26px;
    color: #000;
    margin-bottom: 24px;
}

.our-story-image {
    flex: 1;
    border-radius: 4px;
    overflow: hidden;
}

.our-story-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}







/* Stats Section */
.stats-section {
    padding-bottom: 140px;
}

.stats-container {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 30px;
}

.stat-card {
    border: 1px solid rgba(0, 0, 0, 0.3);
    border-radius: 4px;
    padding: 30px;
    text-align: center;
    transition: all 0.3s ease;
    cursor: pointer;
}

.stat-card:hover,
.stat-card.active {
    background-color: #DB4444;
    border-color: #DB4444;
    color: #FAFAFA;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
}

.stat-icon-wrapper {
    width: 80px;
    height: 80px;
    background-color: #c1c0c1;
    border-radius: 50%;
    margin: 0 auto 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background-color 0.3s ease;
    border: 10px solid rgba(47, 46, 48, 0.3);
}

.stat-card:hover .stat-icon-wrapper,
.stat-card.active .stat-icon-wrapper {
    background-color: #FAFAFA;
    border-color: rgba(255, 255, 255, 0.3);
}

.stat-icon {
    width: 58px;
    height: 58px;
    background-color: #000;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #FAFAFA;
    font-size: 24px;
    transition: all 0.3s ease;
}

.stat-card:hover .stat-icon,
.stat-card.active .stat-icon {
    background-color: #000;
    color: #FAFAFA;
}


/* Correction for Active State Icon */
.stat-card:hover .stat-icon,
.stat-card.active .stat-icon {
    background-color: #FAFAFA;
    color: #000;
}

.stat-number {
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 12px;
    letter-spacing: 0.04em;
}

.stat-desc {
    font-size: 16px;
    font-weight: 400;
}


/* Team Section */
.team-section {
    padding-bottom: 140px;
}

.team-slider-wrapper {
    overflow: hidden;
    margin-bottom: 40px;
}

.team-slider {
    display: flex;
    gap: 30px;
    transition: transform 0.5s ease-in-out;
}

.team-card {
    min-width: 370px;
    flex: 0 0 calc(33.333% - 20px);
}

.team-image {
    background-color: #F5F5F5;
    height: 430px;
    width: 100%;
    border-radius: 4px;
    overflow: hidden;
    margin-bottom: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.team-image img {
    width: 90%;
    height: 65%;
    object-fit: contain;
    border-radius: 26px;
    background-color: #F5F5F5;
}

.team-name {
    font-size: 32px;
    font-weight: 500;
    letter-spacing: 0.04em;
    margin-bottom: 8px;
}

.team-role {
    font-size: 16px;
    font-weight: 400;
    margin-bottom: 16px;
    color: #000;
}

.team-socials {
    display: flex;
    gap: 16px;
}

.team-socials a {
    color: #000;
    font-size: 20px;
    transition: color 0.3s;
}

.team-socials a:hover {
    color: #DB4444;
}

.team-pagination {
    display: flex;
    justify-content: center;
    gap: 12px;
    margin-top: 40px;
}

.team-pagination .dot {
    width: 12px;
    height: 12px;
    background-color: rgba(0, 0, 0, 0.3);
    border-radius: 50%;
    cursor: pointer;
    transition: all 0.3s;
    border: 2px solid transparent;
}

.team-pagination .dot.active {
    background-color: #DB4444;
    border: 2px solid #fff;
    box-shadow: 0 0 0 2px #DB4444;
    /* Creates the ring effect */
}



/* Services Section */

.services-section {
    margin: 100px 0 140px;
    cursor: pointer;
}

.services-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 40px;
    text-align: center;
    align-items: stretch;
}

.service-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 26px 18px;
    border: 1px solid rgba(0, 0, 0, 0.08);
    border-radius: 12px;
    background: #fff;
    transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
    height: 100%;
}

.service-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 24px rgba(0, 0, 0, 0.08);
    border-color: rgba(0, 0, 0, 0.14);
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
    color: rgba(0, 0, 0, 0.7);
}




/* Responsive Styles for About Page */

/* Large Desktop (1200px and above) */
@media screen and (min-width: 1200px) {
    .container {
        max-width: 1170px;
    }
}

/* Desktop (992px to 1199px) */
@media screen and (max-width: 1199px) {
    .our-story-container {
        gap: 50px;
    }

    .story-title {
        font-size: 48px;
    }

    .team-card {
        min-width: 300px;
        flex: 0 0 calc(33.333% - 20px);
    }

    .team-image {
        height: 350px;
    }
}

/* Tablet Landscape (768px to 991px) */
@media screen and (max-width: 991px) {
    .breadcrumb-container {
        margin-top: 60px;
        margin-bottom: 30px;
    }

    /* Our Story Section */
    .our-story-section {
        padding: 30px 0 100px 0;
    }

    .our-story-container {
        flex-direction: column;
        gap: 40px;
    }

    .our-story-content {
        max-width: 100%;
        text-align: center;
    }

    .story-title {
        font-size: 42px;
        margin-bottom: 30px;
    }

    /* Stats Section */
    .stats-section {
        padding-bottom: 100px;
    }

    .stats-container {
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .stat-card {
        padding: 25px;
    }

    .stat-number {
        font-size: 28px;
    }

    /* Team Section */
    .team-section {
        padding-bottom: 100px;
    }

    .team-slider-wrapper {
        overflow: hidden;
        margin-bottom: 30px;
        padding: 0 5px;
        /* সামান্য padding দিয়ে সুরক্ষিত */
    }

    .team-slider {
        display: flex;
        gap: 20px;
        transition: transform 0.5s ease-in-out;
    }

    .team-card {
        min-width: 320px;
        flex: 0 0 calc(50% - 10px);
        background: #fff;
        /* ব্যাকগ্রাউন্ড যোগ করুন */
        border-radius: 8px;
        padding: 10px;
        /* প্যাডিং যোগ করুন */
    }

    .team-image {
        height: 300px;
        width: 100%;
        margin-bottom: 20px;
    }

    .team-image img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .team-name {
        font-size: 24px;
        margin-bottom: 6px;
        white-space: normal;
        /* টেক্সট যেন মোড়ানো যায় */
        word-wrap: break-word;
    }

    .team-role {
        font-size: 15px;
        margin-bottom: 12px;
        white-space: normal;
    }

    .team-socials {
        gap: 14px;
    }

    .team-socials a {
        font-size: 18px;
    }

    /* Services Section */
    .services-section {
        margin-bottom: 100px;
    }

    .services-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 24px;
    }

    .service-item {
        width: auto;
    }
}

/* Tablet Portrait (576px to 767px) */
@media screen and (max-width: 767px) {
    .breadcrumb-container {
        margin-top: 40px;
        margin-bottom: 25px;
    }

    /* Our Story Section */
    .our-story-section {
        padding: 20px 0 80px 0;
    }

    .story-title {
        font-size: 36px;
        margin-bottom: 25px;
    }

    .story-text {
        font-size: 15px;
        line-height: 24px;
    }

    /* Stats Section */
    .stats-section {
        padding-bottom: 80px;
    }

    .stats-container {
        gap: 15px;
    }

    .stat-card {
        padding: 20px;
    }

    .stat-icon-wrapper {
        width: 70px;
        height: 70px;
        margin-bottom: 20px;
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        font-size: 20px;
    }

    .stat-number {
        font-size: 24px;
        margin-bottom: 8px;
    }

    .stat-desc {
        font-size: 14px;
    }

    /* Team Section */
    .team-section {
        padding-bottom: 60px;
    }

    .team-slider-wrapper {
        overflow: hidden;
        margin-bottom: 25px;
        padding: 0 10px;
    }

    .team-slider {
        gap: 15px;
    }

    .team-card {
        min-width: 280px;
        flex: 0 0 calc(100% - 30px);
        /* Full width with margin */
        padding: 8px;
    }

    .team-image {
        height: 260px;
        margin-bottom: 18px;
    }

    .team-name {
        font-size: 22px;
    }

    .team-role {
        font-size: 14px;
    }

    .team-socials {
        gap: 12px;
    }

    /* Services Section */
    .services-section {
        margin-bottom: 80px;
    }

    .services-grid {
        grid-template-columns: 1fr;
        gap: 18px;
    }

    .service-item {
        width: auto;
    }
}

/* Mobile Landscape (480px to 575px) */
@media screen and (max-width: 575px) {
    .breadcrumb-container {
        margin-top: 30px;
        margin-bottom: 20px;
    }

    .breadcrumb a,
    .breadcrumb .separator,
    .breadcrumb .current {
        font-size: 14px;
    }

    /* Our Story Section */
    .our-story-section {
        padding: 15px 0 60px 0;
    }

    .story-title {
        font-size: 30px;
        letter-spacing: 0.04em;
    }

    .story-text {
        font-size: 14px;
        line-height: 22px;
        margin-bottom: 20px;
    }

    /* Stats Section */
    .stats-section {
        padding-bottom: 60px;
    }

    .stats-container {
        grid-template-columns: 1fr;
        max-width: 320px;
        margin: 0 auto;
    }

    .stat-card {
        padding: 20px;
    }

    /* Team Section */
    .team-section {
        padding-bottom: 50px;
    }

    .team-slider-wrapper {
        padding: 0 15px;
        margin-bottom: 20px;
    }

    .team-slider {
        gap: 15px;
    }

    .team-card {
        min-width: 260px;
        flex: 0 0 calc(100% - 30px);
        padding: 8px;
    }

    .team-image {
        height: 240px;
        margin-bottom: 16px;
    }

    .team-name {
        font-size: 20px;
        margin-bottom: 4px;
    }

    .team-role {
        font-size: 13px;
        margin-bottom: 10px;
    }

    .team-socials {
        gap: 12px;
    }

    .team-socials a {
        font-size: 16px;
    }

    .team-pagination {
        gap: 8px;
        margin-top: 20px;
    }

    .team-pagination .dot {
        width: 10px;
        height: 10px;
    }

    /* Services Section */
    .services-section {
        margin-bottom: 60px;
    }

    .service-icon-outer {
        width: 65px;
        height: 65px;
    }

    .service-icon-inner {
        width: 45px;
        height: 45px;
        font-size: 16px;
    }

    .service-item h3 {
        font-size: 16px;
    }

    .service-item p {
        font-size: 12px;
    }
}

/* iPhone 14 Pro Max and similar devices (430px) */
@media screen and (min-width: 420px) and (max-width: 440px) {
    .team-section {
        padding-bottom: 45px;
    }

    .team-slider-wrapper {
        padding: 0 15px;
    }

    .team-slider {
        gap: 15px;
    }

    .team-card {
        min-width: 280px;
        flex: 0 0 calc(100% - 30px);
        padding: 10px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .team-image {
        height: 250px;
        margin-bottom: 15px;
    }

    .team-name {
        font-size: 22px;
        margin-bottom: 5px;
        line-height: 1.3;
        text-align: left;
        padding-left: 5px;
    }

    .team-role {
        font-size: 14px;
        margin-bottom: 12px;
        line-height: 1.4;
        text-align: left;
        padding-left: 5px;
    }

    .team-socials {
        gap: 15px;
        padding-left: 5px;
    }

    .team-socials a {
        font-size: 18px;
    }

    .team-pagination {
        margin-top: 25px;
    }

    .team-pagination .dot {
        width: 12px;
        height: 12px;
    }
}

/* Mobile Portrait (320px to 419px) */
@media screen and (max-width: 419px) {
    .breadcrumb-container {
        margin-top: 20px;
    }

    .breadcrumb a,
    .breadcrumb .separator,
    .breadcrumb .current {
        font-size: 12px;
    }

    /* Our Story Section */
    .our-story-section {
        padding: 10px 0 40px 0;
    }

    .story-title {
        font-size: 24px;
        margin-bottom: 20px;
    }

    .story-text {
        font-size: 13px;
        line-height: 20px;
        margin-bottom: 16px;
    }

    /* Stats Section */
    .stats-section {
        padding-bottom: 40px;
    }

    .stat-card {
        padding: 15px;
    }

    .stat-icon-wrapper {
        width: 55px;
        height: 55px;
        margin-bottom: 15px;
    }

    .stat-icon {
        width: 40px;
        height: 40px;
        font-size: 14px;
    }

    .stat-number {
        font-size: 18px;
        margin-bottom: 5px;
    }

    .stat-desc {
        font-size: 12px;
    }

    /* Team Section */
    .team-section {
        padding-bottom: 35px;
    }

    .team-slider-wrapper {
        padding: 0 10px;
        margin-bottom: 15px;
    }

    .team-slider {
        gap: 12px;
    }

    .team-card {
        min-width: 220px;
        flex: 0 0 calc(100% - 24px);
        padding: 6px;
    }

    .team-image {
        height: 200px;
        margin-bottom: 12px;
    }

    .team-name {
        font-size: 18px;
        margin-bottom: 4px;
    }

    .team-role {
        font-size: 12px;
        margin-bottom: 8px;
    }

    .team-socials {
        gap: 10px;
    }

    .team-socials a {
        font-size: 14px;
    }

    .team-pagination {
        margin-top: 15px;
    }

    .team-pagination .dot {
        width: 8px;
        height: 8px;
    }

    /* Services Section */
    .services-section {
        margin-bottom: 40px;
    }

    .service-icon-outer {
        width: 55px;
        height: 55px;
        margin-bottom: 12px;
    }

    .service-icon-inner {
        width: 40px;
        height: 40px;
        font-size: 14px;
    }

    .service-item h3 {
        font-size: 15px;
        margin-bottom: 4px;
    }

    .service-item p {
        font-size: 11px;
    }
}

/* Touch Device Optimization for Stats */
@media (hover: none) and (pointer: coarse) {
    .stat-card {
        -webkit-tap-highlight-color: transparent;
    }

    .stat-card:active {
        background-color: #DB4444;
        border-color: #DB4444;
        color: #FAFAFA;
        transition: all 0.1s ease;
    }

    .stat-card:active .stat-icon-wrapper {
        background-color: #FAFAFA;
        border-color: rgba(255, 255, 255, 0.3);
    }

    .stat-card:active .stat-icon {
        background-color: #FAFAFA;
        color: #000;
    }
}

/* Print Styles */
@media print {

    .stats-section,
    .team-section,
    .services-section {
        page-break-inside: avoid;
    }
}
</style>
@endpush
