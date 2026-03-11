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
        <div style="margin-bottom: 20px; color: green;">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div style="margin-bottom: 20px; color: red;">{{ session('error') }}</div>
    @endif

    @if($errors->any())
        <div style="margin-bottom: 20px; color: red;">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('cart.sync') }}" method="POST" id="cart-sync-form">
        @csrf

        <div class="cart-table-wrapper">
            <div class="cart-header">
                <div class="header-col">Select</div>
                <div class="header-col">Product</div>
                <div class="header-col">Price</div>
                <div class="header-col">Quantity</div>
                <div class="header-col" style="text-align: right;">Subtotal</div>
            </div>

            @forelse($cartItems as $item)
                <div class="cart-item" data-price="{{ $item->unit_price }}">
                    <div class="select-col">
                        <input
                            type="checkbox"
                            class="checkout-select"
                            value="{{ $item->id }}"
                            checked
                        >
                    </div>
                    <div class="product-col">
                        <button
                            type="button"
                            class="remove-icon remove-item-btn"
                            data-action="{{ route('cart.destroy', $item) }}"
                        >
                            <i class="fas fa-times"></i>
                        </button>

                        <img src="{{ $item->product->image_url }}" alt="{{ $item->product->title }}" class="product-thumb">
                        <span class="product-name">{{ $item->product->title }}</span>
                    </div>

                    <div class="price-col">${{ number_format($item->unit_price, 0) }}</div>

                    <div class="quantity-col">
                        <input
                            type="number"
                            name="items[{{ $item->id }}]"
                            value="{{ $item->quantity }}"
                            min="1"
                            class="quantity-input"
                        >
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
            <button type="button" class="btn-primary" id="proceed-to-checkout">Proceed To Checkout</button>
        </div>
    </form>

    <form id="remove-item-form" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    @if($cartItems->count())
        <div class="cart-bottom-section">
            <div class="coupon-section-wrapper">
                <form action="{{ route('cart.coupon.apply') }}" method="POST" class="coupon-section">
                    @csrf
                    <input
                        type="text"
                        name="coupon_code"
                        placeholder="Coupon Code"
                        class="coupon-input"
                        value="{{ old('coupon_code', $appliedCoupon['code'] ?? '') }}"
                    >
                    <button class="btn-primary" type="submit">Apply Coupon</button>
                </form>

                @if($appliedCoupon)
                    <div class="applied-coupon-box">
                        <span>
                            Applied Coupon:
                            <strong>{{ $appliedCoupon['code'] }}</strong>
                            ({{ $appliedCoupon['label'] }})
                        </span>

                        <form action="{{ route('cart.coupon.remove') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="remove-coupon-btn">Remove</button>
                        </form>
                    </div>
                @endif
            </div>

            <div
                class="cart-total-box"
                data-coupon-type="{{ $appliedCoupon['type'] ?? '' }}"
                data-coupon-value="{{ $appliedCoupon['value'] ?? 0 }}"
            >
                <h3 class="cart-total-title">Cart Total</h3>

                <div class="total-row">
                    <span>Subtotal:</span>
                    <span class="cart-subtotal">${{ number_format($subtotal, 0) }}</span>
                </div>

                <div class="total-row">
                    <span>Discount:</span>
                    <span class="cart-discount">
                        -${{ number_format($discount, 0) }}
                    </span>
                </div>

                <div class="total-row">
                    <span>Shipping:</span>
                    <span>Free</span>
                </div>

                <div class="total-row">
                    <span>Total:</span>
                    <span class="cart-total">${{ number_format($total, 0) }}</span>
                </div>
            </div>
        </div>
    @endif
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const quantityInputs = document.querySelectorAll('.quantity-input');
    const cartSyncForm = document.getElementById('cart-sync-form');
    const removeButtons = document.querySelectorAll('.remove-item-btn');
    const removeItemForm = document.getElementById('remove-item-form');
    const totalBox = document.querySelector('.cart-total-box');
    const proceedBtn = document.getElementById('proceed-to-checkout');

    let syncTimer;

    quantityInputs.forEach(input => {
        input.addEventListener('input', function() {
            if (this.value < 1 || this.value === '') return;
            updateItemSubtotal(this);
            updateCartTotals();
        });

        input.addEventListener('change', function() {
            if (this.value < 1 || this.value === '') {
                this.value = 1;
            }

            updateItemSubtotal(this);
            updateCartTotals();

            clearTimeout(syncTimer);
            syncTimer = setTimeout(() => {
                cartSyncForm.submit();
            }, 300);
        });
    });

    removeButtons.forEach(button => {
        button.addEventListener('click', function() {
            const action = this.dataset.action;
            removeItemForm.setAttribute('action', action);
            removeItemForm.submit();
        });
    });

    function updateItemSubtotal(input) {
        const item = input.closest('.cart-item');
        const price = parseFloat(item.dataset.price);
        const quantity = parseInt(input.value) || 1;
        const subtotalElement = item.querySelector('.subtotal-col');
        const subtotal = price * quantity;

        subtotalElement.textContent = '$' + Math.round(subtotal);
    }

    function updateCartTotals() {
        let subtotal = 0;
        const items = document.querySelectorAll('.cart-item');

        items.forEach(item => {
            const price = parseFloat(item.dataset.price);
            const quantity = parseInt(item.querySelector('.quantity-input').value) || 1;
            subtotal += price * quantity;
        });

        let discount = 0;

        if (totalBox) {
            const couponType = totalBox.dataset.couponType;
            const couponValue = parseFloat(totalBox.dataset.couponValue || 0);

            if (couponType === 'percent') {
                discount = Math.round((subtotal * couponValue) / 100);
            } else if (couponType === 'fixed') {
                discount = couponValue;
            }

            if (discount > subtotal) {
                discount = subtotal;
            }
        }

        const total = subtotal - discount;

        const subtotalEl = document.querySelector('.cart-subtotal');
        const discountEl = document.querySelector('.cart-discount');
        const totalEl = document.querySelector('.cart-total');

        if (subtotalEl) subtotalEl.textContent = '$' + Math.round(subtotal);
        if (discountEl) discountEl.textContent = '-$' + Math.round(discount);
        if (totalEl) totalEl.textContent = '$' + Math.round(total);
    }

    if (proceedBtn) {
        proceedBtn.addEventListener('click', function () {
            const checked = Array.from(document.querySelectorAll('.checkout-select:checked')).map(el => el.value);
            const url = new URL("{{ route('orders.create') }}", window.location.origin);

            checked.forEach(id => url.searchParams.append('items[]', id));

            window.location.href = url.toString();
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

:root {
    --primary-red: #DB4444;
    --text-black: #000000;
    --text-gray: #7D8184;
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

.cart-section {
    margin-bottom: 140px;
}

.cart-header {
    display: grid;
    grid-template-columns: 0.5fr 2fr 1fr 1fr 1fr;
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
    grid-template-columns: 0.5fr 2fr 1fr 1fr 1fr;
    padding: 24px 40px;
    background-color: #fff;
    box-shadow: 0px 1px 13px rgba(0, 0, 0, 0.05);
    border-radius: 4px;
    margin-bottom: 24px;
    align-items: center;
    position: relative;
}

.select-col {
    display: flex;
    align-items: center;
    justify-content: flex-start;
}

.checkout-select {
    width: 16px;
    height: 16px;
    accent-color: var(--primary-red);
    cursor: pointer;
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
    width: 18px;
    height: 18px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 10px;
    cursor: pointer;
    opacity: 1;
    border: none;
    transition: all 0.3s;
}

.remove-icon:hover {
    background-color: #b91c1c;
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
    -moz-appearance: textfield;
}

.quantity-input::-webkit-outer-spin-button,
.quantity-input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

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
}

.btn-primary:hover {
    background-color: #E07575;
}

.cart-bottom-section {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 30px;
}

.coupon-section-wrapper {
    flex: 1;
    max-width: 527px;
}

.coupon-section {
    display: flex;
    gap: 16px;
    width: 100%;
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
    background-color: #E07575;
}

.applied-coupon-box {
    margin-top: 16px;
    padding: 14px 16px;
    border: 1px solid #ddd;
    border-radius: 6px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
    background: #fff;
}

.remove-coupon-btn {
    border: none;
    background: transparent;
    color: var(--primary-red);
    cursor: pointer;
    font-weight: 600;
}

.cart-total-box {
    width: 470px;
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

@media (max-width: 1199px) {
    .container {
        max-width: 100%;
        padding: 0 20px;
    }

    .cart-header,
    .cart-item {
        padding: 20px 24px;
    }

    .cart-total-box {
        width: 420px;
    }
}

@media (max-width: 991px) {
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

    .coupon-section-wrapper,
    .coupon-section {
        max-width: 100%;
        width: 100%;
    }

    .cart-total-box {
        width: 100%;
    }
}

@media (max-width: 767px) {
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
    .btn-primary {
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

    .applied-coupon-box {
        flex-direction: column;
        align-items: flex-start;
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

@media (max-width: 575px) {
    .container {
        padding: 0 12px;
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
    .btn-primary {
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
