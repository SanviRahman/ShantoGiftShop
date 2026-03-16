@extends('home.layout')

@section('title', 'Invoice - ShantoGiftShop')

@section('content')
<div class="container breadcrumb-container" style="margin-top: 100px;">
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <span class="separator">/</span>
        <span class="current">Invoice</span>
    </div>
</div>

<section class="invoice-section container" style="margin-top:50px">
    @php
    $invoiceToken = request('token') ?: $order->public_token;
    $canPay = $order->payment_method !== 'cash_on_delivery' && $order->payment_status !== 'paid';
    $isPaid = $order->payment_status === 'paid';
    @endphp


    <div class="invoice-card" id="invoice-card">
        <div class="invoice-header">
            <div class="brand-area">
                <div class="brand-mark">SGS</div>
                <div class="brand-text">
                    <div class="brand-name">ShantoGiftShop</div>
                    <div class="brand-sub">INVOICE</div>
                </div>
            </div>

            <div class="invoice-banner">
                <div class="banner-dark"></div>
                <div class="banner-accent"></div>
                <div class="banner-title">INVOICE</div>
            </div>
        </div>

        <div class="invoice-meta-row">
            <div class="meta-left">
                <div><span class="meta-label">Name:</span> <span class="meta-value">{{ $order->customer_name }}</span></div>
                <div><span class="meta-label">Email:</span> <span class="meta-value">{{ $order->email }}</span></div>
                <div><span class="meta-label">Mobile:</span> <span class="meta-value">{{ $order->phone }}</span></div>
            </div>
            <div class="meta-right">
                <div><span class="meta-label">Invoice#:</span> <span class="meta-value">{{ $order->order_number }}</span></div>
                <div><span class="meta-label">Date:</span> <span class="meta-value">{{ $order->created_at->format('M d, Y') }}</span></div>
            </div>
        </div>

        <div class="invoice-table">
            <div class="invoice-table-head">
                <div class="th sl">SL</div>
                <div class="th title">Product Title</div>
                <div class="th price">Price</div>
                <div class="th paid">Paid</div>
                <div class="th due">Due</div>
            </div>

            @foreach($order->items as $index => $item)
                @php
                    $linePrice = (float) $item->subtotal;
                    $linePaid = $isPaid ? $linePrice : 0;
                    $lineDue = $isPaid ? 0 : $linePrice;
                @endphp
                <div class="invoice-table-row">
                    <div class="td sl">{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</div>
                    <div class="td title">
                        <div>
                            <div>{{ $item->product_title }}</div>
                            @if(!empty($item->size))
                                <div style="font-size: 12px; color: rgba(0,0,0,0.65); margin-top: 4px;">Size: {{ $item->size }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="td price">${{ number_format($linePrice, 0) }}</div>
                    <div class="td paid">${{ number_format($linePaid, 0) }}</div>
                    <div class="td due">${{ number_format($lineDue, 0) }}</div>
                </div>
            @endforeach
        </div>

        <div class="invoice-bottom">
            <div class="invoice-message">
                <div class="msg-title">Thank you for Order!</div>
                <div class="msg-text" style="text-align:justify;">
                    Your order has been received successfully. Our team will contact you shortly.Your order is now being processed. We will arrange delivery as soon as possible.
                </div>
                @if($order->notes)
                    <div class="msg-notes">
                        <div class="msg-notes-title">Notes</div>
                        <div class="msg-notes-body">{{ $order->notes }}</div>
                    </div>
                @endif
            </div>

            <div class="invoice-totals">
                <div class="sum-row">
                    <span>Discount</span>
                    <span>${{ number_format((float) $order->discount_amount, 0) }}</span>
                </div>
                <div class="sum-row">
                    <span>Sub Total</span>
                    <span>${{ number_format((float) $order->subtotal, 0) }}</span>
                </div>
                <div class="sum-row sum-strong">
                    <span>Total</span>
                    <span>${{ number_format((float) $order->total, 0) }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="invoice-actions-bar"style="margin-top:40px">
        <a
            class="btn-secondary"
            href="{{ route('orders.show', ['order' => $order, 'token' => $invoiceToken, 'download' => 1]) }}"
        >Download</a>
        <button type="button" class="btn-secondary" id="print-invoice">Print</button>

        @if($canPay)
            <a
                class="btn-primary"
                href="{{ route('orders.payments.create', ['order' => $order, 'token' => $invoiceToken]) }}"
            >Pay Now</a>
        @else
            <a class="btn-secondary" href="{{ route('products.index') }}">Continue Shopping</a>
            <a class="btn-secondary" href="{{ route('home') }}">Home</a>
        @endif
    </div>
</section>

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
    --brand-blue: #1aa6d9;
    --brand-dark: #2b2f33;
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

.invoice-actions-bar {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    justify-content: flex-end;
    margin-bottom: 16px;
}

.invoice-card {
    background: #fff;
    box-shadow: 0px 1px 13px rgba(0, 0, 0, 0.05);
    border-radius: 8px;
    padding: 0;
    overflow: hidden;
}

.invoice-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 18px;
    padding: 16px 18px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.14);
}

.brand-area {
    display: flex;
    align-items: center;
    gap: 12px;
}

.brand-mark {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    background: var(--brand-blue);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 800;
    letter-spacing: 0.04em;
}

.brand-text {
    display: flex;
    flex-direction: column;
    line-height: 1.2;
}

.brand-name {
    font-size: 16px;
    font-weight: 700;
    letter-spacing: 0.02em;
}

.brand-sub {
    font-size: 12px;
    font-weight: 600;
    color: rgba(0, 0, 0, 0.55);
}

.invoice-banner {
    position: relative;
    width: 340px;
    height: 54px;
    overflow: hidden;
    border-radius: 6px;
    background: var(--brand-blue);
    display: flex;
    align-items: center;
    justify-content: center;
}

.invoice-banner .banner-dark {
    position: absolute;
    right: -80px;
    top: 0;
    width: 260px;
    height: 100%;
    background: var(--brand-dark);
    transform: skewX(-25deg);
    opacity: 0.95;
}

.invoice-banner .banner-accent {
    position: absolute;
    right: 130px;
    top: 0;
    width: 70px;
    height: 100%;
    background: rgba(255, 255, 255, 0.35);
    transform: skewX(-25deg);
}

.invoice-banner .banner-title {
    position: relative;
    font-size: 22px;
    letter-spacing: 0.15em;
    font-weight: 800;
    color: #fff;
}

.invoice-meta-row {
    display: flex;
    justify-content: space-between;
    gap: 18px;
    padding: 16px 18px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.14);
    background: #fff;
}

