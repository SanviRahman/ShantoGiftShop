@extends('admin.layout')

@section('title', 'Order Details')
@section('header', 'Order Details')

@section('content')
<div style="display: grid; grid-template-columns: 1.2fr 0.8fr; gap: 20px;">
    <div style="background: #fff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); overflow: hidden;">
        <div style="padding: 20px; border-bottom: 1px solid #eee; display:flex; justify-content: space-between; align-items:center; gap: 12px;">
            <div>
                <h3 style="margin: 0;">{{ $order->order_number }}</h3>
                <div style="color:#666; font-size:0.9rem; margin-top: 4px;">
                    {{ $order->created_at->format('M d, Y h:i A') }}
                </div>
            </div>
            <div style="display:flex; gap: 10px; flex-wrap: wrap; justify-content:flex-end;">
                <a href="{{ route('orders.show', ['order' => $order]) }}" target="_blank" style="background: #f8f9fa; color: #333; border: 1px solid #ddd; padding: 8px 12px; border-radius: 6px; text-decoration: none;">
                    <i class="fas fa-eye"></i> View Invoice
                </a>
                <a href="{{ route('orders.show', ['order' => $order, 'download' => 1]) }}" style="background: #28a745; color: #fff; border: 1px solid #28a745; padding: 8px 12px; border-radius: 6px; text-decoration: none;">
                    <i class="fas fa-download"></i> Download Invoice
                </a>
                <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" onsubmit="return confirm('Delete this order?');" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background: #dc3545; color: #fff; border: 1px solid #dc3545; padding: 8px 12px; border-radius: 6px; cursor: pointer;">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </form>
            </div>
        </div>

        <div style="padding: 20px;">
            <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 18px;">
                <div style="border: 1px solid #eee; border-radius: 8px; padding: 14px;">
                    <div style="font-weight: 600; margin-bottom: 8px;">Customer</div>
                    <div style="color:#333;">{{ $order->customer_name }}</div>
                    <div style="color:#666; margin-top: 6px;">{{ $order->email }}</div>
                    <div style="color:#666; margin-top: 2px;">{{ $order->phone }}</div>
                </div>
                <div style="border: 1px solid #eee; border-radius: 8px; padding: 14px;">
                    <div style="font-weight: 600; margin-bottom: 8px;">Shipping</div>
                    <div style="color:#333;">{{ $order->address }}</div>
                    <div style="color:#666; margin-top: 6px;">{{ $order->city }} {{ $order->postal_code }}</div>
                    <div style="color:#666; margin-top: 2px;">{{ $order->country }}</div>
                </div>
            </div>

            <div style="overflow-x:auto; border: 1px solid #eee; border-radius: 8px;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background:#f8f9fa; text-align:left;">
                            <th style="padding: 12px 14px; border-bottom: 1px solid #eee;">Product</th>
                            <th style="padding: 12px 14px; border-bottom: 1px solid #eee;">Unit</th>
                            <th style="padding: 12px 14px; border-bottom: 1px solid #eee;">Qty</th>
                            <th style="padding: 12px 14px; border-bottom: 1px solid #eee;">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                            <tr style="border-bottom: 1px solid #eee;">
                                <td style="padding: 12px 14px;">{{ $item->product_title }}</td>
                                <td style="padding: 12px 14px;">${{ number_format((float) $item->unit_price, 2) }}</td>
                                <td style="padding: 12px 14px;">{{ $item->quantity }}</td>
                                <td style="padding: 12px 14px;">${{ number_format((float) $item->subtotal, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-top: 18px;">
                <div style="border: 1px solid #eee; border-radius: 8px; padding: 14px;">
                    <div style="font-weight: 600; margin-bottom: 8px;">Notes</div>
                    <div style="color:#666; white-space: pre-line;">{{ $order->notes ?: '—' }}</div>
                </div>
                <div style="border: 1px solid #eee; border-radius: 8px; padding: 14px;">
                    <div style="display:flex; justify-content:space-between; margin-bottom: 6px;">
                        <span style="color:#666;">Subtotal</span>
                        <span style="font-weight:600;">${{ number_format((float) $order->subtotal, 2) }}</span>
                    </div>
                    <div style="display:flex; justify-content:space-between; margin-bottom: 6px;">
                        <span style="color:#666;">Discount</span>
                        <span style="font-weight:600;">-${{ number_format((float) $order->discount_amount, 2) }}</span>
                    </div>
                    <div style="display:flex; justify-content:space-between; margin-bottom: 6px;">
                        <span style="color:#666;">Shipping</span>
                        <span style="font-weight:600;">${{ number_format((float) $order->shipping_amount, 2) }}</span>
                    </div>
                    <div style="display:flex; justify-content:space-between; padding-top: 10px; border-top: 1px solid #eee;">
                        <span style="font-weight:700;">Total</span>
                        <span style="font-weight:800;">${{ number_format((float) $order->total, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="background: #fff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); overflow: hidden; height: fit-content;">
        <div style="padding: 20px; border-bottom: 1px solid #eee;">
            <h3 style="margin: 0;">Update Order</h3>
        </div>

        <div style="padding: 20px;">
            <div style="border: 1px solid #eee; border-radius: 8px; padding: 14px; margin-bottom: 14px; background:#fafafa;">
                <div style="display:flex; justify-content:space-between; align-items:flex-start; gap: 10px;">
                    <div>
                        <div style="font-weight: 700;">Verification</div>
                        <div style="margin-top: 6px; color:#666;">
                            Level: <span style="font-weight:700; text-transform: uppercase;">{{ $order->risk_level }}</span>
                            • Score: <span style="font-weight:700;">{{ (int) $order->risk_score }}</span>
                        </div>
                    </div>
                    <form action="{{ route('admin.orders.verify', $order) }}" method="POST">
                        @csrf
                        <button type="submit" style="background: #1aa6d9; color: #fff; border: 1px solid #1aa6d9; padding: 8px 12px; border-radius: 6px; cursor: pointer;">
                            <i class="fas fa-shield-alt"></i> Verify
                        </button>
                    </form>
                </div>

                <div style="margin-top: 10px; color:#555; white-space: pre-line; font-size: 0.9rem;">
                    {{ $order->verification_notes ?: 'No verification notes.' }}
                </div>
            </div>

            <form action="{{ route('admin.orders.update', $order) }}" method="POST" style="display:flex; flex-direction:column; gap: 14px;">
                @csrf
                @method('PUT')

                <div>
                    <label style="display:block; font-weight:600; margin-bottom: 6px;">Order Status</label>
                    <input name="order_status" value="{{ old('order_status', $order->order_status) }}" style="width:100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 6px;">
                </div>

                <div>
                    <label style="display:block; font-weight:600; margin-bottom: 6px;">Payment Status</label>
                    <input name="payment_status" value="{{ old('payment_status', $order->payment_status) }}" style="width:100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 6px;">
                </div>

                <div>
                    <label style="display:block; font-weight:600; margin-bottom: 6px;">Customer Name</label>
                    <input name="customer_name" value="{{ old('customer_name', $order->customer_name) }}" style="width:100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 6px;">
                </div>

                <div>
                    <label style="display:block; font-weight:600; margin-bottom: 6px;">Email</label>
                    <input name="email" value="{{ old('email', $order->email) }}" style="width:100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 6px;">
                </div>

                <div>
                    <label style="display:block; font-weight:600; margin-bottom: 6px;">Phone</label>
                    <input name="phone" value="{{ old('phone', $order->phone) }}" style="width:100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 6px;">
                </div>

                <div>
                    <label style="display:block; font-weight:600; margin-bottom: 6px;">Address</label>
                    <input name="address" value="{{ old('address', $order->address) }}" style="width:100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 6px;">
                </div>

                <div>
                    <label style="display:block; font-weight:600; margin-bottom: 6px;">City</label>
                    <input name="city" value="{{ old('city', $order->city) }}" style="width:100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 6px;">
                </div>

                <div>
                    <label style="display:block; font-weight:600; margin-bottom: 6px;">Postal Code</label>
                    <input name="postal_code" value="{{ old('postal_code', $order->postal_code) }}" style="width:100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 6px;">
                </div>

                <div>
                    <label style="display:block; font-weight:600; margin-bottom: 6px;">Country</label>
                    <input name="country" value="{{ old('country', $order->country) }}" style="width:100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 6px;">
                </div>

                <div>
                    <label style="display:block; font-weight:600; margin-bottom: 6px;">Notes</label>
                    <textarea name="notes" rows="4" style="width:100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 6px;">{{ old('notes', $order->notes) }}</textarea>
                </div>

                <button type="submit" style="background: var(--primary-color); color:#fff; border:none; padding: 12px 14px; border-radius: 8px; cursor:pointer; font-weight:600;">
                    Save Changes
                </button>
            </form>
        </div>
    </div>
</div>

<style>
    @media (max-width: 1100px) {
        body .content > div { grid-template-columns: 1fr !important; }
    }
</style>
@endsection
