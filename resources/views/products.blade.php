@extends('home.layout')

@section('title','Products - ShantoGiftShop')

@section('content')

<!-- Product Listing Section -->
<div class="container products-page-layout" style="margin-top: 90px;">

    <!-- Sidebar Filters -->
    <aside class="sidebar">
        <!-- Categories -->
        <div class="sidebar-section">
            <h3 class="sidebar-title">Category</h3>
            <ul class="category-list">
                <li><a href="#">Woman's Fashion</a></li>
                <li><a href="#">Men's Fashion</a></li>
                <li><a href="#">Electronics</a></li>
                <li><a href="#">Home & Lifestyle</a></li>
                <li><a href="#">Medicine</a></li>
                <li><a href="#">Sports & Outdoor</a></li>
                <li><a href="#">Baby's & Toys</a></li>
                <li><a href="#">Groceries & Pets</a></li>
                <li><a href="#">Health & Beauty</a></li>
            </ul>
        </div>

        <!-- Price Range -->
        <div class="sidebar-section">
            <h3 class="sidebar-title">Price Range</h3>
            <div class="price-inputs">
                <input type="number" placeholder="Min" min="0">
                <input type="number" placeholder="Max" min="0">
            </div>
            <button class="apply-price-btn">Apply</button>
        </div>

        <!-- Color Filter -->
        <div class="sidebar-section">
            <h3 class="sidebar-title">Color</h3>
            <div class="color-options">
                <div class="color-option selected" style="background-color: #DB4444;"></div> <!-- Red -->
                <div class="color-option" style="background-color: #000000;"></div> <!-- Black -->
                <div class="color-option" style="background-color: #FFFFFF;"></div> <!-- White -->
                <div class="color-option" style="background-color: #00FF66;"></div> <!-- Green -->
                <div class="color-option" style="background-color: #0000FF;"></div> <!-- Blue -->
            </div>
        </div>
    </aside>

    <!-- Product Grid Area -->
    <main class="products-content">
        <!-- Top Bar -->
        <div class="products-top-bar">
            <div class="results-count">
                Showing <span>1-9</span> of 100 results
            </div>
            <div class="sort-wrapper">
                <span>Sort By:</span>
                <select class="sort-select">
                    <option value="featured">Featured</option>
                    <option value="price-low">Price: Low to High</option>
                    <option value="price-high">Price: High to Low</option>
                    <option value="newest">Newest Arrivals</option>
                </select>
            </div>
        </div>

        <!-- Grid -->
        <div class="product-grid">

            <!-- Product 1 -->
            <div class="product-card">
                <div class="product-image">
                    <img src="https://via.placeholder.com/250x250/F5F5F5/000000?text=Product+1" alt="Product 1">
                    <span class="discount-badge">-40%</span>
                    <div class="card-actions">
                        <div class="action-btn"><i class="far fa-heart"></i></div>
                        <div class="action-btn"><i class="far fa-eye"></i></div>
                    </div>
                    <div class="add-to-cart-btn">Add To Cart</div>
                </div>
                <div class="product-info">
                    <h3>HAVIT HV-G92 Gamepad</h3>
                    <div class="product-price">
                        $120 <span class="old-price">$160</span>
                    </div>
                    <div class="product-rating">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <span>(88)</span>
                    </div>
                </div>
            </div>

            <!-- Product 2 -->
            <div class="product-card">
                <div class="product-image">
                    <img src="https://via.placeholder.com/250x250/F5F5F5/000000?text=Product+2" alt="Product 2">
                    <span class="discount-badge">-35%</span>
                    <div class="card-actions">
                        <div class="action-btn"><i class="far fa-heart"></i></div>
                        <div class="action-btn"><i class="far fa-eye"></i></div>
                    </div>
                    <div class="add-to-cart-btn">Add To Cart</div>
                </div>
                <div class="product-info">
                    <h3>AK-900 Wired Keyboard</h3>
                    <div class="product-price">
                        $960 <span class="old-price">$1160</span>
                    </div>
                    <div class="product-rating">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <span>(75)</span>
                    </div>
                </div>
            </div>

            <!-- Product 3 -->
            <div class="product-card">
                <div class="product-image">
                    <img src="https://via.placeholder.com/250x250/F5F5F5/000000?text=Product+3" alt="Product 3">
                    <span class="discount-badge">-30%</span>
                    <div class="card-actions">
                        <div class="action-btn"><i class="far fa-heart"></i></div>
                        <div class="action-btn"><i class="far fa-eye"></i></div>
                    </div>
                    <div class="add-to-cart-btn">Add To Cart</div>
                </div>
                <div class="product-info">
                    <h3>IPS LCD Gaming Monitor</h3>
                    <div class="product-price">
                        $370 <span class="old-price">$400</span>
                    </div>
                    <div class="product-rating">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <span>(99)</span>
                    </div>
                </div>
            </div>

            <!-- Product 4 -->
            <div class="product-card">
                <div class="product-image">
                    <img src="https://via.placeholder.com/250x250/F5F5F5/000000?text=Product+4" alt="Product 4">
                    <div class="card-actions">
                        <div class="action-btn"><i class="far fa-heart"></i></div>
                        <div class="action-btn"><i class="far fa-eye"></i></div>
                    </div>
                    <div class="add-to-cart-btn">Add To Cart</div>
                </div>
                <div class="product-info">
                    <h3>RGB Liquid CPU Cooler</h3>
                    <div class="product-price">
                        $160 <span class="old-price">$170</span>
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

            <!-- Product 5 -->
            <div class="product-card">
                <div class="product-image">
                    <img src="https://via.placeholder.com/250x250/F5F5F5/000000?text=Product+5" alt="Product 5">
                    <span class="new-badge">NEW</span>
                    <div class="card-actions">
                        <div class="action-btn"><i class="far fa-heart"></i></div>
                        <div class="action-btn"><i class="far fa-eye"></i></div>
                    </div>
                    <div class="add-to-cart-btn">Add To Cart</div>
                </div>
                <div class="product-info">
                    <h3>ASUS FHD Gaming Laptop</h3>
                    <div class="product-price">
                        $700
                    </div>
                    <div class="product-rating">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <span>(325)</span>
                    </div>
                </div>
            </div>

            <!-- Product 6 -->
            <div class="product-card">
                <div class="product-image">
                    <img src="https://via.placeholder.com/250x250/F5F5F5/000000?text=Product+6" alt="Product 6">
                    <div class="card-actions">
                        <div class="action-btn"><i class="far fa-heart"></i></div>
                        <div class="action-btn"><i class="far fa-eye"></i></div>
                    </div>
                    <div class="add-to-cart-btn">Add To Cart</div>
                </div>
                <div class="product-info">
                    <h3>Jr. Zoom Soccer Cleats</h3>
                    <div class="product-price">
                        $1160
                    </div>
                    <div class="product-rating">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <span>(35)</span>
                    </div>
                </div>
            </div>

            <!-- Product 7 -->
            <div class="product-card">
                <div class="product-image">
                    <img src="https://via.placeholder.com/250x250/F5F5F5/000000?text=Product+7" alt="Product 7">
                    <span class="new-badge">NEW</span>
                    <div class="card-actions">
                        <div class="action-btn"><i class="far fa-heart"></i></div>
                        <div class="action-btn"><i class="far fa-eye"></i></div>
                    </div>
                    <div class="add-to-cart-btn">Add To Cart</div>
                </div>
                <div class="product-info">
                    <h3>GP11 Shooter USB Gamepad</h3>
                    <div class="product-price">
                        $660
                    </div>
                    <div class="product-rating">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                        <span>(55)</span>
                    </div>
                </div>
            </div>

            <!-- Product 8 -->
            <div class="product-card">
                <div class="product-image">
                    <img src="https://via.placeholder.com/250x250/F5F5F5/000000?text=Product+8" alt="Product 8">
                    <div class="card-actions">
                        <div class="action-btn"><i class="far fa-heart"></i></div>
                        <div class="action-btn"><i class="far fa-eye"></i></div>
                    </div>
                    <div class="add-to-cart-btn">Add To Cart</div>
                </div>
                <div class="product-info">
                    <h3>Quilted Satin Jacket</h3>
                    <div class="product-price">
                        $660
                    </div>
                    <div class="product-rating">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <span>(55)</span>
                    </div>
                </div>
            </div>

            <!-- Product 9 -->
            <div class="product-card">
                <div class="product-image">
                    <img src="https://via.placeholder.com/250x250/F5F5F5/000000?text=Product+9" alt="Product 9">
                    <div class="card-actions">
                        <div class="action-btn"><i class="far fa-heart"></i></div>
                        <div class="action-btn"><i class="far fa-eye"></i></div>
                    </div>
                    <div class="add-to-cart-btn">Add To Cart</div>
                </div>
                <div class="product-info">
                    <h3>Breed Dry Dog Food</h3>
                    <div class="product-price">
                        $100
                    </div>
                    <div class="product-rating">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                        <span>(35)</span>
                    </div>
                </div>
            </div>

        </div>

        <!-- Pagination -->
        <div class="pagination">
            <div class="page-item active">1</div>
            <div class="page-item">2</div>
            <div class="page-item">3</div>
            <div class="page-item next">Next ></div>
        </div>

    </main>
