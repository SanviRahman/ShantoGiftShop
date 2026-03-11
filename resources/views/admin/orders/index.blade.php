@extends('admin.layout')

@section('title', 'Orders Management')
@section('header', 'Orders Management')

@section('content')
<div class="card" style="background: #fff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); overflow: hidden;">
    <div style="padding: 20px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center;">
        <h3 style="margin: 0;">All Orders</h3>
        <span style="font-size: 0.9rem; color: #666;">Total: {{ $orders->total() }}</span>
    </div>
    
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f8f9fa; text-align: left;">
                    <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">Order #</th>
                    <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">Customer</th>
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
                         {{-- Fake Order Detection Logic --}}
                         @if($order->payment_method == 'cash_on_delivery' && $order->total > 5000 && $order->user_id == null)
                            <span style="color: #dc3545; font-weight: bold; font-size: 0.85rem;"><i class="fas fa-exclamation-triangle"></i> High Risk</span>
                         @elseif($order->payment_method == 'cash_on_delivery' && $order->total > 2000)
                            <span style="color: #ffc107; font-weight: bold; font-size: 0.85rem;">Check</span>
                         @else
                            <span style="color: #28a745; font-size: 0.85rem;">Normal</span>
                         @endif
                    </td>
                    <td style="padding: 12px 20px;">
                        <a href="{{ route('orders.show', ['order' => $order, 'token' => $order->public_token]) }}" target="_blank" style="color: #1aa6d9; margin-right: 10px;">
                            <i class="fas fa-eye"></i>
                        </a>
                        {{-- Add status change modal/dropdown here --}}
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
@endsection
