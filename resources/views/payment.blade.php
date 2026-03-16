@extends('home.layout')

@section('title', 'Payment - ShantoGiftShop')

@section('content')
<div class="container breadcrumb-container" style="margin-top: 90px;">
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <span class="separator">/</span>
        <span class="current">Payment</span>
    </div>
</div>

<section class="payment-section container" style="margin-top: 50px;">
    <div class="payment-card">
        <h2 class="payment-title">Complete Payment</h2>

        <div class="payment-meta">
            <div class="meta-row">
                <span>Order:</span>
                <span>{{ $order->order_number }}</span>
            </div>
            <div class="meta-row">
                <span>Amount:</span>
                <span>${{ number_format((float) $order->total, 0) }}</span>
            </div>
            <div class="meta-row">
                <span>Method:</span>
                <span class="method-pill">{{ strtoupper($order->payment_method) }}</span>
            </div>
        </div>

        <div class="invoice-link">
            <a href="{{ route('orders.show', ['order' => $order, 'token' => $token]) }}">View Invoice</a>
        </div>

        <div class="gateway-box">
            @if($order->payment_method === 'bkash')
                <div class="gateway-head">
                    <span class="gateway-badge bkash">bKash</span>
                    <span class="gateway-sub">Checkout</span>
                </div>

                <form action="{{ route('orders.payments.store', ['order' => $order, 'token' => $token]) }}" method="POST" class="gateway-form" id="gateway-form">
                    @csrf
                    <div class="form-group">
                        <label>Mobile Number</label>
                        <input type="text" name="bkash_mobile" value="{{ old('bkash_mobile') }}" placeholder="01XXXXXXXXX" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>OTP</label>
                            <input type="text" name="bkash_otp" value="{{ old('bkash_otp') }}" placeholder="Enter OTP" required>
                        </div>
                        <div class="form-group">
                            <label>PIN</label>
                            <input type="password" name="bkash_pin" value="{{ old('bkash_pin') }}" placeholder="Enter PIN" required>
                        </div>
                    </div>
                    <button type="submit" class="btn-primary btn-full">Pay with bKash</button>
                </form>
            @elseif($order->payment_method === 'nagad')
                <div class="gateway-head">
                    <span class="gateway-badge nagad">Nagad</span>
                    <span class="gateway-sub">Checkout</span>
                </div>

                <form action="{{ route('orders.payments.store', ['order' => $order, 'token' => $token]) }}" method="POST" class="gateway-form" id="gateway-form">
                    @csrf
                    <div class="form-group">
                        <label>Mobile Number</label>
                        <input type="text" name="nagad_mobile" value="{{ old('nagad_mobile') }}" placeholder="01XXXXXXXXX" required>
                    </div>
                    <div class="form-group">
                        <label>OTP</label>
                        <input type="text" name="nagad_otp" value="{{ old('nagad_otp') }}" placeholder="Enter OTP" required>
                    </div>
                    <button type="submit" class="btn-primary btn-full">Pay with Nagad</button>
                </form>
            @elseif($order->payment_method === 'card')
                <div class="gateway-head">
                    <span class="gateway-badge card">Card</span>
                    <span class="gateway-sub">Payment</span>
                </div>

                <form action="{{ route('orders.payments.store', ['order' => $order, 'token' => $token]) }}" method="POST" class="gateway-form" id="gateway-form">
                    @csrf
                    <div class="form-group">
                        <label>Name on Card</label>
                        <input type="text" name="card_name" value="{{ old('card_name') }}" placeholder="Cardholder name" required>
                    </div>
                    <div class="form-group">
                        <label>Card Number</label>
                        <input type="text" name="card_number" value="{{ old('card_number') }}" placeholder="1234 5678 9012 3456" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Expiry (MM/YY)</label>
                            <input type="text" name="card_expiry" value="{{ old('card_expiry') }}" placeholder="MM/YY" required>
                        </div>
                        <div class="form-group">
                            <label>CVV</label>
                            <input type="password" name="card_cvv" value="{{ old('card_cvv') }}" placeholder="***" required>
                        </div>
                    </div>
                    <button type="submit" class="btn-primary btn-full">Pay with Card</button>
                </form>
            @elseif($order->payment_method === 'bank')
                <div class="gateway-head">
                    <span class="gateway-badge bank">Bank</span>
                    <span class="gateway-sub">Transfer</span>
                </div>

                <form action="{{ route('orders.payments.store', ['order' => $order, 'token' => $token]) }}" method="POST" class="gateway-form" id="gateway-form">
                    @csrf
                    <div class="form-group">
                        <label>Bank Name</label>
                        <input type="text" name="bank_name" value="{{ old('bank_name') }}" placeholder="Your bank name" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Account Name</label>
                            <input type="text" name="account_name" value="{{ old('account_name') }}" placeholder="Account holder" required>
                        </div>
                        <div class="form-group">
                            <label>Account Number</label>
                            <input type="text" name="account_number" value="{{ old('account_number') }}" placeholder="Account number" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Routing Number (optional)</label>
                        <input type="text" name="routing_number" value="{{ old('routing_number') }}" placeholder="Routing number">
                    </div>
                    <button type="submit" class="btn-primary btn-full">Confirm Transfer</button>
                </form>
            @else
                <div class="gateway-head">
                    <span class="gateway-badge other">Payment</span>
                    <span class="gateway-sub">Not available</span>
                </div>
                <p class="gateway-note">Selected payment method is not supported.</p>
            @endif
        </div>

        <div class="payment-actions">
            <form action="{{ route('orders.payments.store', ['order' => $order, 'token' => $token]) }}" method="POST">
                @csrf
                <input type="hidden" name="cancel" value="1">
                <button type="submit" class="btn-secondary btn-full">Cancel Payment</button>
            </form>
        </div>
    </div>
