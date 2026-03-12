@extends('admin.layout')

@section('title', 'Edit Subscriber')
@section('header', 'Edit Subscriber')

@section('content')
<div class="card admin-card" style="background: #fff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); max-width: 600px; margin: 0 auto;">
    <div style="padding: 20px; border-bottom: 1px solid #eee;">
        <h3 style="margin: 0;">Edit Subscriber</h3>
        <div style="margin-top: 6px; color:#666; font-size: 0.9rem;">ID: #{{ $subscribe->id }}</div>
    </div>

    <div style="padding: 20px;">
        <form action="{{ route('admin.subscribes.update', $subscribe) }}" method="POST" style="display:flex; flex-direction:column; gap: 14px;">
            @csrf
            @method('PUT')

            <div>
                <label for="email" style="display: block; margin-bottom: 8px; font-weight: 500;">Email</label>
                <input type="email" name="email" id="email" required
                    style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;"
                    value="{{ old('email', $subscribe->email) }}">
                @error('email')
                    <div style="color: #dc3545; font-size: 0.85rem; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="display:flex; gap: 10px;">
                <button type="submit"
                    style="background: var(--primary-color); color: #fff; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; font-size: 1rem;">
                    Update
                </button>
                <a href="{{ route('admin.subscribes.index') }}"
                    style="background: #f8f9fa; color: #333; border: 1px solid #ddd; padding: 10px 20px; border-radius: 4px; text-decoration: none; display: inline-block;">
                    Back
                </a>
            </div>
        </form>
    </div>
</div>

<style>
    @media (max-width: 768px) {
        .admin-card > div[style*="padding: 20px"] {
            padding: 14px !important;
        }

        .admin-card form > div[style*="display:flex"] {
            flex-direction: column;
        }

        .admin-card form a,
        .admin-card form button {
            width: 100%;
            text-align: center;
        }
    }
</style>
@endsection