.meta-left,
.meta-right {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.meta-label {
    font-weight: 700;
}

.meta-value {
    font-weight: 500;
}

.invoice-table {
    padding: 0 18px 14px 18px;
}

.invoice-table-head,
.invoice-table-row {
    display: grid;
    grid-template-columns: 70px 1fr 140px 140px 140px;
    border-left: 1px solid rgba(0, 0, 0, 0.18);
    border-right: 1px solid rgba(0, 0, 0, 0.18);
}

.invoice-table-head {
    margin-top: 14px;
    background: var(--brand-blue);
    color: #fff;
    border-top: 1px solid rgba(0, 0, 0, 0.18);
}

.invoice-table-head .th {
    padding: 10px 12px;
    font-weight: 700;
    font-size: 14px;
    border-right: 1px solid rgba(255, 255, 255, 0.25);
}

.invoice-table-row {
    min-height: 64px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.18);
}

.invoice-table-row .td {
    padding: 10px 12px;
    font-size: 14px;
    border-right: 1px solid rgba(0, 0, 0, 0.18);
    display: flex;
    align-items: center;
}

.invoice-table-row .td.title {
    align-items: flex-start;
    padding-top: 14px;
}

.invoice-bottom {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    gap: 18px;
    padding: 18px;
}

.invoice-message {
    flex: 1;
    min-width: 0;
}

.msg-title {
    font-weight: 800;
    margin-bottom: 6px;
}

.msg-text {
    font-size: 12px;
    color: rgba(0, 0, 0, 0.7);
    max-width: 520px;
}

.msg-notes {
    margin-top: 12px;
}

.msg-notes-title {
    font-weight: 700;
    font-size: 12px;
    margin-bottom: 6px;
}

.msg-notes-body {
    font-size: 12px;
    color: rgba(0, 0, 0, 0.7);
    white-space: pre-wrap;
}

.invoice-totals {
    width: 260px;
    display: flex;
    flex-direction: column;
    gap: 6px;
    font-size: 14px;
}

.sum-row {
    display: flex;
    justify-content: space-between;
    gap: 12px;
}

