@extends('admin.layout')

@section('title', 'Create Coupon')
@section('header', 'Create Coupon')

@section('content')
<div class="card admin-card" style="background: #fff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); max-width: 600px; margin: 0 auto;">
    <div style="padding: 20px; border-bottom: 1px solid #eee;">
        <h3 style="margin: 0;">Create New Coupon</h3>
    </div>
    
    <div style="padding: 20px;">
        <form action="{{ route('admin.coupons.store') }}" method="POST">
            @csrf
            
            <div style="margin-bottom: 20px;">
                <label for="code" style="display: block; margin-bottom: 8px; font-weight: 500;">Coupon Code</label>
                <input type="text" name="code" id="code" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; text-transform: uppercase;" value="{{ old('code') }}">
                @error('code') <div style="color: #dc3545; font-size: 0.85rem; margin-top: 4px;">{{ $message }}</div> @enderror
            </div>

            <div style="margin-bottom: 20px;">
                <label for="type" style="display: block; margin-bottom: 8px; font-weight: 500;">Type</label>
                <select name="type" id="type" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; background: #fff;">
                    <option value="fixed" {{ old('type') == 'fixed' ? 'selected' : '' }}>Fixed Amount</option>
                    <option value="percent" {{ old('type') == 'percent' ? 'selected' : '' }}>Percentage</option>
                </select>
            </div>

            <div style="margin-bottom: 20px;">
                <label for="value" style="display: block; margin-bottom: 8px; font-weight: 500;">Value</label>
                <input type="number" name="value" id="value" step="0.01" min="0" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;" value="{{ old('value') }}">
                @error('value') <div style="color: #dc3545; font-size: 0.85rem; margin-top: 4px;">{{ $message }}</div> @enderror
            </div>

            <div class="admin-form-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div>
                    <label for="min_spend" style="display: block; margin-bottom: 8px; font-weight: 500;">Min Spend (Optional)</label>
                    <input type="number" name="min_spend" id="min_spend" step="0.01" min="0" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;" value="{{ old('min_spend') }}">
                </div>
                <div>
                    <label for="usage_limit" style="display: block; margin-bottom: 8px; font-weight: 500;">Usage Limit (Optional)</label>
                    <input type="number" name="usage_limit" id="usage_limit" min="1" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;" value="{{ old('usage_limit') }}">
                </div>
            </div>

            <div class="admin-form-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div>
                    <label for="start_date" style="display: block; margin-bottom: 8px; font-weight: 500;">Start Date</label>
                    <input type="date" name="start_date" id="start_date" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;" value="{{ old('start_date') }}">
                </div>
                <div>
                    <label for="end_date" style="display: block; margin-bottom: 8px; font-weight: 500;">End Date</label>
                    <input type="date" name="end_date" id="end_date" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;" value="{{ old('end_date') }}">
                </div>
            </div>

            <div style="margin-bottom: 25px;">
                <label style="display: flex; align-items: center; cursor: pointer;">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} style="width: 18px; height: 18px; margin-right: 10px;">
                    <span style="font-weight: 500;">Active</span>
                </label>
            </div>

            <div class="admin-form-actions" style="display: flex; gap: 10px;">
                <button type="submit" style="background: var(--primary-color); color: #fff; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; font-size: 1rem;">Create Coupon</button>
                <a href="{{ route('admin.coupons.index') }}" style="background: #f8f9fa; color: #333; border: 1px solid #ddd; padding: 10px 20px; border-radius: 4px; text-decoration: none; display: inline-block;">Cancel</a>
            </div>
        </form>
    </div>
</div>

<style>
    @media (max-width: 768px) {
        .admin-card > div[style*="padding: 20px"] {
            padding: 14px !important;
        }

        .admin-form-grid {
            grid-template-columns: 1fr !important;
            gap: 14px !important;
        }

        .admin-form-actions {
            flex-direction: column;
        }

        .admin-form-actions a,
        .admin-form-actions button {
            width: 100%;
            text-align: center;
        }
    }
</style>
@endsection
