@extends('home.layout')

@section('title','Wishlist - ShantoGiftShop')

@section('content')
<!-- Wishlist Section -->
<section class="wishlist-section container" style="margin-top: 50px;">
    <div class="breadcrumb-container" style="margin-top: 40px; margin-bottom: 40px;">
        <!-- Simple spacing or breadcrumb if needed, otherwise just margin -->
    </div>

    <div class="wishlist-header">
        <h2 class="wishlist-title">Wishlist (<span>4</span>)</h2>
        <button class="move-all-btn">Move All To Bag</button>
    </div>

    <div class="product-grid" id="wishlist-grid">

        <!-- Wishlist Item 1 -->
        <div class="product-card">
            <div class="product-image">
                <img src="https://via.placeholder.com/250x250/F5F5F5/000000?text=Product+1" alt="Gucci Duffle Bag">
                <span class="discount-badge">-35%</span>
                <button class="trash-btn"><i class="far fa-trash-alt"></i></button>
                <div class="add-to-cart-bar"><i class="fas fa-shopping-cart"></i> Add To Cart</div>
            </div>
            <div class="product-info">
                <h3>Gucci Duffle Bag</h3>
                <div class="product-price">
                    $960 <span class="old-price">$1160</span>
                </div>
            </div>
        </div>

        <!-- Wishlist Item 2 -->
        <div class="product-card">
            <div class="product-image">
                <img src="https://via.placeholder.com/250x250/F5F5F5/000000?text=Product+2" alt="RGB Liquid CPU Cooler">
                <button class="trash-btn"><i class="far fa-trash-alt"></i></button>
                <div class="add-to-cart-bar"><i class="fas fa-shopping-cart"></i> Add To Cart</div>
            </div>
            <div class="product-info">
                <h3>RGB Liquid CPU Cooler</h3>
                <div class="product-price">
                    $1960
                </div>
            </div>
        </div>

        <!-- Wishlist Item 3 -->
        <div class="product-card">
            <div class="product-image">
                <img src="https://via.placeholder.com/250x250/F5F5F5/000000?text=Product+3"
                    alt="GP11 Shooter USB Gamepad">
                <button class="trash-btn"><i class="far fa-trash-alt"></i></button>
                <div class="add-to-cart-bar"><i class="fas fa-shopping-cart"></i> Add To Cart</div>
            </div>
            <div class="product-info">
                <h3>GP11 Shooter USB Gamepad</h3>
                <div class="product-price">
                    $550
                </div>
            </div>
        </div>

        <!-- Wishlist Item 4 -->
        <div class="product-card">
            <div class="product-image">
                <img src="https://via.placeholder.com/250x250/F5F5F5/000000?text=Product+4" alt="Quilted Satin Jacket">
                <button class="trash-btn"><i class="far fa-trash-alt"></i></button>
                <div class="add-to-cart-bar"><i class="fas fa-shopping-cart"></i> Add To Cart</div>
            </div>
            <div class="product-info">
                <h3>Quilted Satin Jacket</h3>
                <div class="product-price">
                    $750
                </div>
            </div>
        </div>

    </div>
</section>


