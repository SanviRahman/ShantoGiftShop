@extends('home.layout')

@section('title', 'Cart - ShantoGiftShop')

@section('content')
<!-- Cart Section -->
<section class="cart-section container">

    <!-- Cart Table -->
    <div class="cart-table-wrapper">
        <!-- Header Row -->
        <div class="cart-header">
            <div class="header-col">Product</div>
            <div class="header-col">Price</div>
            <div class="header-col">Quantity</div>
            <div class="header-col" style="text-align: right;">Subtotal</div>
        </div>

        <!-- Item 1 -->
        <div class="cart-item" data-price="650">
            <div class="product-col">
                <div class="remove-icon"><i class="fas fa-times"></i></div>
                <img src="https://via.placeholder.com/50x50/F5F5F5/000000?text=Monitor" alt="LCD Monitor"
                    class="product-thumb">
                <span class="product-name">LCD Monitor</span>
            </div>
            <div class="price-col">$650</div>
            <div class="quantity-col">
                <input type="number" value="1" min="1" class="quantity-input">
            </div>
            <div class="subtotal-col" style="text-align: right;">$650</div>
        </div>

        <!-- Item 2 -->
        <div class="cart-item" data-price="550">
            <div class="product-col">
                <div class="remove-icon"><i class="fas fa-times"></i></div>
                <img src="https://via.placeholder.com/50x50/F5F5F5/000000?text=Gamepad" alt="H1 Gamepad"
                    class="product-thumb">
                <span class="product-name">H1 Gamepad</span>
            </div>
            <div class="price-col">$550</div>
            <div class="quantity-col">
                <input type="number" value="2" min="1" class="quantity-input">
            </div>
            <div class="subtotal-col" style="text-align: right;">$1100</div>
        </div>
    </div>

    <!-- Cart Actions -->
    <div class="cart-actions">
        <button class="btn-secondary" onclick="window.location.href='index.html'">Return To Shop</button>
        <button class="btn-secondary update-cart-btn">Update Cart</button>
    </div>

    <!-- Coupon & Total -->
    <div class="cart-bottom-section">
        <div class="coupon-section">
            <input type="text" placeholder="Coupon Code" class="coupon-input">
            <button class="btn-primary">Apply Coupon</button>
        </div>

        <div class="cart-total-box">
            <h3 class="cart-total-title">Cart Total</h3>
            <div class="total-row">
                <span>Subtotal:</span>
                <span class="cart-subtotal">$1750</span>
            </div>
            <div class="total-row">
                <span>Shipping:</span>
                <span>Free</span>
            </div>
            <div class="total-row">
                <span>Total:</span>
                <span class="cart-total">$1750</span>
            </div>
            <div class="checkout-btn-wrapper">
                <button class="btn-primary" onclick="alert('Proceeding to checkout...')">Procees to checkout</button>
            </div>
        </div>
    </div>
