@extends('home.layout')

@section('title', 'Sign Up - ShantoGiftShop')

@section('content')
<!-- Sign Up Section -->
<div class="auth-container" style="margin-top: 90px; ">
    <!-- Left Side Image -->
    <div class="auth-image">
        <img src="{{ asset('images/Frame-2.png') }}" alt="Side Image">
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