</div>

<script>
// Simple Interaction Logic
document.addEventListener('DOMContentLoaded', function() {

    // Language Selector Toggle
    const langSelector = document.querySelector('.language-selector');
    const langDropdown = document.querySelector('.lang-dropdown');
    if (langSelector && langDropdown) {
        langSelector.addEventListener('click', function(e) {
            e.stopPropagation();
            langDropdown.style.display = langDropdown.style.display === 'block' ? 'none' : 'block';
        });
        document.addEventListener('click', function() {
            langDropdown.style.display = 'none';
        });
    }

    // Size Selection Logic
    const sizeOptions = document.querySelectorAll('.size-option');
    sizeOptions.forEach(option => {
        option.addEventListener('click', function() {
            sizeOptions.forEach(opt => opt.classList.remove('selected'));
            this.classList.add('selected');
        });
    });

    // Color Selection Logic
    const colorOptions = document.querySelectorAll('.color-option');
    colorOptions.forEach(option => {
        option.addEventListener('click', function() {
            colorOptions.forEach(opt => opt.classList.remove('selected'));
            this.classList.add('selected');
        });
    });

    // Add to Cart Interaction
    const addButtons = document.querySelectorAll('.add-to-cart-btn');
    addButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            alert('Product added to cart!');
        });
    });
});
</script>
@push('styles')
<style>
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