.sum-strong {
    font-weight: 800;
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


@media (max-width: 1199px) {
    .invoice-header,
    .invoice-meta-row,
    .invoice-bottom {
        padding-left: 18px;
        padding-right: 18px;
    }

    .invoice-table {
        padding-left: 18px;
        padding-right: 18px;
    }
}

@media (max-width: 991px) {
    .breadcrumb-container {
        margin-top: 82px !important;
        margin-bottom: 24px;
    }

    .invoice-section {
        margin-top: 24px !important;
        margin-bottom: 72px;
    }

    .invoice-header {
        flex-direction: column;
        align-items: stretch;
    }

    .invoice-banner {
        width: 100%;
    }

    .invoice-meta-row {
        flex-direction: column;
        gap: 14px;
    }

    .invoice-bottom {
        flex-direction: column;
        align-items: stretch;
    }

    .invoice-totals {
        width: 100%;
        max-width: 340px;
        margin-left: auto;
    }

    .invoice-actions-bar {
        justify-content: flex-start;
    }
}

@media (max-width: 767px) {
    .container {
        padding-left: 14px;
        padding-right: 14px;
    }

    .breadcrumb-container {
        margin-top: 74px !important;
        margin-bottom: 20px;
    }

    .invoice-section {
        margin-top: 18px !important;
        margin-bottom: 56px;
    }

    .invoice-header,
    .invoice-meta-row,
    .invoice-bottom {
        padding: 16px;
    }

    .invoice-table {
        padding: 0 16px 14px;
    }

    .brand-mark {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        font-size: 14px;
    }

    .brand-name {
        font-size: 15px;
    }

    .invoice-banner {
        height: 50px;
    }

    .invoice-banner .banner-title {
        font-size: 18px;
        letter-spacing: 0.12em;
    }

    .invoice-table-head,
    .invoice-table-row {
        min-width: 680px;
        grid-template-columns: 60px minmax(220px, 1fr) 130px 130px 130px;
    }

    .invoice-table-head .th,
    .invoice-table-row .td {
        font-size: 13px;
        padding: 10px;
    }

    .invoice-actions-bar {
        gap: 10px;
    }

    .btn-primary,
    .btn-secondary {
        font-size: 15px;
        padding: 13px 18px;
    }
}

@media (max-width: 575px) {
    .breadcrumb {
        font-size: 13px;
    }

    .invoice-card {
        border-radius: 8px;
    }

    .invoice-header,
    .invoice-meta-row,
    .invoice-bottom {
        padding: 14px;
    }

    .invoice-table {
        padding: 0 14px 12px;
    }

    .brand-area {
        gap: 10px;
    }

    .brand-mark {
        width: 38px;
        height: 38px;
    }

    .brand-name {
        font-size: 14px;
    }

    .brand-sub {
        font-size: 11px;
    }

    .invoice-banner {
        height: 46px;
        border-radius: 5px;
    }

    .invoice-banner .banner-title {
        font-size: 16px;
        letter-spacing: 0.1em;
    }

    .invoice-table-head,
    .invoice-table-row {
        min-width: 620px;
        grid-template-columns: 54px minmax(180px, 1fr) 128px 128px 128px;
    }

    .msg-text,
    .msg-notes-title,
    .msg-notes-body {
        font-size: 11px;
    }

    .invoice-totals {
        max-width: 100%;
        font-size: 13px;
    }

    .invoice-actions-bar {
        flex-direction: column;
        align-items: stretch;
    }

    .invoice-actions-bar .btn-primary,
    .invoice-actions-bar .btn-secondary,
    .invoice-actions-bar button {
        width: 100%;
    }
}

@media (max-width: 420px) {
    .breadcrumb-container {
        margin-top: 68px !important;
    }

    .invoice-header,
    .invoice-meta-row,
    .invoice-bottom {
        padding: 12px;
    }

    .invoice-table {
        padding: 0 12px 12px;
    }

    .invoice-banner {
        height: 42px;
    }

    .invoice-banner .banner-title {
        font-size: 15px;
        letter-spacing: 0.08em;
    }

    .invoice-table-head,
    .invoice-table-row {
        min-width: 580px;
        grid-template-columns: 50px minmax(170px, 1fr) 120px 120px 120px;
    }

    .invoice-table-head .th,
    .invoice-table-row .td {
        padding: 9px 8px;
        font-size: 12px;
    }

    .btn-primary,
    .btn-secondary {
        font-size: 14px;
        padding: 12px 16px;
    }
}

@media print {
    .top-header,
    .navbar,
    .footer,
    #global-toast-wrapper,
    .breadcrumb-container,
    .invoice-actions-bar {
        display: none !important;
    }

    .invoice-section {
        margin: 0 !important;
    }

    .invoice-card {
        box-shadow: none;
        padding: 0;
        border-radius: 0;
    }

    .invoice-table {
        overflow: visible !important;
    }

    .invoice-table-head,
    .invoice-table-row {
        min-width: 0 !important;
        width: 100% !important;
    }
}
</style>
@endpush
@endsection
