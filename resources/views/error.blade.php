@extends('home.layout')

@section('title', '404 Error - ShantoGiftShop')

@section('content')
<!-- Breadcrumb -->
<div class="container breadcrumb-container" style="margin-top: 90px;">
    <div class="breadcrumb">
        <a href="index.html">Home</a>
        <span class="separator">/</span>
        <span class="current">404 Error</span>
    </div>
</div>

<!-- 404 Section -->
<section class="error-page-section container" style="margin-top: 50px;">
    <h1 class="error-heading">404 Not Found</h1>
    <p class="error-text">Your visited page not found. You may go home page.</p>
    <button class="btn-primary" a onclick="window.location.href='{{ route('home') }}'">Back to home page</button>
</section>

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

.container {
    max-width: 1170px;
    margin: 0 auto;
    padding: 0 15px;
}

/* Typography & Colors */
:root {
    --primary-red: #DB4444;
    --text-black: #000000;
    --text-gray: #7D8184; /* For secondary text */
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
    border: 1px solid rgba(0,0,0,0.4);
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

/* Responsive Styles */
@media (max-width: 1024px) {
    .auth-container {
        flex-direction: column;
        gap: 60px;
    }
    
    .auth-image {
        width: 100%;
        height: 400px; /* Reduced height for mobile/tablet */
    }
    
    .auth-form-wrapper {
        max-width: 100%;
        padding: 0 20px;
    }
    
    .product-details-container {
        flex-direction: column;
    }
    
    .product-gallery {
        flex-direction: column-reverse; /* Thumbnails below main image */
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
    
    .app-download-area, .social-icons {
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