/* Top Header */
.top-header {
    background-color: var(--text-black);
    color: #FAFAFA;
    font-size: 14px;
    padding: 12px 0;
}

.top-header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.promo-text {
    flex: 1;
    text-align: center;
}

.shop-now-link {
    font-weight: 600;
    text-decoration: underline;
    margin-left: 8px;
    color: #FAFAFA;
}

.language-selector {
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 5px;
    position: relative;
}

/* Navbar */
.navbar {
    border-bottom: 1px solid #D9D9D9;
    padding-top: 40px;
    padding-bottom: 16px;
    background-color: #fff;
    position: sticky;
    top: 0;
    z-index: 1000;
}

.nav-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logo h1 {
    font-size: 24px;
    font-weight: 700;
    letter-spacing: 0.03em;
}

.nav-links {
    display: flex;
    gap: 48px;
}

.nav-links a {
    font-size: 16px;
    color: var(--text-black);
    position: relative;
    padding-bottom: 4px;
}

.nav-links a:hover, .nav-links a.active {
    color: var(--text-black);
    border-bottom: 1px solid var(--text-black); /* Active link styling */
}

.nav-actions {
    display: flex;
    align-items: center;
    gap: 24px;
}

.search-box {
    background-color: var(--bg-gray);
    padding: 7px 12px;
    border-radius: 4px;
    display: flex;
    align-items: center;
    width: 243px;
}

.search-box input {
    border: none;
    background: transparent;
    font-size: 12px;
    width: 100%;
    outline: none;
    color: var(--text-black);
}

.search-box button {
    border: none;
    background: transparent;
    cursor: pointer;
    font-size: 16px;
}

.icons {
    display: flex;
    gap: 16px;
}

