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

<section class="checkout-section container" style="margin-top: 50px;">
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
                        <input type="text" name="phone" inputmode="tel" value="{{ old('phone', $prefill['phone'] ?? '') }}" required>
                    </div>
                    <div class="form-group">
                        <label>Email Address<span class="req">*</span></label>
                        <input type="email" name="email" value="{{ old('email', $prefill['email'] ?? '') }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Postal Code</label>
                        <input type="text" name="postal_code" inputmode="numeric" value="{{ old('postal_code', $prefill['postal_code'] ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label>Country</label>
                        <input type="text" name="country" value="{{ old('country', $prefill['country'] ?? '') }}">
                    </div>
                </div>

                <div class="save-info">
                    <input type="checkbox" id="save-info" name="save_info" value="1" checked>
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
:root {
    --primary-red: #DB4444;
    --text-black: #000000;
    --text-gray: #7D8184;
    --bg-gray: #F5F5F5;
    --white: #FFFFFF;
    --border-light: rgba(0, 0, 0, 0.12);
}

*,
*::before,
*::after {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    color: var(--text-black);
    line-height: 1.6;
    background-color: #fff;
    overflow-x: hidden;
}

img {
    max-width: 100%;
    display: block;
}

.container {
    width: 100%;
    max-width: 1170px;
    margin: 0 auto;
    padding-left: 16px;
    padding-right: 16px;
}

.breadcrumb-container {
    margin-top: 90px;
    margin-bottom: 38px;
}

.breadcrumb {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 6px;
    font-size: 14px;
}

.breadcrumb a {
    color: var(--text-black);
    opacity: 0.6;
    text-decoration: none;
    transition: opacity 0.3s ease;
}

.breadcrumb a:hover {
    opacity: 1;
}

.breadcrumb .separator {
    margin: 0 4px;
    opacity: 0.5;
}

.breadcrumb .current {
    font-weight: 500;
    opacity: 1;
}

.checkout-section {
    margin-bottom: 100px;
}

.checkout-grid {
    display: grid;
    grid-template-columns: minmax(0, 1fr) minmax(320px, 440px);
    gap: 42px;
    align-items: start;
}

.billing-card,
.summary-card {
    width: 100%;
    min-width: 0;
}

.section-title {
    font-size: clamp(28px, 3vw, 34px);
    font-weight: 500;
    margin-bottom: 32px;
    line-height: 1.25;
}

form {
    width: 100%;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-bottom: 22px;
    width: 100%;
}

.form-row {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 20px;
    width: 100%;
}

label {
    font-size: 15px;
    font-weight: 400;
}

.req {
    color: var(--primary-red);
}

input[type="text"],
input[type="email"],
textarea {
    width: 100%;
    background-color: var(--bg-gray);
    border: 1px solid transparent;
    padding: 15px 16px;
    border-radius: 6px;
    font-family: 'Poppins', sans-serif;
    font-size: 15px;
    outline: none;
    transition: border-color 0.3s ease, background-color 0.3s ease;
}

input[type="text"]:focus,
input[type="email"]:focus,
textarea:focus {
    border-color: var(--primary-red);
    background-color: #fff;
}

textarea {
    resize: vertical;
    min-height: 110px;
}

.save-info {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    margin-top: 8px;
}

.save-info input {
    width: 16px;
    height: 16px;
    margin-top: 3px;
    accent-color: var(--primary-red);
    flex-shrink: 0;
}

.save-info label {
    font-size: 14px;
    color: rgba(0, 0, 0, 0.72);
    line-height: 1.5;
}

.notes-area {
    margin-top: 22px;
}

.notes-area textarea {
    width: 100%;
}

.summary-card {
    padding: 28px;
    border: 1px solid var(--border-light);
    border-radius: 12px;
    background: #fff;
    position: sticky;
    top: 110px;
}

.summary-items {
    display: flex;
    flex-direction: column;
    gap: 18px;
    margin-bottom: 26px;
}

.summary-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    min-width: 0;
}

.item-left {
    display: flex;
    align-items: center;
    gap: 14px;
    min-width: 0;
    flex: 1;
}

.item-left img {
    width: 56px;
    height: 56px;
    object-fit: contain;
    border-radius: 6px;
    background: var(--bg-gray);
    padding: 6px;
    flex-shrink: 0;
}

