@extends('home.layout')

@section('title', 'Invoice - ShantoGiftShop')

@section('content')
<div class="container breadcrumb-container" style="margin-top: 90px;">
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <span class="separator">/</span>
        <span class="current">Invoice</span>
    </div>
</div>

<section class="invoice-section container">
    @php
    $invoiceToken = request('token') ?: $order->public_token;
    $canPay = $order->payment_method !== 'cash_on_delivery' && $order->payment_status !== 'paid';
    @endphp

    <div class="invoice-card" id="invoice-card">
        <div class="invoice-top">
            <div class="brand">
                <h2>ShantoGiftShop</h2>
                <p>Invoice</p>
            </div>
            <div class="meta">
                <div class="meta-row">
                    <span>Order No:</span>
                    <span>{{ $order->order_number }}</span>
                </div>
                <div class="meta-row">
                    <span>Date:</span>
                    <span>{{ $order->created_at->format('d M Y, h:i A') }}</span>
                </div>
                <div class="meta-row">
                    <span>Payment:</span>
                    <span class="pill">{{ strtoupper($order->payment_method) }}</span>
                </div>
                <div class="meta-row">
                    <span>Status:</span>
                    <span class="pill">{{ strtoupper($order->payment_status) }}</span>
                </div>
            </div>
        </div>

        <div class="invoice-grid">
            <div class="bill-to">
                <h3>Bill To</h3>
                <p class="name">{{ $order->customer_name }}</p>
                <p>{{ $order->email }}</p>
                <p>{{ $order->phone }}</p>
                <p>{{ $order->address }}, {{ $order->city }}</p>
                @if($order->postal_code || $order->country)
                <p>{{ $order->postal_code }} {{ $order->country }}</p>
                @endif
            </div>

            <div class="actions">
                <a class="btn-secondary"
                    href="{{ route('orders.show', ['order' => $order, 'token' => $invoiceToken, 'download' => 1]) }}">Download
                    Invoice</a>
                <button type="button" class="btn-primary" id="print-invoice">Print</button>
            </div>
        </div>

        <div class="items-table">
            <div class="table-head">
                <div>Item</div>
                <div>Price</div>
                <div>Qty</div>
                <div class="right">Subtotal</div>
            </div>

            @foreach($order->items as $item)
            <div class="table-row">
                <div class="title">{{ $item->product_title }}</div>
                <div>${{ number_format((float) $item->unit_price, 0) }}</div>
                <div>{{ $item->quantity }}</div>
                <div class="right">${{ number_format((float) $item->subtotal, 0) }}</div>
            </div>
            @endforeach
        </div>

        <div class="totals">
            <div class="total-row">
                <span>Subtotal</span>
                <span>${{ number_format((float) $order->subtotal, 0) }}</span>
            </div>
            <div class="total-row">
                <span>Discount</span>
                <span>- ${{ number_format((float) $order->discount_amount, 0) }}</span>
            </div>
            <div class="total-row">
                <span>Shipping</span>
                <span>${{ number_format((float) $order->shipping_amount, 0) }}</span>
            </div>
            <div class="total-row total-strong">
                <span>Total</span>
                <span>${{ number_format((float) $order->total, 0) }}</span>
            </div>
        </div>

        @if($order->notes)
        <div class="notes">
            <h3>Notes</h3>
            <pre>{{ $order->notes }}</pre>
        </div>
        @endif

        @if(! $canPay)
        <a class="btn-secondary" href="{{ route('products.index') }}">Continue Shopping</a>
        <a class="btn-secondary" href="{{ route('home') }}">Home</a>
        @endif
        @if($canPay)
        <a class="btn-primary"
            href="{{ route('orders.payments.create', ['order' => $order, 'token' => $invoiceToken]) }}">Pay Now</a>
        @endif
    </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const btn = document.getElementById('print-invoice');
    if (!btn) return;
    btn.addEventListener('click', function() {
        const card = document.getElementById('invoice-card');
        const styleTag = document.getElementById('invoice-style');

        if (!card || !styleTag) {
            window.print();
            return;
        }

        const win = window.open('', '_blank', 'noopener,noreferrer,width=900,height=700');
        if (!win) {
            window.print();
            return;
        }

        win.document.open();
        win.document.write(`
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset="UTF-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <title>Invoice</title>
                <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
                <style>${styleTag.innerHTML}</style>
                <style>
                    body { background: #fff; }
                    .invoice-card { box-shadow: none !important; }
                </style>
            </head>
            <body>
                ${card.outerHTML}
            </body>
            </html>
        `);
        win.document.close();

        win.focus();
        win.print();
        win.close();
    });
});
</script>
@endpush