</section>

@push('styles')
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

:root {
    --primary-red: #DB4444;
    --text-black: #000000;
    --bg-gray: #F5F5F5;
    --border-light: rgba(0, 0, 0, 0.12);
}

body {
    font-family: 'Poppins', sans-serif;
    color: #000;
    line-height: 1.6;
    background-color: #fff;
    overflow-x: hidden;
}

.container {
    width: 100%;
    max-width: 1170px;
    margin: 0 auto;
    padding-left: 16px;
    padding-right: 16px;
}

.breadcrumb-container {
    margin-top: 90px !important;
    margin-bottom: 30px;
}

.breadcrumb {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 6px;
    font-size: 14px;
}

.breadcrumb a {
    color: var(--text-black);
    opacity: 0.5;
    text-decoration: none;
}

.breadcrumb .separator {
    margin: 0 4px;
    opacity: 0.5;
}

.breadcrumb .current {
    font-weight: 500;
}

.payment-section {
    margin-bottom: 100px;
}

.payment-card {
    width: 100%;
    max-width: 620px;
    margin: 0 auto;
    padding: 36px;
    background: #fff;
    box-shadow: 0px 1px 13px rgba(0, 0, 0, 0.05);
    border-radius: 10px;
}

.payment-title {
    font-size: clamp(24px, 3vw, 28px);
    font-weight: 500;
    margin-bottom: 22px;
    line-height: 1.3;
}

.payment-meta {
    background: var(--bg-gray);
    border-radius: 8px;
    padding: 18px;
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-bottom: 22px;
}

.meta-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
    font-size: 16px;
}

.meta-row span:last-child {
    text-align: right;
    word-break: break-word;
}

.method-pill {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 6px 10px;
    border-radius: 999px;
    background: #fff;
    border: 1px solid var(--border-light);
    font-size: 12px;
    font-weight: 600;
    max-width: 100%;
    word-break: break-word;
    text-align: center;
}

.payment-actions {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}

.payment-actions form {
    width: 100%;
}

.invoice-link {
    margin-bottom: 18px;
}

.invoice-link a {
    color: var(--primary-red);
    text-decoration: none;
    font-weight: 500;
    word-break: break-word;
}

.gateway-box {
    border: 1px solid rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    padding: 18px;
    margin-bottom: 14px;
    background: #fff;
}

.gateway-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    margin-bottom: 14px;
    flex-wrap: wrap;
}

.gateway-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 6px 12px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 700;
    color: #fff;
    white-space: nowrap;
}

.gateway-badge.bkash {
    background: #e2136e;
}