.icons a {
    font-size: 20px;
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
   Product Page Styles
   ========================================= */

.products-page-layout {
    display: flex;
    gap: 30px;
    /* Space between sidebar and grid */
    margin-bottom: 140px;
}

/* Sidebar */
.sidebar {
    width: 250px;
    flex-shrink: 0;
}

.sidebar-section {
    margin-bottom: 40px;
}

.sidebar-title {
    font-size: 20px;
    font-weight: 700;
    margin-bottom: 24px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.category-list li {
    margin-bottom: 16px;
}

.category-list a {
    color: var(--text-black);
    font-size: 16px;
    display: flex;
    justify-content: space-between;
    /* If adding counts later */
}

.category-list a:hover {
    color: var(--primary-red);
}

/* Price Range Slider (Simulated UI) */
.price-inputs {
    display: flex;
    gap: 10px;
    margin-top: 16px;
}

.price-inputs input {
    width: 100%;
    padding: 8px;
    border: 1px solid #D9D9D9;
    border-radius: 4px;
    font-family: 'Poppins', sans-serif;
}

.apply-price-btn {
    margin-top: 10px;
    background-color: var(--primary-red);
    color: #fff;
    border: none;
    padding: 8px 16px;
    border-radius: 4px;
    cursor: pointer;
    width: 100%;
    font-weight: 500;
}

/* Color Filter */
.color-options {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}

.color-option {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    cursor: pointer;
    position: relative;
    border: 1px solid #ddd;
    /* For white */
}

.color-option.selected::after {
    content: '';
    position: absolute;
    top: -4px;
    left: -4px;
    right: -4px;
    bottom: -4px;
    border: 1px solid var(--primary-red);
    border-radius: 50%;
}

/* Size Filter */
.size-options {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}

.size-option {
    padding: 6px 12px;
    border: 1px solid #D9D9D9;
    border-radius: 4px;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.3s;
}

.size-option:hover,
.size-option.selected {
    background-color: var(--primary-red);
    color: #fff;
    border-color: var(--primary-red);
}


/* Main Product Grid Area */
.products-content {
    flex: 1;
}

/* Top Bar: Sorting & View */
.products-top-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 40px;
}

.results-count {
    font-size: 16px;
    color: var(--text-gray);
}

.results-count span {
    color: var(--text-black);
    font-weight: 500;
}

.sort-wrapper {
    display: flex;
    align-items: center;
    gap: 10px;
}

.sort-select {
    padding: 8px 12px;
    border: 1px solid #D9D9D9;
    border-radius: 4px;
    background-color: #fff;
    font-family: 'Poppins', sans-serif;
    cursor: pointer;
    outline: none;
}

/* Product Grid */
.product-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    /* 3 Columns default */
    gap: 30px;
    margin-bottom: 60px;
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

.add-to-cart-btn {
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
    transform: translateY(100%);
    transition: transform 0.3s ease-in-out;
}

.product-card:hover .add-to-cart-btn {
    transform: translateY(0);
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

/* Pagination */
.pagination {
    display: flex;
    justify-content: center;
    gap: 16px;
}

.page-item {
    width: 40px;
    height: 40px;
    border: 1px solid #D9D9D9;
    /* Default border */
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s;
}

.page-item:hover,
.page-item.active {
    background-color: var(--primary-red);
    color: #fff;
    border-color: var(--primary-red);
}

.page-item.next {
    width: auto;
    padding: 0 16px;
}




/* =========================================
   Better Full Responsive CSS
   Put this at the END of your CSS
   ========================================= */

/* Global responsive fixes */
* {
    box-sizing: border-box;
}

html,
body {
    overflow-x: hidden;
}

img {
    max-width: 100%;
    height: auto;
}

.products-page-layout,
.products-content,
.sidebar,
.product-grid,
.product-card,
.product-image,
.top-header-content,
.nav-content,
.nav-links,
.nav-actions,
.search-box,
.price-inputs,
.products-top-bar,
.sort-wrapper,
.pagination {
    min-width: 0;
}

/* Prevent fixed elements from breaking layout */
.product-info h3,
.category-list a,
.results-count,
.product-price,
.product-rating {
    word-wrap: break-word;
    overflow-wrap: break-word;
}

/* Add to cart default hidden */
.add-to-cart-btn {
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
    transform: translateY(100%);
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease-in-out;
}

/* Show on hover only */
.product-card:hover .add-to-cart-btn {
    transform: translateY(0);
    opacity: 1;
    visibility: visible;
}

/* =========================
   Large devices
   ========================= */
@media (max-width: 1200px) {
    .container {
        max-width: 100%;
        padding-left: 20px;
        padding-right: 20px;
    }

    .products-page-layout {
        gap: 24px;
    }

    .sidebar {
        width: 240px;
    }

    .product-grid {
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 24px;
    }

    .search-box {
        width: 220px;
    }

    .nav-links {
        gap: 28px;
    }
}

/* =========================
   Laptop / Tablet landscape
   ========================= */
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
        gap: 16px 24px;
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

    .products-page-layout {
        flex-direction: column;
        gap: 30px;
        margin-top: 50px !important;
        margin-bottom: 80px;
    }

    .sidebar {
        width: 100%;
    }

    .sidebar-section {
        margin-bottom: 28px;
    }

    .category-list {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px 20px;
    }

    .category-list li {
        margin-bottom: 0;
    }

    .price-inputs {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 10px;
    }

    .products-top-bar {
        flex-direction: column;
        align-items: flex-start;
        gap: 14px;
        margin-bottom: 28px;
    }

    .sort-wrapper {
        width: 100%;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
    }

    .sort-select {
        width: 220px;
        max-width: 100%;
    }

    .product-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 22px;
    }

    .product-image {
        height: 230px;
    }

    .pagination {
        flex-wrap: wrap;
    }
}

