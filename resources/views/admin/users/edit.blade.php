@extends('admin.layout')

@section('title', 'Edit User')
@section('header', 'Edit User')

@section('content')
<div class="card admin-card" style="background: #fff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); max-width: 980px; margin: 0 auto;">
    <div style="padding: 20px; border-bottom: 1px solid #eee; display:flex; justify-content: space-between; align-items:center; gap: 12px; flex-wrap: wrap;">
        <div>
            <h3 style="margin: 0;">Edit User #{{ $user->id }}</h3>
            <div style="margin-top: 6px; color:#666; font-size: 0.9rem;">{{ $user->email }}</div>
        </div>
        <a href="{{ route('admin.users.show', $user) }}" style="background: #f8f9fa; color: #333; border: 1px solid #ddd; padding: 8px 12px; border-radius: 6px; text-decoration: none;">
            Back
        </a>
    </div>

    <div style="padding: 20px;">
        <form action="{{ route('admin.users.update', $user) }}" method="POST" style="display:grid; grid-template-columns: 1fr 1fr; gap: 16px;">
            @csrf
            @method('PUT')

            <div style="grid-column: span 2;">
                <label for="name" style="display: block; margin-bottom: 8px; font-weight: 500;">Name</label>
                <input type="text" name="name" id="name" required
                    style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;"
                    value="{{ old('name', $user->name) }}">
                @error('name')
                    <div style="color: #dc3545; font-size: 0.85rem; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="email" style="display: block; margin-bottom: 8px; font-weight: 500;">Email</label>
                <input type="email" name="email" id="email" required
                    style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;"
                    value="{{ old('email', $user->email) }}">
                @error('email')
                    <div style="color: #dc3545; font-size: 0.85rem; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="phone" style="display: block; margin-bottom: 8px; font-weight: 500;">Phone</label>
                <input type="text" name="phone" id="phone"
                    style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;"
                    value="{{ old('phone', $user->phone) }}">
                @error('phone')
                    <div style="color: #dc3545; font-size: 0.85rem; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="grid-column: span 2; padding: 14px; border: 1px solid #eee; border-radius: 8px;">
                <label style="display:flex; align-items:center; gap: 10px; cursor: pointer;">
                    <input type="checkbox" name="email_verified" value="1" {{ old('email_verified', $user->email_verified_at ? 1 : 0) ? 'checked' : '' }}>
                    <span style="font-weight: 600;">Email Verified</span>
                </label>
            </div>

            <div>
                <label for="first_name" style="display: block; margin-bottom: 8px; font-weight: 500;">First Name</label>
                <input type="text" name="first_name" id="first_name"
                    style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;"
                    value="{{ old('first_name', $user->profile?->first_name) }}">
                @error('first_name')
                    <div style="color: #dc3545; font-size: 0.85rem; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="last_name" style="display: block; margin-bottom: 8px; font-weight: 500;">Last Name</label>
                <input type="text" name="last_name" id="last_name"
                    style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;"
                    value="{{ old('last_name', $user->profile?->last_name) }}">
                @error('last_name')
                    <div style="color: #dc3545; font-size: 0.85rem; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="grid-column: span 2;">
                <label for="address" style="display: block; margin-bottom: 8px; font-weight: 500;">Address</label>
                <input type="text" name="address" id="address"
                    style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;"
                    value="{{ old('address', $user->profile?->address) }}">
                @error('address')
                    <div style="color: #dc3545; font-size: 0.85rem; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="city" style="display: block; margin-bottom: 8px; font-weight: 500;">City</label>
                <input type="text" name="city" id="city"
                    style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;"
                    value="{{ old('city', $user->profile?->city) }}">
                @error('city')
                    <div style="color: #dc3545; font-size: 0.85rem; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="postal_code" style="display: block; margin-bottom: 8px; font-weight: 500;">Postal Code</label>
                <input type="text" name="postal_code" id="postal_code"
                    style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;"
                    value="{{ old('postal_code', $user->profile?->postal_code) }}">
                @error('postal_code')
                    <div style="color: #dc3545; font-size: 0.85rem; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="grid-column: span 2;">
                <label for="country" style="display: block; margin-bottom: 8px; font-weight: 500;">Country</label>
                <input type="text" name="country" id="country"
                    style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;"
                    value="{{ old('country', $user->profile?->country) }}">
                @error('country')
                    <div style="color: #dc3545; font-size: 0.85rem; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="grid-column: span 2; padding: 14px; border: 1px solid #eee; border-radius: 8px;">
                <div style="font-weight: 700; margin-bottom: 10px;">Set New Password (Optional)</div>
                <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    <div>
                        <label for="password" style="display: block; margin-bottom: 8px; font-weight: 500;">Password</label>
                        <input type="password" name="password" id="password"
                            style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
                        @error('password')
                            <div style="color: #dc3545; font-size: 0.85rem; margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="password_confirmation" style="display: block; margin-bottom: 8px; font-weight: 500;">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
                    </div>
                </div>
            </div>

            <div style="grid-column: span 2; display:flex; gap: 10px; flex-wrap: wrap;">
                <button type="submit" style="background: var(--primary-color); color: #fff; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; font-size: 1rem;">
                    Update
                </button>
                <a href="{{ route('admin.users.show', $user) }}" style="background: #f8f9fa; color: #333; border: 1px solid #ddd; padding: 10px 20px; border-radius: 4px; text-decoration: none; display: inline-block;">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<style>
    @media (max-width: 768px) {
        form[style*="grid-template-columns: 1fr 1fr"] {
            grid-template-columns: 1fr !important;
        }
        div[style*="grid-column: span 2"] {
            grid-column: auto !important;
        }
        div[style*="grid-template-columns: 1fr 1fr"] {
            grid-template-columns: 1fr !important;
        }
    }
</style>
@endsection

