@extends('admin.layout')

@section('title', 'Coupons')
@section('header', 'Coupons')

@section('content')
<div class="card admin-card" style="background: #fff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); overflow: hidden;">
    <div class="admin-card-head" style="padding: 20px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center; gap: 10px; flex-wrap: wrap;">
        <h3 style="margin: 0;">All Coupons</h3>
        <form method="GET" action="{{ route('admin.coupons.index') }}" style="display:flex; gap: 8px; align-items:center; flex-wrap: wrap; margin-left: auto;">
            <input type="text" name="q" value="{{ $q ?? '' }}" placeholder="Search coupons..."
                style="padding: 8px 12px; border: 1px solid #ddd; border-radius: 6px; min-width: 220px;">
            <button type="submit" style="background: #1aa6d9; color:#fff; border: 1px solid #1aa6d9; padding: 8px 12px; border-radius: 6px; cursor:pointer;">
                <i class="fas fa-search"></i>
            </button>
            @if(!empty($q))
                <a href="{{ route('admin.coupons.index') }}" style="background: #f8f9fa; color:#333; border: 1px solid #ddd; padding: 8px 12px; border-radius: 6px; text-decoration:none;">
                    Clear
                </a>
            @endif
        </form>
        <a href="{{ route('admin.coupons.create') }}" class="btn-primary" style="background: var(--primary-color); color: #fff; text-decoration: none; padding: 8px 16px; border-radius: 4px; font-size: 0.9rem;">
            <i class="fas fa-plus"></i> Add New
        </a>
    </div>
    
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f8f9fa; text-align: left;">
                    <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">Code</th>
                    <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">Type</th>
                    <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">Value</th>
                    <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">Usage</th>
                    <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">Status</th>
                    <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($coupons as $coupon)
                <tr style="border-bottom: 1px solid #dee2e6;">
                    <td style="padding: 12px 20px; font-weight: bold; color: #555;">{{ $coupon->code }}</td>
                    <td style="padding: 12px 20px;">{{ ucfirst($coupon->type) }}</td>
                    <td style="padding: 12px 20px;">
                        @if($coupon->type == 'percent')
                            {{ $coupon->value }}%
                        @else
                            ${{ $coupon->value }}
                        @endif
                    </td>
                    <td style="padding: 12px 20px;">
                        {{ $coupon->used_count }} / {{ $coupon->usage_limit ?? '∞' }}
                    </td>
                    <td style="padding: 12px 20px;">
                        @if($coupon->is_active)
                            <span style="color: #28a745; font-size: 0.85rem;"><i class="fas fa-check-circle"></i> Active</span>
                        @else
                            <span style="color: #dc3545; font-size: 0.85rem;"><i class="fas fa-times-circle"></i> Inactive</span>
                        @endif
                    </td>
                    <td style="padding: 12px 20px;">
                        <a href="{{ route('admin.coupons.edit', $coupon) }}" style="color: #ffc107; margin-right: 10px; font-size: 1.1rem;">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.coupons.destroy', $coupon) }}" method="POST" onsubmit="return confirm('Are you sure?');" style="display: inline;">
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
        {{ $coupons->links() }}
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

        .admin-card-head a {
            width: 100%;
            text-align: center;
        }
    }
</style>
@endsection
