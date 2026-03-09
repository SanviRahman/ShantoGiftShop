@extends('home.layout')

@section('title', 'Sign Up - ShantoGiftShop')

@section('content')
<!-- Sign Up Section -->
<div class="auth-container" style="margin-top: 90px; ">
    <!-- Left Side Image -->
    <div class="auth-image">
        <img src="https://via.placeholder.com/805x781/CBE4E8/000000?text=Phone+Shopping+Cart+Image" alt="Side Image">
    </div>

    <!-- Right Side Form -->
    <div class="auth-form-wrapper">
        <h2 class="auth-heading">Create an account</h2>
        <p class="auth-subheading">Enter your details below</p>

        <form class="auth-form">
            <div class="form-group">
                <input type="text" placeholder="Name" required>
            </div>
            <div class="form-group">
                <input type="text" placeholder="Email or Phone Number" required>
            </div>
            <div class="form-group">
                <input type="password" placeholder="Password" required>
            </div>

            <div class="auth-actions">
                <button type="submit" class="btn-primary">Create Account</button>
                <button type="button" class="btn-outline">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg" alt="Google"
                        style="width: 24px; height: 24px;">
                    Sign up with Google
                </button>
            </div>

            <div class="auth-footer">
                <span>Already have account?</span>
                <a href="{{ route('login') }}">Log in</a>
            </div>
        </form>
    </div>
</div>

@push('styles')
<style>
/* Reset and Base Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    color: #000;
    line-height: 1.6;
    background-color: #fff;
}

a {
    text-decoration: none;
    color: inherit;
    transition: color 0.3s;
}

ul {
    list-style: none;
}

img {
    max-width: 100%;
    height: auto;
    display: block;
}

/* Typography & Colors */
:root {
    --primary-red: #DB4444;
    --text-black: #000000;
    --text-gray: #7D8184;
    /* For secondary text */
    --bg-gray: #F5F5F5;
    --white: #FFFFFF;
}
/* Breadcrumb */
.breadcrumb-container {
    margin-top: 80px;
    margin-bottom: 80px;
}

.breadcrumb a {
    color: var(--text-black);
    opacity: 0.5;
}

.breadcrumb .separator {
    margin: 0 10px;
    opacity: 0.5;
}

.breadcrumb .current {
    font-weight: 500;
}

/* Buttons */
.btn-primary {
    background-color: var(--primary-red);
    color: #fff;
    border: none;
    padding: 16px 48px;
    border-radius: 4px;
    font-family: 'Poppins', sans-serif;
    font-weight: 500;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
    white-space: nowrap;
    text-align: center;
    display: inline-block;
}

.btn-primary:hover {
    background-color: #E07575;
}

