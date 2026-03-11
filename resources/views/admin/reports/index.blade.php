@extends('admin.layout')

@section('title', 'Reports')
@section('header', 'Reports')

@section('content')
<div class="card" style="background: #fff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); margin-bottom: 20px;">
    <div style="padding: 20px; border-bottom: 1px solid #eee;">
        <h3 style="margin: 0;">Sales Report</h3>
    </div>
    
    <div style="padding: 20px;">
        <form action="{{ route('admin.reports.index') }}" method="GET" style="display: flex; gap: 20px; align-items: flex-end; margin-bottom: 30px;">
            <div>
                <label for="start_date" style="display: block; margin-bottom: 8px; font-weight: 500;">Start Date</label>
                <input type="date" name="start_date" id="start_date" value="{{ $startDate }}"
                    style="padding: 8px 12px; border: 1px solid #ddd; border-radius: 4px;">
            </div>
            <div>
                <label for="end_date" style="display: block; margin-bottom: 8px; font-weight: 500;">End Date</label>
                <input type="date" name="end_date" id="end_date" value="{{ $endDate }}"
                    style="padding: 8px 12px; border: 1px solid #ddd; border-radius: 4px;">
            </div>
            <button type="submit" 
                style="background: var(--primary-color); color: #fff; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer;">
                Filter
            </button>
        </form>

        <div style="margin-bottom: 40px;">
            <h4 style="margin-bottom: 15px;">Daily Sales</h4>
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: #f8f9fa; text-align: left;">
                            <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">Date</th>
                            <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">Orders</th>
                            <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">Revenue</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($salesData as $data)
                        <tr style="border-bottom: 1px solid #dee2e6;">
                            <td style="padding: 12px 20px;">{{ $data->date }}</td>
                            <td style="padding: 12px 20px;">{{ $data->total_orders }}</td>
                            <td style="padding: 12px 20px;">${{ number_format($data->total_revenue, 2) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" style="padding: 20px; text-align: center; color: #888;">No sales data found for this period.</td>
                        </tr>
                        @endforelse
                        @if($salesData->isNotEmpty())
                        <tr style="background: #f8f9fa; font-weight: bold;">
                            <td style="padding: 12px 20px;">Total</td>
                            <td style="padding: 12px 20px;">{{ $salesData->sum('total_orders') }}</td>
                            <td style="padding: 12px 20px;">${{ number_format($salesData->sum('total_revenue'), 2) }}</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div>
            <h4 style="margin-bottom: 15px;">Top Selling Products</h4>
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: #f8f9fa; text-align: left;">
                            <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">Product</th>
                            <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">Quantity Sold</th>
                            <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">Total Sales</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($topProducts as $product)
                        <tr style="border-bottom: 1px solid #dee2e6;">
                            <td style="padding: 12px 20px;">{{ $product->product_title }}</td>
                            <td style="padding: 12px 20px;">{{ $product->total_quantity }}</td>
                            <td style="padding: 12px 20px;">${{ number_format($product->total_sales, 2) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" style="padding: 20px; text-align: center; color: #888;">No product sales found for this period.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