</section>
<script>
document.addEventListener('DOMContentLoaded', function() {

    // Initial Calculation
    updateCartTotals();

    // Quantity Change Listener
    const quantityInputs = document.querySelectorAll('.quantity-input');
    quantityInputs.forEach(input => {
        input.addEventListener('change', function() {
            if (this.value < 1) this.value = 1;
            updateItemSubtotal(this);
            updateCartTotals();
        });

        // Optional: Update on input for real-time feel
        input.addEventListener('input', function() {
            if (this.value >= 1) {
                updateItemSubtotal(this);
                updateCartTotals(); // Only update totals if valid
            }
        });
    });

    // Remove Item Listener
    const removeIcons = document.querySelectorAll('.remove-icon');
    removeIcons.forEach(icon => {
        icon.addEventListener('click', function() {
            const item = this.closest('.cart-item');
            item.style.opacity = '0';
            setTimeout(() => {
                item.remove();
                updateCartTotals();
                updateCartCount();
            }, 300);
        });
    });

    // Update Cart Button (Simulated)
    const updateBtn = document.querySelector('.update-cart-btn');
    if (updateBtn) {
        updateBtn.addEventListener('click', function() {
            alert('Cart updated successfully!');
        });
    }

    function updateItemSubtotal(input) {
        const item = input.closest('.cart-item');
        const price = parseFloat(item.dataset.price);
        const quantity = parseInt(input.value);
        const subtotalElement = item.querySelector('.subtotal-col');
        const subtotal = price * quantity;
        subtotalElement.textContent = '$' + subtotal;
    }

    function updateCartTotals() {
        let total = 0;
        const items = document.querySelectorAll('.cart-item');

        items.forEach(item => {
            const price = parseFloat(item.dataset.price);
            const quantity = parseInt(item.querySelector('.quantity-input').value);
            total += price * quantity;
        });

        const subtotalEl = document.querySelector('.cart-subtotal');
        const totalEl = document.querySelector('.cart-total');

        if (subtotalEl) subtotalEl.textContent = '$' + total;
        if (totalEl) totalEl.textContent = '$' + total;
    }

    function updateCartCount() {
        const count = document.querySelectorAll('.cart-item').length;
        const badge = document.querySelector('.cart-count');
        if (badge) badge.textContent = count;
    }

    // Language Selector Logic (Reused)
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

.lang-dropdown {
    display: none;
    position: absolute;
    top: 100%;
    right: 0;
    background-color: #000;
    color: #fff;
    padding: 10px;
    z-index: 1000;
    border: 1px solid #333;
    min-width: 120px;
}

.lang-dropdown li {
    padding: 5px 10px;
}

.lang-dropdown li:hover {
    background-color: #333;
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
    position: relative;
}

.cart-count {
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
   Cart Page Styles
   ========================================= */

.cart-section {
    margin-bottom: 140px;
}

/* Cart Table/Grid */
.cart-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 24px;
}

.cart-header {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1fr; /* Product, Price, Quantity, Subtotal */
    padding: 24px 40px;
    background-color: #fff;
    box-shadow: 0px 1px 13px rgba(0, 0, 0, 0.05);
    border-radius: 4px;
    margin-bottom: 40px;
    font-weight: 500;
    align-items: center;
}

.cart-item {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1fr;
    padding: 24px 40px;
    background-color: #fff;
    box-shadow: 0px 1px 13px rgba(0, 0, 0, 0.05);
    border-radius: 4px;
    margin-bottom: 24px; /* Space between rows */
    align-items: center;
    position: relative;
}

.product-col {
    display: flex;
    align-items: center;
    gap: 20px;
    position: relative;
}

.remove-icon {
    position: absolute;
    top: -12px;
    left: -12px;
    background-color: var(--primary-red);
    color: #fff;
    width: 18px; /* Small icon per design */
    height: 18px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 10px;
    cursor: pointer;
    opacity: 0; /* Hidden initially or show on hover */
    transition: opacity 0.3s;
}

.product-col:hover .remove-icon {
    opacity: 1;
}

.product-thumb {
    width: 50px;
    height: 50px;
    object-fit: contain;
}

.quantity-col {
    display: flex;
    align-items: center;
}

.quantity-input {
    width: 70px;
    padding: 6px 12px;
    border: 1px solid #000;
    border-radius: 4px;
    text-align: center;
    font-family: 'Poppins', sans-serif;
    font-size: 16px;
    /* Hide spin buttons */
    -moz-appearance: textfield;
}

.quantity-input::-webkit-outer-spin-button,
.quantity-input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* Cart Actions (Return / Update) */
.cart-actions {
    display: flex;
    justify-content: space-between;
    margin-bottom: 80px;
}

.btn-secondary {
    padding: 16px 48px;
    border: 1px solid rgba(0, 0, 0, 0.5);
    background-color: transparent;
    border-radius: 4px;
    font-family: 'Poppins', sans-serif;
    font-weight: 500;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s;
}

.btn-secondary:hover {
    background-color: var(--text-black);
    color: #fff;
    border-color: var(--text-black);
}

/* Coupon & Cart Total Layout */
.cart-bottom-section {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 30px;
}

/* Coupon */
.coupon-section {
    display: flex;
    gap: 16px;
    flex: 1;
    max-width: 527px; /* Per design roughly */
}

.coupon-input {
    flex: 1;
    padding: 16px 24px;
    border: 1px solid #000;
    border-radius: 4px;
    font-family: 'Poppins', sans-serif;
    outline: none;
}

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
}

.btn-primary:hover {
    background-color: #E07575; /* Slightly lighter red */
}

/* Cart Total Box */
.cart-total-box {
    width: 470px; /* Fixed width per design */
    border: 1.5px solid #000;
    border-radius: 4px;
    padding: 32px 24px;
}

.cart-total-title {
    font-size: 20px;
    font-weight: 500;
    margin-bottom: 24px;
}

.total-row {
    display: flex;
    justify-content: space-between;
    padding-bottom: 16px;
    margin-bottom: 16px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.4);
    font-size: 16px;
}

.total-row:last-of-type {
    border-bottom: none;
    margin-bottom: 0;
}

.checkout-btn-wrapper {
    margin-top: 16px;
    display: flex;
    justify-content: center; /* Center the button */
}

.checkout-btn {
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
}






/* =========================================
   Responsive CSS
   ========================================= */

/* Large Desktop / Laptop */
@media (max-width: 1199px) {
    .container {
        max-width: 100%;
        padding: 0 20px;
    }

    .nav-links {
        gap: 28px;
    }

    .nav-actions {
        gap: 16px;
    }

    .search-box {
        width: 200px;
    }

    .cart-header,
    .cart-item {
        padding: 20px 24px;
    }

    .cart-total-box {
        width: 420px;
    }
}

