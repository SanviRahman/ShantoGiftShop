@extends('admin.layout')

@section('title', 'Orders Management')
@section('header', 'Orders Management')

@section('content')
<div class="card admin-card" style="background: #fff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); overflow: hidden;">
    <div class="admin-card-head" style="padding: 20px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center; gap: 10px; flex-wrap: wrap;">
        <h3 style="margin: 0;">All Orders</h3>
        <form method="GET" action="{{ route('admin.orders.index') }}" style="display:flex; gap: 8px; align-items:center; flex-wrap: wrap; margin-left: auto;">
            <input type="text" name="q" value="{{ $q ?? '' }}" placeholder="Search orders..."
                style="padding: 8px 12px; border: 1px solid #ddd; border-radius: 6px; min-width: 220px;">
            <button type="submit" style="background: #1aa6d9; color:#fff; border: 1px solid #1aa6d9; padding: 8px 12px; border-radius: 6px; cursor:pointer;">
                <i class="fas fa-search"></i>
            </button>
            @if(!empty($q))
                <a href="{{ route('admin.orders.index') }}" style="background: #f8f9fa; color:#333; border: 1px solid #ddd; padding: 8px 12px; border-radius: 6px; text-decoration:none;">
                    Clear
                </a>
            @endif
        </form>
        <span style="font-size: 0.9rem; color: #666;">Total: {{ $orders->total() }}</span>
    </div>
    
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f8f9fa; text-align: left;">
                    <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">Order #</th>
                    <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">Customer</th>
                    <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">Sizes</th>
                    <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">Date</th>
                    <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">Amount</th>
                    <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">Payment</th>
                    <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">Status</th>
                    <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">Risk</th>
                    <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr style="border-bottom: 1px solid #dee2e6;">
                    <td style="padding: 12px 20px;">{{ $order->order_number }}</td>
                    <td style="padding: 12px 20px;">
                        <div style="font-weight: 500;">{{ $order->customer_name }}</div>
                        <div style="font-size: 0.85rem; color: #888;">{{ $order->phone }}</div>
                    </td>
                    <td style="padding: 12px 20px;">
                        @php
                            $sizes = collect($order->items ?? [])
                                ->pluck('size')
                                ->filter()
                                ->unique()
                                ->values();
                        @endphp
                        @if($sizes->isNotEmpty())
                            <span style="font-size: 0.9rem; font-weight: 600;">{{ $sizes->implode(', ') }}</span>
                        @else
                            <span style="color:#888;">—</span>
                        @endif
                    </td>
                    <td style="padding: 12px 20px;">{{ $order->created_at->format('M d, Y') }}</td>
                    <td style="padding: 12px 20px;">${{ number_format($order->total) }}</td>
                    <td style="padding: 12px 20px;">
                        <div style="text-transform: capitalize;">{{ str_replace('_', ' ', $order->payment_method) }}</div>
                        @if($order->payment_status === 'paid')
                            <span style="background: #d4edda; color: #155724; padding: 2px 6px; border-radius: 4px; font-size: 0.75rem;">Paid</span>
                        @else
                            <span style="background: #fff3cd; color: #856404; padding: 2px 6px; border-radius: 4px; font-size: 0.75rem;">{{ ucfirst($order->payment_status) }}</span>
                        @endif
                    </td>
                    <td style="padding: 12px 20px;">
                        <span style="padding: 4px 8px; border-radius: 4px; font-size: 0.85rem; background: #e2e3e5; color: #383d41;">
                            {{ ucfirst($order->order_status) }}
                        </span>
                    </td>
                    <td style="padding: 12px 20px;">
                        @if(($order->risk_level ?? 'low') === 'high')
                            <span style="color: #dc3545; font-weight: bold; font-size: 0.85rem;"><i class="fas fa-exclamation-triangle"></i> High</span>
                        @elseif(($order->risk_level ?? 'low') === 'medium')
                            <span style="color: #ffc107; font-weight: bold; font-size: 0.85rem;">Medium</span>
                        @else
                            <span style="color: #28a745; font-size: 0.85rem;">Low</span>
                        @endif
                        <div style="font-size: 0.8rem; color:#888; margin-top: 2px;">Score: {{ (int) ($order->risk_score ?? 0) }}</div>
                    </td>
                    <td style="padding: 12px 20px;">
                        <a href="{{ route('admin.orders.show', $order) }}" style="color: #6f42c1; margin-right: 10px;">
                            <i class="fas fa-pen"></i>
                        </a>
                        <a href="{{ route('orders.show', ['order' => $order, 'download' => 1]) }}" style="color: #28a745; margin-right: 10px;">
                            <i class="fas fa-download"></i>
                        </a>
                        <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" onsubmit="return confirm('Delete this order?');" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: none; border: none; color: #dc3545; cursor: pointer;">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div style="padding: 20px;">
        {{ $orders->links() }}
    </div>
</div>

<style>
    @media (max-width: 768px) {
        .admin-card > div[style*="padding: 20px"] {
            padding: 14px !important;
        }

        .admin-card-head form {
            width: 100%;
            margin-left: 0 !important;
        }

        .admin-card-head form input {
            width: 100%;
            min-width: 0 !important;
        }

        .admin-card-head form button,
        .admin-card-head form a {
            width: 100%;
            text-align: center;
        }
    }
</style>
@endsection
