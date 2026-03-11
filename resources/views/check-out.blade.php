@extends('home.layout')

@section('title', 'Checkout - ShantoGiftShop')

@section('content')
<div class="container breadcrumb-container" style="margin-top: 90px;">
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <span class="separator">/</span>
        <a href="{{ route('cart.index') }}">View Cart</a>
        <span class="separator">/</span>
        <span class="current">CheckOut</span>
    </div>
</div>

<section class="checkout-section container">
    <div class="checkout-grid">
        <div class="billing-card">
            <h2 class="section-title">Billing Details</h2>

            <form action="{{ route('orders.store') }}" method="POST" id="checkout-form">
                @csrf

                @foreach($selectedItems as $item)
                    <input type="hidden" name="selected_item_ids[]" value="{{ $item->id }}">
                @endforeach

                <div class="form-group">
                    <label>First Name<span class="req">*</span></label>
                    <input type="text" name="customer_name" value="{{ old('customer_name', $prefill['customer_name'] ?? '') }}" required>
                </div>

                <div class="form-group">
                    <label>Company Name</label>
                    <input type="text" name="company_name" value="{{ old('company_name') }}">
                </div>

                <div class="form-group">
                    <label>Street Address<span class="req">*</span></label>
                    <input type="text" name="address" value="{{ old('address', $prefill['address'] ?? '') }}" required>
                </div>

                <div class="form-group">
                    <label>Apartment, floor, etc. (optional)</label>
                    <input type="text" name="apartment" value="{{ old('apartment') }}">
                </div>

                <div class="form-group">
                    <label>Town/City<span class="req">*</span></label>
                    <input type="text" name="city" value="{{ old('city', $prefill['city'] ?? '') }}" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Phone Number<span class="req">*</span></label>
                        <input type="text" name="phone" value="{{ old('phone', $prefill['phone'] ?? '') }}" required>
                    </div>
                    <div class="form-group">
                        <label>Email Address<span class="req">*</span></label>
                        <input type="email" name="email" value="{{ old('email', $prefill['email'] ?? '') }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Postal Code</label>
                        <input type="text" name="postal_code" value="{{ old('postal_code', $prefill['postal_code'] ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label>Country</label>
                        <input type="text" name="country" value="{{ old('country', $prefill['country'] ?? '') }}">
                    </div>
                </div>

                <div class="save-info">
                    <input type="checkbox" id="save-info" checked>
                    <label for="save-info">Save this information for faster check-out next time</label>
                </div>

                <input type="hidden" name="payment_method" id="payment_method_input" value="{{ old('payment_method', 'cash_on_delivery') }}">

                <div class="notes-area">
                    <label>Order Notes</label>
                    <textarea name="notes" rows="3" placeholder="Write any additional notes...">{{ old('notes') }}</textarea>
                </div>
            </form>
        </div>

        <div class="summary-card">
            <div class="summary-items">
                @foreach($selectedItems as $item)
                    <div class="summary-item">
                        <div class="item-left">
                            <img src="{{ $item->product->image_url }}" alt="{{ $item->product->title }}">
                            <span class="item-title">{{ $item->product->title }}</span>
                        </div>
                        <span class="item-price">${{ number_format($item->subtotal, 0) }}</span>
                    </div>
                @endforeach
            </div>

            <div class="summary-totals">
                <div class="total-row">
                    <span>Subtotal:</span>
                    <span>${{ number_format($subtotal, 0) }}</span>
                </div>
                <div class="total-row">
                    <span>Discount:</span>
                    <span>- ${{ number_format($discount, 0) }}</span>
                </div>
                <div class="total-row">
                    <span>Shipping:</span>
                    <span>Free</span>
                </div>
                <div class="total-row total-strong">
                    <span>Total:</span>
                    <span>${{ number_format($total, 0) }}</span>
                </div>
            </div>

            <div class="payment-box">
                <div class="payment-option">
                    <label class="radio-line">
                        <input type="radio" name="payment_method_radio" value="bank" {{ old('payment_method', 'cash_on_delivery') === 'bank' ? 'checked' : '' }}>
                        <span>Bank</span>
                    </label>
                    <div class="method-badges">
                        <span class="badge badge-card">VISA</span>
                        <span class="badge badge-card">Master</span>
                        <span class="badge badge-card">AMEX</span>
                    </div>
                </div>

                <label class="radio-line">
                    <input type="radio" name="payment_method_radio" value="cash_on_delivery" {{ old('payment_method', 'cash_on_delivery') === 'cash_on_delivery' ? 'checked' : '' }}>
                    <span>Cash on delivery</span>
                </label>

                <label class="radio-line">
                    <input type="radio" name="payment_method_radio" value="bkash" {{ old('payment_method') === 'bkash' ? 'checked' : '' }}>
                    <span>bKash</span>
                </label>

                <label class="radio-line">
                    <input type="radio" name="payment_method_radio" value="nagad" {{ old('payment_method') === 'nagad' ? 'checked' : '' }}>
                    <span>Nagad</span>
                </label>

                <label class="radio-line">
                    <input type="radio" name="payment_method_radio" value="card" {{ old('payment_method') === 'card' ? 'checked' : '' }}>
                    <span>Card</span>
                </label>
            </div>

            <div class="coupon-row">
                <form action="{{ route('cart.coupon.apply') }}" method="POST" class="coupon-form">
                    @csrf
                    <input type="text" name="coupon_code" placeholder="Coupon Code" value="{{ old('coupon_code', $appliedCoupon['code'] ?? '') }}">
                    <button type="submit" class="btn-primary btn-apply">Apply Coupon</button>
                </form>

                @if($appliedCoupon)
                    <form action="{{ route('cart.coupon.remove') }}" method="POST" class="remove-coupon-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-link">Remove</button>
                    </form>
                @endif
            </div>

            <button type="submit" form="checkout-form" class="btn-primary btn-place">Place Order</button>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const radios = document.querySelectorAll('input[name="payment_method_radio"]');
    const hiddenInput = document.getElementById('payment_method_input');

    function syncPaymentMethod() {
        const checked = document.querySelector('input[name="payment_method_radio"]:checked');
        if (checked && hiddenInput) {
            hiddenInput.value = checked.value;
        }
    }

    radios.forEach(r => r.addEventListener('change', syncPaymentMethod));
    syncPaymentMethod();
});
</script>
@endpush