.gateway-badge.nagad {
    background: #f26a21;
}

.gateway-badge.card {
    background: #111827;
}

.gateway-badge.bank {
    background: #2563eb;
}

.gateway-badge.other {
    background: #6b7280;
}

.gateway-sub {
    color: rgba(0, 0, 0, 0.6);
    font-weight: 500;
    font-size: 14px;
}

.gateway-form {
    display: flex;
    flex-direction: column;
    gap: 14px;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
    width: 100%;
}

.form-row {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 12px;
    width: 100%;
}

.form-group label {
    font-size: 14px;
    font-weight: 500;
}

.gateway-form input {
    width: 100%;
    padding: 12px 14px;
    border: 1px solid rgba(0, 0, 0, 0.12);
    border-radius: 8px;
    outline: none;
    font-family: 'Poppins', sans-serif;
    font-size: 14px;
    background: var(--bg-gray);
}

.gateway-form input:focus {
    border-color: var(--primary-red);
    background: #fff;
}

.btn-full {
    width: 100%;
    justify-content: center;
}

.gateway-note {
    color: rgba(0, 0, 0, 0.7);
    font-size: 14px;
    line-height: 1.6;
}

.btn-primary {
    background-color: var(--primary-red);
    color: #fff;
    border: none;
    padding: 14px 22px;
    border-radius: 4px;
    font-family: 'Poppins', sans-serif;
    font-weight: 500;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
    text-align: center;
}

.btn-primary:hover {
    background-color: #E07575;
}

.btn-secondary {
    width: 100%;
    padding: 14px 22px;
    border: 1px solid rgba(0, 0, 0, 0.5);
    background-color: transparent;
    border-radius: 4px;
    font-family: 'Poppins', sans-serif;
    font-weight: 500;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s;
    text-align: center;
}

.btn-secondary:hover {
    background-color: #000;
    color: #fff;
    border-color: #000;
}

@media (max-width: 991px) {
    .breadcrumb-container {
        margin-top: 80px !important;
        margin-bottom: 24px;
    }

    .payment-section {
        margin-bottom: 70px;
    }

    .payment-card {
        max-width: 720px;
        padding: 30px;
    }
}

@media (max-width: 767px) {
    .container {
        padding-left: 14px;
        padding-right: 14px;
    }

    .breadcrumb-container {
        margin-top: 72px !important;
        margin-bottom: 20px;
    }

    .payment-section {
        margin-bottom: 56px;
    }

    .payment-card {
        padding: 22px;
        border-radius: 8px;
    }

    .payment-title {
        margin-bottom: 18px;
    }

    .payment-meta {
        padding: 16px;
        margin-bottom: 18px;
    }

    .meta-row {
        font-size: 15px;
    }

    .gateway-box {
        padding: 16px;
    }

    .gateway-head {
        align-items: flex-start;
    }

    .form-row {
        grid-template-columns: 1fr;
    }

    .btn-primary,
    .btn-secondary {
        font-size: 15px;
        padding: 13px 18px;
    }
}

@media (max-width: 575px) {
    .payment-card {
        padding: 18px 16px;
    }

    .payment-title {
        font-size: 22px;
    }

    .payment-meta {
        padding: 14px;
        gap: 10px;
    }

    .meta-row {
        flex-direction: column;
        align-items: flex-start;
        gap: 4px;
        font-size: 14px;
    }

    .meta-row span:last-child {
        text-align: left;
    }

    .gateway-box {
        padding: 14px;
    }

    .gateway-sub,
    .gateway-note,
    .form-group label,
    .gateway-form input {
        font-size: 14px;
    }

    .btn-primary,
    .btn-secondary {
        font-size: 14px;
        padding: 12px 16px;
    }
}

@media (max-width: 420px) {
    .breadcrumb-container {
        margin-top: 68px !important;
    }

    .payment-card {
        padding: 16px 14px;
    }

    .payment-title {
        font-size: 20px;
    }

    .payment-meta,
    .gateway-box {
        padding: 12px;
    }

    .gateway-head {
        gap: 8px;
    }

    .gateway-badge {
        font-size: 11px;
        padding: 5px 10px;
    }

    .method-pill {
        font-size: 11px;
    }
}
</style>
@endpush
@endsection