/* Tablet */
@media (max-width: 991px) {
    .top-header-content {
        flex-direction: column;
        gap: 10px;
        text-align: center;
    }

    .promo-text {
        text-align: center;
    }

    .nav-content {
        flex-wrap: wrap;
        gap: 20px;
    }

    .logo {
        width: 100%;
        text-align: center;
    }

    .nav-links {
        width: 100%;
        justify-content: center;
        flex-wrap: wrap;
        gap: 18px;
    }

    .nav-actions {
        width: 100%;
        justify-content: center;
        flex-wrap: wrap;
    }

    .search-box {
        width: 100%;
        max-width: 350px;
    }

    .breadcrumb-container {
        margin-top: 50px;
        margin-bottom: 50px;
    }

    .cart-section {
        margin-bottom: 80px;
    }

    .cart-header {
        grid-template-columns: 2fr 1fr 1fr 1fr;
        padding: 18px 16px;
        font-size: 15px;
    }

    .cart-item {
        grid-template-columns: 2fr 1fr 1fr 1fr;
        padding: 18px 16px;
        gap: 12px;
    }

    .product-col {
        gap: 12px;
    }

    .product-name {
        font-size: 14px;
    }

    .quantity-input {
        width: 60px;
        padding: 6px 8px;
        font-size: 14px;
    }

    .cart-actions {
        flex-direction: column;
        gap: 16px;
        margin-bottom: 50px;
    }

    .cart-actions .btn-secondary {
        width: 100%;
        text-align: center;
    }

    .cart-bottom-section {
        flex-direction: column;
        gap: 30px;
    }

    .coupon-section {
        max-width: 100%;
        width: 100%;
    }

    .cart-total-box {
        width: 100%;
    }
}

/* Mobile Large */
@media (max-width: 767px) {
    .top-header {
        font-size: 12px;
        padding: 10px 0;
    }

    .language-selector {
        justify-content: center;
    }

    .navbar {
        padding-top: 20px;
        padding-bottom: 12px;
    }

    .logo h1 {
        font-size: 22px;
    }

    .nav-links {
        gap: 12px;
    }

    .nav-links a {
        font-size: 14px;
    }

    .nav-actions {
        gap: 12px;
    }

    .icons a {
        font-size: 18px;
    }

    .cart-count {
        width: 16px;
        height: 16px;
        font-size: 10px;
        top: -6px;
        right: -6px;
    }

    .breadcrumb-container {
        margin-top: 35px;
        margin-bottom: 35px;
    }

    .cart-header {
        display: none;
    }

    .cart-item {
        grid-template-columns: 1fr;
        padding: 16px;
        gap: 14px;
    }

    .product-col,
    .price-col,
    .quantity-col,
    .subtotal-col {
        width: 100%;
        justify-content: space-between;
        text-align: left !important;
    }

    .price-col::before {
        content: "Price: ";
        font-weight: 600;
        margin-right: 6px;
    }

    .quantity-col::before {
        content: "Quantity: ";
        font-weight: 600;
        margin-right: 6px;
    }

    .subtotal-col::before {
        content: "Subtotal: ";
        font-weight: 600;
        margin-right: 6px;
    }

    .quantity-col {
        display: flex;
        align-items: center;
    }

    .product-col {
        padding-left: 20px;
    }

    .remove-icon {
        opacity: 1;
        top: 0;
        left: 0;
        width: 20px;
        height: 20px;
        font-size: 10px;
    }

    .product-thumb {
        width: 45px;
        height: 45px;
    }

    .product-name {
        font-size: 15px;
        flex: 1;
    }

    .cart-actions {
        margin-bottom: 35px;
    }

    .btn-secondary,
    .btn-primary,
    .checkout-btn {
        width: 100%;
        padding: 14px 20px;
        font-size: 15px;
    }

    .coupon-section {
        flex-direction: column;
    }

    .coupon-input {
        width: 100%;
        padding: 14px 16px;
    }

    .cart-total-box {
        padding: 24px 16px;
    }

    .cart-total-title {
        font-size: 18px;
    }

    .total-row {
        font-size: 15px;
        padding-bottom: 12px;
        margin-bottom: 12px;
    }
}

/* Small Mobile */
@media (max-width: 575px) {
    .container {
        padding: 0 12px;
    }

    .top-header {
        font-size: 11px;
    }

    .shop-now-link {
        display: inline-block;
        margin-left: 4px;
        margin-top: 4px;
    }

    .logo h1 {
        font-size: 20px;
    }

    .nav-links {
        gap: 10px;
    }

    .nav-links a {
        font-size: 13px;
    }

    .search-box {
        padding: 6px 10px;
    }

    .search-box input {
        font-size: 11px;
    }

    .breadcrumb {
        font-size: 13px;
        line-height: 1.6;
        flex-wrap: wrap;
    }

    .cart-section {
        margin-bottom: 60px;
    }

    .cart-item {
        padding: 14px 12px;
    }

    .product-col {
        align-items: flex-start;
        gap: 10px;
    }

    .product-name {
        font-size: 14px;
    }

    .price-col,
    .quantity-col,
    .subtotal-col {
        font-size: 14px;
    }

    .quantity-input {
        width: 55px;
        font-size: 13px;
        padding: 5px 6px;
    }

    .btn-secondary,
    .btn-primary,
    .checkout-btn {
        padding: 12px 16px;
        font-size: 14px;
    }

    .cart-total-box {
        padding: 20px 14px;
    }

    .cart-total-title {
        font-size: 17px;
    }

    .total-row {
        font-size: 14px;
    }
}
</style>
@endpush
@endsection