@push('styles')
<style>
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

:root {
    --primary-red: #DB4444;
    --text-black: #000000;
    --text-gray: #7D8184;
    --bg-gray: #F5F5F5;
    --white: #FFFFFF;
}

.container {
    max-width: 1170px;
    margin: 0 auto;
    padding: 0 15px;
}

.breadcrumb-container {
    margin-top: 80px;
    margin-bottom: 80px;
}

.breadcrumb a {
    color: var(--text-black);
    opacity: 0.5;
    text-decoration: none;
}

.breadcrumb .separator {
    margin: 0 10px;
    opacity: 0.5;
}

.breadcrumb .current {
    font-weight: 500;
}

.checkout-section {
    margin-bottom: 140px;
}

.checkout-grid {
    display: grid;
    grid-template-columns: 1fr 470px;
    gap: 70px;
    align-items: start;
}

.billing-card {
    width: 100%;
}

.section-title {
    font-size: 34px;
    font-weight: 500;
    margin-bottom: 40px;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-bottom: 24px;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
}

label {
    font-size: 16px;
    font-weight: 400;
}

.req {
    color: var(--primary-red);
}

input[type="text"],
input[type="email"],
textarea {
    background-color: var(--bg-gray);
    border: none;
    padding: 16px;
    border-radius: 4px;
    font-family: 'Poppins', sans-serif;
    font-size: 16px;
    outline: none;
}

.save-info {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-top: 10px;
}

.save-info input {
    width: 16px;
    height: 16px;
    accent-color: var(--primary-red);
}

.save-info label {
    font-size: 14px;
    color: rgba(0, 0, 0, 0.7);
}

.notes-area {
    margin-top: 24px;
}

.notes-area textarea {
    width: 100%;
    resize: vertical;
    min-height: 110px;
}

.summary-card {
    padding: 32px;
}

.summary-items {
    display: flex;
    flex-direction: column;
    gap: 18px;
    margin-bottom: 28px;
}

.summary-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
}

.item-left {
    display: flex;
    align-items: center;
    gap: 14px;
    min-width: 0;
}

.item-left img {
    width: 54px;
    height: 54px;
    object-fit: contain;
    border-radius: 6px;
    background: var(--bg-gray);
}

.item-title {
    font-size: 16px;
    font-weight: 400;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 270px;
}

.item-price {
    font-size: 16px;
    font-weight: 400;
}

.summary-totals {
    border-top: 1px solid rgba(0, 0, 0, 0.15);
    border-bottom: 1px solid rgba(0, 0, 0, 0.15);
    padding: 18px 0;
    margin-bottom: 22px;
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.total-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 16px;
}

.total-strong span:last-child {
    font-weight: 500;
}

.payment-box {
    display: flex;
    flex-direction: column;
    gap: 14px;
    margin-bottom: 22px;
}

.radio-line {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 14px;
    cursor: pointer;
}

.radio-line input {
    accent-color: var(--primary-red);
}

.payment-option {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 14px;
}

.method-badges {
    display: flex;
    align-items: center;
    gap: 8px;
}

.badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: 1px solid rgba(0, 0, 0, 0.15);
    border-radius: 6px;
    padding: 4px 10px;
    font-size: 12px;
    font-weight: 600;
    color: rgba(0, 0, 0, 0.75);
}

.badge-card {
    background: #fff;
}

.coupon-row {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 18px;
}

.coupon-form {
    display: grid;
    grid-template-columns: 1fr auto;
    gap: 12px;
    flex: 1;
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

.btn-apply {
    padding: 14px 22px;
    font-size: 14px;
}

.btn-place {
    width: 100%;
    padding: 16px 18px;
}

.btn-link {
    border: none;
    background: transparent;
    color: var(--primary-red);
    font-weight: 500;
    cursor: pointer;
    padding: 0;
}

@media (max-width: 1100px) {
    .checkout-grid {
        grid-template-columns: 1fr;
    }
    .summary-card {
        padding: 0;
    }
}

@media (max-width: 768px) {
    .form-row {
        grid-template-columns: 1fr;
    }
    .item-title {
        max-width: 200px;
    }
}
</style>
@endpush