/* =========================
   Tablet portrait
   ========================= */
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

    .breadcrumb-container {
        margin-top: 35px;
        margin-bottom: 35px;
    }

    .sidebar-title {
        font-size: 18px;
        margin-bottom: 16px;
    }

    .category-list {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 10px 14px;
    }

    .category-list a {
        font-size: 15px;
    }

    .price-inputs input {
        padding: 10px;
    }

    .apply-price-btn {
        padding: 10px 16px;
    }

    .size-options,
    .color-options {
        gap: 10px;
    }

    .results-count {
        font-size: 15px;
    }

    .sort-wrapper {
        flex-direction: column;
        align-items: flex-start;
    }

    .sort-select {
        width: 100%;
    }

    .product-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
    }

    .product-image {
        height: 210px;
    }

    .product-info h3 {
        font-size: 15px;
        line-height: 1.4;
    }

    .product-price {
        gap: 8px;
        flex-wrap: wrap;
        font-size: 15px;
    }

    .product-rating {
        flex-wrap: wrap;
        font-size: 13px;
    }

    .page-item {
        width: 36px;
        height: 36px;
        font-size: 14px;
    }

    .page-item.next {
        width: auto;
        padding: 0 14px;
    }
}

/* =========================
   Mobile large
   ========================= */
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

    .products-page-layout {
        margin-top: 30px !important;
        margin-bottom: 60px;
        gap: 24px;
    }

    .sidebar-title {
        font-size: 17px;
    }

    .category-list {
        grid-template-columns: 1fr;
    }

    .price-inputs {
        grid-template-columns: 1fr;
    }

    .products-top-bar {
        margin-bottom: 22px;
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

    .discount-badge,
    .new-badge {
        font-size: 11px;
        padding: 4px 10px;
    }

    .card-actions {
        top: 10px;
        right: 10px;
        gap: 6px;
    }

    .action-btn {
        width: 32px;
        height: 32px;
        font-size: 14px;
    }

    .add-to-cart-btn {
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

    .pagination {
        gap: 8px;
        justify-content: center;
    }

    .page-item {
        width: 34px;
        height: 34px;
        font-size: 13px;
    }

    .page-item.next {
        padding: 0 12px;
    }
}

/* =========================
   Small mobile
   ========================= */
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

    .sidebar-title {
        font-size: 16px;
    }

    .category-list a {
        font-size: 14px;
    }

    .size-option {
        padding: 5px 10px;
        font-size: 12px;
    }

    .product-image {
        height: 210px;
    }

    .product-info h3 {
        font-size: 14px;
    }

    .results-count,
    .product-price,
    .product-rating {
        font-size: 12px;
    }

    .sort-wrapper span {
        font-size: 13px;
    }

    .sort-select {
        font-size: 13px;
        padding: 8px 10px;
    }

    .page-item {
        width: 32px;
        height: 32px;
        font-size: 12px;
    }
}

/* =========================
   Extra small mobile
   ========================= */
@media (max-width: 360px) {
    .product-image {
        height: 190px;
    }

    .discount-badge,
    .new-badge {
        font-size: 10px;
        padding: 3px 8px;
    }

    .action-btn {
        width: 30px;
        height: 30px;
        font-size: 13px;
    }

    .add-to-cart-btn {
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