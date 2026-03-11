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
    <div class="invoice-card">
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
}

.page {
    max-width: 900px;
    margin: 0 auto;
    padding: 24px;
}

.invoice-card {
    background: #fff;
    border-radius: 8px;
    padding: 34px;
    border: 1px solid rgba(0, 0, 0, 0.08);
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
