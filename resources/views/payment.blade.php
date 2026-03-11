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

<section class="payment-section container">
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

        <div class="payment-actions">
            <form action="{{ route('orders.payments.store', $order) }}" method="POST">
                @csrf
                <input type="hidden" name="status" value="success">
                <button type="submit" class="btn-primary">Pay Now</button>
            </form>

            <form action="{{ route('orders.payments.store', $order) }}" method="POST">
                @csrf
                <input type="hidden" name="status" value="failed">
                <button type="submit" class="btn-secondary">Simulate Failure</button>
            </form>
        </div>
    </div>
</section>
@endsection

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
    --bg-gray: #F5F5F5;
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

.payment-section {
    margin-bottom: 140px;
}

.payment-card {
    max-width: 620px;
    margin: 0 auto;
    padding: 40px;
    background: #fff;
    box-shadow: 0px 1px 13px rgba(0, 0, 0, 0.05);
    border-radius: 8px;
}

.payment-title {
    font-size: 28px;
    font-weight: 500;
    margin-bottom: 22px;
}

.payment-meta {
    background: var(--bg-gray);
    border-radius: 8px;
    padding: 18px;
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-bottom: 26px;
}

.meta-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 10px;
    font-size: 16px;
}

.method-pill {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 6px 10px;
    border-radius: 999px;
    background: #fff;
    border: 1px solid rgba(0, 0, 0, 0.12);
    font-size: 12px;
    font-weight: 600;
}

.payment-actions {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
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
}

.btn-primary:hover {
    background-color: #E07575;
}

.btn-secondary {
    padding: 14px 22px;
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
    background-color: #000;
    color: #fff;
    border-color: #000;
}
</style>
@endpush