.item-title {
    font-size: 15px;
    font-weight: 400;
    min-width: 0;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.item-price {
    font-size: 15px;
    font-weight: 500;
    white-space: nowrap;
    flex-shrink: 0;
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
    gap: 12px;
    font-size: 15px;
}

.total-strong {
    font-size: 16px;
}

.total-strong span:last-child {
    font-weight: 600;
}

.payment-box {
    display: flex;
    flex-direction: column;
    gap: 14px;
    margin-bottom: 22px;
}

.payment-option {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 14px;
    flex-wrap: wrap;
}

.radio-line {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    cursor: pointer;
    width: 100%;
    flex-wrap: wrap;
}

.radio-line input {
    accent-color: var(--primary-red);
    flex-shrink: 0;
}

.method-badges {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
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
    white-space: nowrap;
}

.badge-card {
    background: #fff;
}

.coupon-row {
    display: flex;
    flex-direction: column;
    align-items: stretch;
    gap: 10px;
    margin-bottom: 18px;
}

.coupon-form {
    display: grid;
    grid-template-columns: minmax(0, 1fr) auto;
    gap: 12px;
    width: 100%;
}

.remove-coupon-form {
    align-self: flex-start;
}

.btn-primary {
    background-color: var(--primary-red);
    color: #fff;
    border: none;
    padding: 15px 28px;
    border-radius: 6px;
    font-family: 'Poppins', sans-serif;
    font-weight: 500;
    font-size: 15px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    white-space: nowrap;
}

.btn-primary:hover {
    background-color: #E07575;
}

.btn-apply {
    padding: 14px 20px;
    min-width: 130px;
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
    font-size: 14px;
}

@media (max-width: 1199px) {
    .checkout-grid {
        grid-template-columns: minmax(0, 1fr) minmax(300px, 390px);
        gap: 30px;
    }

    .summary-card {
        padding: 24px;
    }
}

@media (max-width: 991px) {
    .breadcrumb-container {
        margin-top: 78px;
        margin-bottom: 28px;
    }

    .checkout-section {
        margin-bottom: 70px;
    }

    .checkout-grid {
        grid-template-columns: 1fr;
        gap: 32px;
    }

    .summary-card {
        position: static;
        top: auto;
        padding: 24px;
    }
}

@media (max-width: 767px) {
    .container {
        padding-left: 14px;
        padding-right: 14px;
    }

    .breadcrumb-container {
        margin-top: 72px;
        margin-bottom: 22px;
    }

    .checkout-section {
        margin-bottom: 56px;
    }

    .section-title {
        margin-bottom: 24px;
    }

    .form-row {
        grid-template-columns: 1fr;
        gap: 0;
    }

    .summary-card {
        padding: 20px;
    }

    .summary-item {
        align-items: flex-start;
        gap: 10px;
    }

    .item-left {
        align-items: flex-start;
    }

    .item-title {
        white-space: normal;
        overflow: visible;
        text-overflow: unset;
        line-height: 1.4;
    }

    .coupon-form {
        grid-template-columns: 1fr;
    }

    .btn-apply,
    .btn-place {
        width: 100%;
    }

    .payment-option,
    .radio-line {
        align-items: flex-start;
        justify-content: flex-start;
    }

    .method-badges {
        width: 100%;
        margin-left: 24px;
    }
}

@media (max-width: 575px) {
    .breadcrumb {
        font-size: 13px;
    }

    .section-title {
        font-size: 24px;
    }

    label {
        font-size: 14px;
    }

    input[type="text"],
    input[type="email"],
    textarea {
        font-size: 14px;
        padding: 14px;
    }

    .summary-card {
        padding: 16px;
        border-radius: 10px;
    }

    .summary-items {
        gap: 14px;
    }

    .item-left img {
        width: 50px;
        height: 50px;
    }

    .item-price,
    .total-row {
        font-size: 14px;
    }

    .btn-primary {
        font-size: 14px;
        padding: 14px 18px;
    }

    .btn-apply {
        min-width: 100%;
    }
}

@media (max-width: 420px) {
    .breadcrumb-container {
        margin-top: 68px;
    }

    .section-title {
        font-size: 22px;
    }

    .summary-item {
        flex-direction: column;
        align-items: flex-start;
    }

    .item-price {
        padding-left: 64px;
    }

    .method-badges {
        margin-left: 0;
    }

    .save-info {
        gap: 8px;
    }

    .save-info label {
        font-size: 13px;
    }
}
</style>
@endpush