<!-- Just For You Section -->
<section class="just-for-you-section container">
    <div class="section-header">
        <div class="section-title">
            <div class="red-block"></div>
            <h2>Just For You</h2>
        </div>
        <button class="see-all-btn">See All</button>
    </div>

    <div class="product-grid">

        <!-- Recommendation 1 -->
        <div class="product-card">
            <div class="product-image">
                <img src="https://via.placeholder.com/250x250/F5F5F5/000000?text=Rec+1" alt="ASUS FHD Gaming Laptop">
                <span class="discount-badge">-35%</span>
                <button class="eye-btn"><i class="far fa-eye"></i></button>
                <div class="add-to-cart-bar"><i class="fas fa-shopping-cart"></i> Add To Cart</div>
            </div>
            <div class="product-info">
                <h3>ASUS FHD Gaming Laptop</h3>
                <div class="product-price">
                    $960 <span class="old-price">$1160</span>
                </div>
                <div class="product-rating">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <span>(65)</span>
                </div>
            </div>
        </div>

        <!-- Recommendation 2 -->
        <div class="product-card">
            <div class="product-image">
                <img src="https://via.placeholder.com/250x250/F5F5F5/000000?text=Rec+2" alt="IPS LCD Gaming Monitor">
                <button class="eye-btn"><i class="far fa-eye"></i></button>
                <div class="add-to-cart-bar"><i class="fas fa-shopping-cart"></i> Add To Cart</div>
            </div>
            <div class="product-info">
                <h3>IPS LCD Gaming Monitor</h3>
                <div class="product-price">
                    $1160
                </div>
                <div class="product-rating">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <span>(65)</span>
                </div>
            </div>
        </div>

        <!-- Recommendation 3 -->
        <div class="product-card">
            <div class="product-image">
                <img src="https://via.placeholder.com/250x250/F5F5F5/000000?text=Rec+3" alt="HAVIT HV-G92 Gamepad">
                <span class="new-badge">NEW</span>
                <button class="eye-btn"><i class="far fa-eye"></i></button>
                <div class="add-to-cart-bar"><i class="fas fa-shopping-cart"></i> Add To Cart</div>
            </div>
            <div class="product-info">
                <h3>HAVIT HV-G92 Gamepad</h3>
                <div class="product-price">
                    $560
                </div>
                <div class="product-rating">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <span>(65)</span>
                </div>
            </div>
        </div>

        <!-- Recommendation 4 -->
        <div class="product-card">
            <div class="product-image">
                <img src="https://via.placeholder.com/250x250/F5F5F5/000000?text=Rec+4" alt="AK-900 Wired Keyboard">
                <button class="eye-btn"><i class="far fa-eye"></i></button>
                <div class="add-to-cart-bar"><i class="fas fa-shopping-cart"></i> Add To Cart</div>
            </div>
            <div class="product-info">
                <h3>AK-900 Wired Keyboard</h3>
                <div class="product-price">
                    $200
                </div>
                <div class="product-rating">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                    </div>
                    <span>(65)</span>
                </div>
            </div>
        </div>

    </div>
</section>



@push('styles')
<style>
/* Typography & Colors */
:root {
    --primary-red: #DB4444;
    --text-black: #000000;
    --text-gray: #7D8184; /* For secondary text */
    --bg-gray: #F5F5F5;
    --white: #FFFFFF;
}


.wishlist-count {
    position: absolute;
    top: -8px;
    right: -8px;
    background-color: var(--primary-red);
    color: #fff;
    font-size: 12px;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
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


/* =========================================
   Wishlist Page Styles
   ========================================= */

.wishlist-section {
    margin-bottom: 80px;
}

.wishlist-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 60px;
}

.wishlist-title {
    font-size: 20px;
    font-weight: 400;
}

.wishlist-title span {
    font-weight: 500;
}

.move-all-btn {
    background-color: transparent;
    border: 1px solid rgba(0,0,0,0.5);
    padding: 16px 48px;
    font-family: 'Poppins', sans-serif;
    font-weight: 500;
    font-size: 16px;
    border-radius: 4px;
    cursor: pointer;
    transition: all 0.3s;
}

.move-all-btn:hover {
    background-color: var(--text-black);
    color: #fff;
    border-color: var(--text-black);
}

/* Product Grid (Reusable) */
.product-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr); /* 4 Columns Default */
    gap: 30px;
}

/* Product Card */
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

.new-badge {
    position: absolute;
    top: 12px;
    left: 12px;
    background-color: #00FF66;
    color: #fff;
    padding: 4px 12px;
    border-radius: 4px;
    font-size: 12px;
}

/* Trash Icon (Top Right) */
.trash-btn {
    position: absolute;
    top: 12px;
    right: 12px;
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
    border: none;
}

.trash-btn:hover {
    background-color: var(--primary-red);
    color: #fff;
}

/* Add To Cart Button (Black Bar at Bottom) */
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
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: background-color 0.3s;
}