.btn-outline {
    background-color: transparent;
    border: 1px solid rgba(0, 0, 0, 0.4);
    color: #000;
    padding: 16px 48px;
    border-radius: 4px;
    font-family: 'Poppins', sans-serif;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.btn-outline:hover {
    background-color: var(--bg-gray);
}


/* =========================================
   Auth Pages (Signup / Login)
   ========================================= */

.auth-container {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 140px;
    gap: 129px;
    /* Gap between image and form per design */
    min-height: 100vh;
}

.auth-image {
    width: 805px;
    /* Large side image */
    height: 781px;
    background-color: #CBE4E8;
    /* Placeholder color from image */
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
}

.auth-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.auth-form-wrapper {
    max-width: 371px;
    width: 100%;
    padding-right: 20px;
    /* Some padding for responsiveness */
}

.auth-heading {
    font-size: 36px;
    font-weight: 500;
    letter-spacing: 0.04em;
    margin-bottom: 24px;
}

.auth-subheading {
    font-size: 16px;
    font-weight: 400;
    margin-bottom: 48px;
}

.auth-form .form-group {
    margin-bottom: 40px;
    position: relative;
}

.auth-form input {
    width: 100%;
    border: none;
    border-bottom: 1px solid rgba(0, 0, 0, 0.5);
    padding: 8px 0;
    font-family: 'Poppins', sans-serif;
    font-size: 16px;
    outline: none;
    transition: border-color 0.3s;
}

.auth-form input:focus {
    border-bottom-color: #000;
}

.auth-actions {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.auth-actions .btn-primary {
    width: 100%;
}

.auth-actions .btn-outline {
    width: 100%;
}

.auth-footer {
    margin-top: 32px;
    text-align: center;
    color: rgba(0, 0, 0, 0.7);
}

.auth-footer a {
    font-weight: 500;
    color: #000;
    border-bottom: 1px solid #000;
    margin-left: 4px;
}

.login-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 40px;
}

.forgot-password {
    color: var(--primary-red);
    font-size: 16px;
}


/* =========================================
   404 Page Styles
   ========================================= */

.error-page-section {
    padding: 140px 0;
    text-align: center;
}

.error-heading {
    font-size: 110px;
    font-weight: 500;
    line-height: 115px;
    letter-spacing: 0.03em;
    margin-bottom: 40px;
}

.error-text {
    font-size: 16px;
    margin-bottom: 80px;
}

/* =========================================
   Product Details Page Styles
   ========================================= */

.product-details-container {
    display: flex;
    gap: 70px;
    margin-bottom: 140px;
}

/* Gallery */
.product-gallery {
    display: flex;
    gap: 30px;
}

.gallery-thumbnails {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.thumbnail {
    width: 170px;
    height: 138px;
    background-color: var(--bg-gray);
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 4px;
    cursor: pointer;
    transition: all 0.3s;
}

.thumbnail img {
    max-width: 80%;
    max-height: 80%;
    object-fit: contain;
}

.thumbnail:hover,
.thumbnail.active {
    border: 1px solid #000;
    /* Or active state */
}

.main-image {
    width: 500px;
    height: 600px;
    background-color: var(--bg-gray);
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 4px;
}

.main-image img {
    max-width: 90%;
    max-height: 90%;
    object-fit: contain;
}

/* Info */
.product-info-col {
    flex: 1;
    max-width: 400px;
}

.product-title {
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 16px;
}

.rating-row {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 16px;
    font-size: 14px;
    color: var(--text-gray);
}

.rating-stars {
    color: #FFAD33;
}

.stock-status {
    color: #00FF66;
    border-left: 1px solid rgba(0, 0, 0, 0.5);
    padding-left: 16px;
}

.product-price-large {
    font-size: 24px;
    font-weight: 400;
    margin-bottom: 24px;
}

.product-description {
    font-size: 14px;
    margin-bottom: 24px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.5);
    padding-bottom: 24px;
}

.product-options {
    margin-bottom: 24px;
}

.option-row {
    display: flex;
    align-items: center;
    gap: 24px;
    margin-bottom: 24px;
}

.option-label {
    font-size: 20px;
    font-weight: 400;
    min-width: 80px;
}

/* Colour Radio */
.colour-options {
    display: flex;
    gap: 8px;
}

.colour-radio {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    cursor: pointer;
    position: relative;
    border: 1px solid transparent;
    /* For white/light colors */
}

.colour-radio.selected {
    outline: 2px solid #000;
    /* Active ring */
    outline-offset: 2px;
}

/* Size Radio */
.size-options {
    display: flex;
    gap: 16px;
}

.size-radio {
    width: 32px;
    height: 32px;
    border: 1px solid rgba(0, 0, 0, 0.5);
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s;
}

.size-radio:hover {
    background-color: var(--primary-red);
    color: #fff;
    border-color: var(--primary-red);
}

.size-radio.selected {
    background-color: var(--primary-red);
    color: #fff;
    border-color: var(--primary-red);
}

/* Quantity & Buy Actions */
.purchase-actions {
    display: flex;
    gap: 16px;
    margin-bottom: 40px;
    align-items: center;
}

.quantity-control {
    display: flex;
    border: 1px solid rgba(0, 0, 0, 0.5);
    border-radius: 4px;
    height: 44px;
}

.qty-btn {
    width: 40px;
    border: none;
    background: transparent;
    font-size: 20px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
}

.qty-btn:hover {
    background-color: var(--primary-red);
    color: #fff;
}

.qty-input {
    width: 80px;
    border: none;
    border-left: 1px solid rgba(0, 0, 0, 0.5);
    border-right: 1px solid rgba(0, 0, 0, 0.5);
    text-align: center;
    font-size: 20px;
    font-weight: 500;
    outline: none;
    /* Hide spinners */
    -moz-appearance: textfield;
}

.qty-input::-webkit-outer-spin-button,
.qty-input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

.wishlist-btn {
    width: 40px;
    height: 40px;
    border: 1px solid rgba(0, 0, 0, 0.5);
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 20px;
    transition: all 0.3s;
}

.wishlist-btn:hover {
    background-color: var(--primary-red);
    color: #fff;
    border-color: var(--primary-red);
}

/* Delivery Info Box */
.delivery-info {
    border: 1px solid rgba(0, 0, 0, 0.5);
    border-radius: 4px;
}

.delivery-item {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 24px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.5);
}