@push('styles')
<style id="invoice-style">
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

.invoice-section {
    margin-bottom: 140px;
}

.invoice-card {
    background: #fff;
    box-shadow: 0px 1px 13px rgba(0, 0, 0, 0.05);
    border-radius: 8px;
    padding: 34px;
}

.invoice-top {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 18px;
    padding-bottom: 22px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.12);
    margin-bottom: 22px;
}

.brand h2 {
    font-size: 22px;
    font-weight: 600;
}

.brand p {
    color: rgba(0, 0, 0, 0.6);
    margin-top: 6px;
}

.meta {
    display: flex;
    flex-direction: column;
    gap: 8px;
    min-width: 260px;
}

.meta-row {
    display: flex;
    justify-content: space-between;
    gap: 12px;
}

.pill {
    display: inline-flex;
    padding: 4px 10px;
    border-radius: 999px;
    border: 1px solid rgba(0, 0, 0, 0.12);
    background: var(--bg-gray);
    font-size: 12px;
    font-weight: 600;
}

.invoice-grid {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 18px;
    margin-bottom: 22px;
}

.bill-to h3,
.notes h3 {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 10px;
}

.bill-to .name {
    font-weight: 600;
    margin-bottom: 6px;
}

.actions {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    justify-content: flex-end;
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
    text-decoration: none;
    color: inherit;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.btn-secondary:hover {
    background-color: #000;
    color: #fff;
    border-color: #000;
}

.items-table {
    border-top: 1px solid rgba(0, 0, 0, 0.12);
    border-bottom: 1px solid rgba(0, 0, 0, 0.12);
    padding: 16px 0;
    margin-bottom: 22px;
}

.table-head,
.table-row {
    display: grid;
    grid-template-columns: 2fr 1fr 0.6fr 1fr;
    gap: 14px;
    padding: 10px 0;
    align-items: center;
}

.table-head {
    font-weight: 600;
}

.table-row {
    border-top: 1px solid rgba(0, 0, 0, 0.06);
}

.right {
    text-align: right;
}

.title {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.totals {
    max-width: 420px;
    margin-left: auto;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.total-row {
    display: flex;
    justify-content: space-between;
}

.total-strong span:last-child {
    font-weight: 600;
}

.notes {
    margin-top: 24px;
    background: var(--bg-gray);
    border-radius: 8px;
    padding: 16px;
}

.notes pre {
    white-space: pre-wrap;
    font-family: 'Poppins', sans-serif;
    font-size: 14px;
    color: rgba(0, 0, 0, 0.75);
}

@media (max-width: 768px) {
    .invoice-top {
        flex-direction: column;
    }

    .meta {
        min-width: 0;
        width: 100%;
    }

    .invoice-grid {
        flex-direction: column;
    }

    .actions {
        width: 100%;
        justify-content: flex-start;
    }

    .table-head,
    .table-row {
        grid-template-columns: 1.6fr 1fr 0.6fr 1fr;
    }
}

@media print {

    .top-header,
    .navbar,
    .footer,
    #global-toast-wrapper,
    .breadcrumb-container,
    .actions {
        display: none !important;
    }

    .invoice-section {
        margin-bottom: 0;
    }

    .invoice-card {
        box-shadow: none;
        padding: 0;
    }
}
</style>
@endpush