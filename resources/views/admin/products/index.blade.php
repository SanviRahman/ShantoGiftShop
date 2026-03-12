@extends('admin.layout')

@section('title', 'Products')
@section('header', 'Products')

@section('content')
<div class="card admin-card" style="background: #fff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); overflow: hidden;">
    <div class="admin-card-head" style="padding: 20px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center; gap: 10px; flex-wrap: wrap;">
        <h3 style="margin: 0;">All Products</h3>
        <a href="{{ route('admin.products.create') }}" class="btn-primary" style="background: var(--primary-color); color: #fff; text-decoration: none; padding: 8px 16px; border-radius: 4px; font-size: 0.9rem;">
            <i class="fas fa-plus"></i> Add New
        </a>
    </div>
    
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f8f9fa; text-align: left;">
                    <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">Image</th>
                    <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">Title</th>
                    <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">Category</th>
                    <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">Price</th>
                    <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">Stock</th>
                    <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">Status</th>
                    <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr style="border-bottom: 1px solid #dee2e6;">
                    <td style="padding: 12px 20px;">
                        <img src="{{ $product->image_url }}" alt="{{ $product->title }}" 
                             style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px; border: 1px solid #eee;">
                    </td>
                    <td style="padding: 12px 20px;">
                        <div style="font-weight: 500;">{{ $product->title }}</div>
                        <div style="font-size: 0.8rem; color: #888;">SKU: {{ $product->sku ?? 'N/A' }}</div>
                    </td>
                    <td style="padding: 12px 20px;">
                        {{ $product->category->name ?? 'Uncategorized' }}
                    </td>
                    <td style="padding: 12px 20px;">
                        ${{ number_format($product->price, 2) }}
                        @if($product->old_price)
                            <br><span style="text-decoration: line-through; color: #888; font-size: 0.8rem;">${{ number_format($product->old_price, 2) }}</span>
                        @endif
                    </td>
                    <td style="padding: 12px 20px;">
                        @if($product->stock_qty <= 5)
                            <span style="color: #dc3545; font-weight: bold;">{{ $product->stock_qty }} (Low)</span>
                        @else
                            {{ $product->stock_qty }}
                        @endif
                    </td>
                    <td style="padding: 12px 20px;">
                        @if($product->is_active)
                            <span style="color: #28a745; font-size: 0.85rem;"><i class="fas fa-check-circle"></i> Active</span>
                        @else
                            <span style="color: #dc3545; font-size: 0.85rem;"><i class="fas fa-times-circle"></i> Inactive</span>
                        @endif
                    </td>
                    <td style="padding: 12px 20px;">
                        <a href="{{ route('admin.products.edit', $product) }}" style="color: #ffc107; margin-right: 10px; font-size: 1.1rem;">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Are you sure?');" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: none; border: none; color: #dc3545; cursor: pointer; font-size: 1.1rem;">
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
        {{ $products->links() }}
    </div>
</div>

<style>
    @media (max-width: 768px) {
        .admin-card > div[style*="padding: 20px"] {
            padding: 14px !important;
        }

        .admin-card-head a {
            width: 100%;
            text-align: center;
        }
    }
</style>
@endsection