.delivery-item:last-child {
    border-bottom: none;
}

.delivery-icon {
    font-size: 24px;
    width: 40px;
    text-align: center;
}

.delivery-text h4 {
    font-size: 16px;
    font-weight: 500;
    margin-bottom: 8px;
}

.delivery-text p {
    font-size: 12px;
    font-weight: 500;
    text-decoration: underline;
}

/* Related Items */
.related-items-section {
    margin-bottom: 140px;
}

.section-header-simple {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 60px;
}

.red-block-small {
    width: 20px;
    height: 40px;
    background-color: var(--primary-red);
    border-radius: 4px;
}

.section-header-simple h3 {
    font-size: 16px;
    color: var(--primary-red);
    font-weight: 600;
}


/* Reusable Product Card Grid from previous turn, adding here for completeness */
.product-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 30px;
}

.product-card {
    position: relative;
    background-color: #fff;
}

.product-image {
    background-color: var(--bg-gray);
    height: 250px;
    border-radius: 4px;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 16px;
    overflow: hidden;
}

.product-image img {
    max-height: 80%;
    object-fit: contain;
}

.discount-badge {
    position: absolute;
    top: 12px;
    left: 12px;
    background-color: var(--primary-red);
    color: #fff;
    padding: 4px 12px;
    border-radius: 4px;
    font-size: 12px;
}

.card-actions {
    position: absolute;
    top: 12px;
    right: 12px;
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.action-btn {
    width: 34px;
    height: 34px;
    background-color: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 16px;
    transition: all 0.3s;
}

.action-btn:hover {
    background-color: var(--primary-red);
    color: #fff;
}

.add-to-cart-bar {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    background-color: #000;
    color: #fff;
    text-align: center;
    padding: 10px 0;
    font-weight: 500;
    cursor: pointer;
    opacity: 0;
    transition: opacity 0.3s;
}

.product-card:hover .add-to-cart-bar {
    opacity: 1;
}

.product-info h3 {
    font-size: 16px;
    font-weight: 500;
    margin-bottom: 8px;
}

.product-price {
    display: flex;
    gap: 12px;
    align-items: center;
    margin-bottom: 8px;
    color: var(--primary-red);
    font-weight: 500;
}

.old-price {
    color: var(--text-gray);
    text-decoration: line-through;
    font-weight: 400;
}

.product-rating {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    color: var(--text-gray);
}

.stars {
    color: #FFAD33;
}

/* Responsive Styles */
@media (max-width: 1024px) {
    .auth-container {
        flex-direction: column;
        gap: 60px;
    }

    .auth-image {
        width: 100%;
        height: 400px;
        /* Reduced height for mobile/tablet */
    }

    .auth-form-wrapper {
        max-width: 100%;
        padding: 0 20px;
    }

    .product-details-container {
        flex-direction: column;
    }

    .product-gallery {
        flex-direction: column-reverse;
        /* Thumbnails below main image */
    }

    .gallery-thumbnails {
        flex-direction: row;
        overflow-x: auto;
    }

    .thumbnail {
        min-width: 100px;
        width: 100px;
        height: 80px;
    }

    .main-image {
        width: 100%;
        height: 400px;
    }

    .product-info-col {
        max-width: 100%;
    }

    .product-grid {
        grid-template-columns: repeat(3, 1fr);
    }

    .footer-content {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (max-width: 768px) {
    .nav-links {
        display: none;
    }

    .product-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .footer-content {
        grid-template-columns: 1fr;
        text-align: center;
    }

    .subscribe-input-group {
        margin: 0 auto;
    }

    .app-download-area,
    .social-icons {
        justify-content: center;
    }

    .error-heading {
        font-size: 60px;
        line-height: 70px;
    }
}

@media (max-width: 480px) {
    .product-grid {
        grid-template-columns: 1fr;
    }

    .login-actions {
        flex-direction: column;
        gap: 16px;
        align-items: flex-start;
    }
}
</style>
@endpush
@endsection