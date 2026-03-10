@extends('home.layout')

@section('title', 'Cart - ShantoGiftShop')

@section('content')
<div class="container breadcrumb-container" style="margin-top: 90px;">
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <span class="separator">/</span>
        <span class="current">cart</span>
    </div>
</div>

<section class="cart-section container" style="margin-top: 50px;">
    @if(session('success'))
        <p style="color: green; margin-bottom: 15px;">{{ session('success') }}</p>
    @endif

    @if($errors->any())
        <div style="color:red; margin-bottom:15px;">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('cart.sync') }}" method="POST">
        @csrf

        <div class="cart-table-wrapper">
            <div class="cart-header">
                <div class="header-col">Product</div>
                <div class="header-col">Price</div>
                <div class="header-col">Quantity</div>
                <div class="header-col" style="text-align: right;">Subtotal</div>
            </div>

            @forelse($cartItems as $item)
                <div class="cart-item" data-price="{{ $item->unit_price }}">
                    <div class="product-col">
                        <form action="{{ route('cart.destroy', $item) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="remove-icon"><i class="fas fa-times"></i></button>
                        </form>

                        <img src="{{ $item->product->image_url }}" alt="{{ $item->product->title }}" class="product-thumb">
                        <span class="product-name">{{ $item->product->title }}</span>
                    </div>

                    <div class="price-col">${{ number_format($item->unit_price, 0) }}</div>

                    <div class="quantity-col">
                        <input type="number" name="items[{{ $item->id }}]" value="{{ $item->quantity }}" min="1" class="quantity-input">
                    </div>

                    <div class="subtotal-col" style="text-align: right;">
                        ${{ number_format($item->subtotal, 0) }}
                    </div>
                </div>
            @empty
                <p>Your cart is empty.</p>
            @endforelse
        </div>

        <div class="cart-actions">
            <a href="{{ route('products.index') }}" class="btn-secondary">Return To Shop</a>
            @if($cartItems->count())
                <button class="btn-secondary update-cart-btn" type="submit">Update Cart</button>
            @endif
        </div>
    </form>

    <div class="cart-bottom-section">
        <div class="coupon-section">
            <input type="text" placeholder="Coupon Code" class="coupon-input">
            <button class="btn-primary" type="button">Apply Coupon</button>
        </div>

        <div class="cart-total-box">
            <h3 class="cart-total-title">Cart Total</h3>
            <div class="total-row">
                <span>Subtotal:</span>
                <span class="cart-subtotal">${{ number_format($subtotal, 0) }}</span>
            </div>
            <div class="total-row">
                <span>Shipping:</span>
                <span>Free</span>
            </div>
            <div class="total-row">
                <span>Total:</span>
                <span class="cart-total">${{ number_format($subtotal, 0) }}</span>
            </div>
        </div>
    </div>

    @if($cartItems->count())
        <div class="cart-total-box" style="width: 100%; margin-top: 30px;">
            <h3 class="cart-total-title">Checkout Information</h3>

            <form action="{{ route('orders.store') }}" method="POST">
                @csrf

                <div class="coupon-section" style="max-width: 100%; margin-bottom: 16px;">
                    <input type="text" class="coupon-input" name="customer_name" placeholder="Full Name"
                           value="{{ old('customer_name', auth()->user()->name ?? '') }}" required>
                    <input type="email" class="coupon-input" name="email" placeholder="Email"
                           value="{{ old('email', auth()->user()->email ?? '') }}" required>
                </div>

                <div class="coupon-section" style="max-width: 100%; margin-bottom: 16px;">
                    <input type="text" class="coupon-input" name="phone" placeholder="Phone"
                           value="{{ old('phone', auth()->user()->phone ?? '') }}" required>
                    <input type="text" class="coupon-input" name="city" placeholder="City"
                           value="{{ old('city', auth()->user()->profile->city ?? '') }}" required>
                </div>

                <div class="coupon-section" style="max-width: 100%; margin-bottom: 16px;">
                    <input type="text" class="coupon-input" name="address" placeholder="Address"
                           value="{{ old('address', auth()->user()->profile->address ?? '') }}" required>
                    <input type="text" class="coupon-input" name="postal_code" placeholder="Postal Code"
                           value="{{ old('postal_code', auth()->user()->profile->postal_code ?? '') }}">
                </div>

                <div class="coupon-section" style="max-width: 100%; margin-bottom: 16px;">
                    <input type="text" class="coupon-input" name="country" placeholder="Country"
                           value="{{ old('country', auth()->user()->profile->country ?? 'Bangladesh') }}">
                    <select name="payment_method" class="coupon-input">
                        <option value="cash_on_delivery">Cash on Delivery</option>
                        <option value="bkash">bKash</option>
                        <option value="nagad">Nagad</option>
                    </select>
                </div>

                <div style="margin-bottom: 16px;">
                    <textarea name="notes" class="coupon-input" placeholder="Order Notes" style="width:100%; min-height:120px;">{{ old('notes') }}</textarea>
                </div>

                <div class="checkout-btn-wrapper">
                    <button class="btn-primary" type="submit">Proceed to checkout</button>
                </div>
            </form>

            <p style="margin-top: 12px; color: #666;">
                Note: Guest user এবং logged-in user — দুইজনই order place করতে পারবে।
            </p>
        </div>
    @endif
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const quantityInputs = document.querySelectorAll('.quantity-input');

    quantityInputs.forEach(input => {
        input.addEventListener('change', function() {
            if (this.value < 1) this.value = 1;
            updateItemSubtotal(this);
            updateCartTotals();
        });

        input.addEventListener('input', function() {
            if (this.value >= 1) {
                updateItemSubtotal(this);
                updateCartTotals();
            }
        });
    });

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