<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - ShantoGiftShop</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
<main class="page">
    @php
        $isPaid = $order->payment_status === 'paid';
    @endphp

    <div class="invoice-card">
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
</main>

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
    --bg-gray: #F5F5F5;
    --brand-blue: #1aa6d9;
    --brand-dark: #2b2f33;
}

.page {
    max-width: 900px;
    margin: 0 auto;
    padding: 24px;
}

.invoice-card {
    background: #fff;
    border-radius: 8px;
    padding: 0;
    border: 1px solid rgba(0, 0, 0, 0.08);
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
    font-weight: 500;
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

@media print {
    .page {
        padding: 0;
    }
    .invoice-card {
        border: none;
        padding: 0;
        border-radius: 0;
    }
}
</style>
</body>
</html>