.add-to-cart-bar:hover {
    background-color: #333;
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


/* Just For You Section */
.just-for-you-section {
    margin-bottom: 140px;
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 60px;
}

.section-title {
    display: flex;
    align-items: center;
    gap: 16px;
}

.red-block {
    width: 20px;
    height: 40px;
    background-color: var(--primary-red);
    border-radius: 4px;
}

.section-title h2 {
    font-size: 20px; /* Or standard section title size */
    font-weight: 400;
}

.see-all-btn {
    background-color: transparent;
    border: 1px solid rgba(0,0,0,0.5);
    padding: 16px 48px;
    font-family: 'Poppins', sans-serif;
    font-weight: 500;
    font-size: 16px;
    border-radius: 4px;
    cursor: pointer;
    transition: all 0.3s;
}

.see-all-btn:hover {
    background-color: var(--text-black);
    color: #fff;
    border-color: var(--text-black);
}

/* Just For You Specific Card Actions (Eye Icon) */
.eye-btn {
    position: absolute;
    top: 12px; /* Adjusted position if needed */
    right: 12px;
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

.eye-btn:hover {
    background-color: var(--bg-gray); /* Just hover effect */
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
/* Just For You Specific Card Actions (Eye Icon) */
.eye-btn {
    position: absolute;
    top: 12px; /* Adjusted position if needed */
    right: 12px;
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




/* =========================================
   Full Updated Responsive CSS for Wishlist Page
   Put this at the END of your current CSS
   ========================================= */

img {
    max-width: 100%;
    height: auto;
    display: block;
}

.wishlist-section,
.just-for-you-section,
.wishlist-header,
.section-header,
.section-title,
.top-header-content,
.nav-content,
.nav-links,
.nav-actions,
.search-box,
.product-grid,
.product-card,
.product-image,
.product-info,
.product-price,
.product-rating {
    min-width: 0;
}

.product-info h3,
.product-price,
.product-rating,
.section-title h2,
.wishlist-title {
    overflow-wrap: break-word;
    word-wrap: break-word;
}

/* Header button alignment fix */
.wishlist-header,
.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    flex-wrap: wrap;
}

.wishlist-title,
.section-title {
    min-width: 0;
}

.move-all-btn,
.see-all-btn {
    flex-shrink: 0;
    white-space: nowrap;
    text-align: center;
}

/* Large Desktop / Small Laptop */
@media (max-width: 1200px) {
    .container {
        max-width: 100%;
        padding-left: 20px;
        padding-right: 20px;
    }

    .nav-links {
        gap: 28px;
    }

    .nav-actions {
        gap: 18px;
    }

    .search-box {
        width: 220px;
    }

    .product-grid {
        gap: 24px;
    }

    .move-all-btn,
    .see-all-btn {
        padding: 14px 36px;
    }
}

/* Laptop / Tablet Landscape */
@media (max-width: 992px) {
    .container {
        padding-left: 18px;
        padding-right: 18px;
    }

    .top-header-content {
        flex-wrap: wrap;
        justify-content: center;
        gap: 10px;
        text-align: center;
    }

    .promo-text {
        flex: unset;
        width: 100%;
        text-align: center;
    }

    .language-selector {
        justify-content: center;
    }

    .navbar {
        padding-top: 20px;
        padding-bottom: 14px;
    }

    .nav-content {
        flex-direction: column;
        align-items: stretch;
        gap: 18px;
    }

    .logo {
        text-align: center;
    }

    .nav-links {
        justify-content: center;
        flex-wrap: wrap;
        gap: 14px 22px;
    }

    .nav-actions {
        justify-content: center;
        flex-wrap: wrap;
        gap: 14px;
    }

    .search-box {
        width: 100%;
        max-width: 340px;
    }

    .breadcrumb-container {
        margin-top: 30px !important;
        margin-bottom: 30px !important;
    }

    .wishlist-section {
        margin-bottom: 70px;
    }

    .wishlist-header {
        gap: 16px;
        margin-bottom: 36px;
    }

    .wishlist-title,
    .section-title {
        flex: 1 1 auto;
    }

    .product-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 22px;
    }

    .product-image {
        height: 230px;
    }

    .section-header {
        gap: 16px;
        margin-bottom: 36px;
    }

    .just-for-you-section {
        margin-bottom: 90px;
    }

    .move-all-btn,
    .see-all-btn {
        width: auto;
        padding: 13px 28px;
        font-size: 15px;
    }
}

/* Tablet Portrait */
@media (max-width: 768px) {
    .container {
        padding-left: 16px;
        padding-right: 16px;
    }

    .top-header {
        font-size: 13px;
        padding: 10px 0;
    }

    .logo h1 {
        font-size: 22px;
    }

    .nav-links {
        gap: 12px 18px;
    }

    .nav-links a {
        font-size: 15px;
    }

    .icons {
        gap: 12px;
    }

    .icons a {
        font-size: 18px;
    }

    .wishlist-header,
    .section-header {
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        flex-wrap: wrap;
    }

    .wishlist-title,
    .section-title h2 {
        font-size: 18px;
    }

    .section-title {
        gap: 12px;
    }

    .red-block {
        width: 16px;
        height: 34px;
    }

    .move-all-btn,
    .see-all-btn {
        width: auto;
        padding: 12px 20px;
        font-size: 14px;
    }

    .product-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
    }

    .product-image {
        height: 210px;
    }

    .discount-badge,
    .new-badge {
        font-size: 11px;
        padding: 4px 10px;
    }

    .trash-btn,
    .eye-btn {
        width: 32px;
        height: 32px;
        font-size: 14px;
        top: 10px;
        right: 10px;
    }

    .add-to-cart-bar {
        font-size: 14px;
        padding: 10px 0;
        gap: 6px;
    }

    .product-info h3 {
        font-size: 15px;
        line-height: 1.4;
    }

    .product-price {
        font-size: 15px;
        gap: 8px;
        flex-wrap: wrap;
    }

    .product-rating {
        font-size: 13px;
        flex-wrap: wrap;
    }
}

/* Mobile Large */
@media (max-width: 576px) {
    .container {
        padding-left: 14px;
        padding-right: 14px;
    }

    .top-header-content {
        gap: 8px;
    }

    .promo-text {
        font-size: 12px;
        line-height: 1.5;
    }

    .shop-now-link {
        margin-left: 4px;
    }

    .navbar {
        padding-top: 16px;
        padding-bottom: 12px;
    }

    .logo h1 {
        font-size: 20px;
    }

    .nav-content {
        gap: 14px;
    }

    .nav-links {
        gap: 10px 14px;
    }

    .nav-links a {
        font-size: 14px;
    }

    .nav-actions {
        gap: 12px;
    }

    .search-box {
        width: 100%;
        max-width: 100%;
        padding: 8px 10px;
    }

    .search-box input {
        font-size: 12px;
    }

    .wishlist-section {
        margin-bottom: 50px;
    }

    .wishlist-header {
        margin-bottom: 28px;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
    }

    .wishlist-title {
        font-size: 17px;
        flex: 1 1 100%;
    }

    .section-header {
        margin-bottom: 28px;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
    }

    .section-title {
        flex: 1 1 100%;
    }

    .section-title h2 {
        font-size: 17px;
    }

    .product-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }

    .product-card {
        width: 100%;
    }

    .product-image {
        width: 100%;
        height: 240px;
    }

    .product-image img {
        max-height: 75%;
    }

    .add-to-cart-bar {
        font-size: 14px;
        padding: 12px 0;
    }

    .product-info h3 {
        font-size: 15px;
    }

    .product-price {
        font-size: 14px;
    }

    .product-rating {
        font-size: 12px;
    }

    .move-all-btn,
    .see-all-btn {
        width: auto;
        max-width: 100%;
        padding: 11px 18px;
        font-size: 13px;
        align-self: flex-start;
    }

    .just-for-you-section {
        margin-bottom: 60px;
    }
}

/* Small Mobile */
@media (max-width: 420px) {
    .container {
        padding-left: 12px;
        padding-right: 12px;
    }

    .top-header {
        font-size: 12px;
    }

    .logo h1 {
        font-size: 18px;
    }

    .nav-links {
        gap: 8px 12px;
    }

    .nav-links a {
        font-size: 13px;
    }

    .icons a {
        font-size: 16px;
    }

    .wishlist-header,
    .section-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .wishlist-title,
    .section-title h2 {
        font-size: 16px;
    }

    .red-block {
        width: 14px;
        height: 30px;
    }

    .product-image {
        height: 210px;
    }

    .product-info h3 {
        font-size: 14px;
    }

    .product-price,
    .product-rating {
        font-size: 12px;
    }

    .move-all-btn,
    .see-all-btn {
        width: 100%;
        font-size: 13px;
        padding: 11px 16px;
    }

    .wishlist-count {
        width: 16px;
        height: 16px;
        font-size: 10px;
        top: -6px;
        right: -6px;
    }
}

/* Extra Small Mobile */
@media (max-width: 360px) {
    .product-image {
        height: 190px;
    }

    .discount-badge,
    .new-badge {
        font-size: 10px;
        padding: 3px 8px;
    }

    .trash-btn,
    .eye-btn {
        width: 30px;
        height: 30px;
        font-size: 13px;
    }

    .add-to-cart-bar {
        font-size: 13px;
        padding: 10px 0;
    }

    .product-info h3 {
        font-size: 13px;
    }
}
</style>
@endpush
@endsection