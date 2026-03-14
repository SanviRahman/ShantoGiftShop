@extends('admin.layout')

@section('title', 'User Details')
@section('header', 'User Details')

@section('content')
<div style="display:grid; grid-template-columns: 1fr 360px; gap: 20px;">
    <div style="background: #fff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); overflow: hidden;">
        <div style="padding: 20px; border-bottom: 1px solid #eee; display:flex; justify-content: space-between; align-items:center; gap: 12px; flex-wrap: wrap;">
            <div>
                <h3 style="margin: 0;">{{ $user->name }}</h3>
                <div style="color:#666; font-size:0.9rem; margin-top: 4px;">
                    Joined {{ $user->created_at?->format('M d, Y h:i A') }}
                </div>
            </div>
            <div style="display:flex; gap: 10px; flex-wrap: wrap; justify-content:flex-end;">
                <a href="{{ route('admin.users.edit', $user) }}" style="background: #ffc107; color: #111; border: 1px solid #ffc107; padding: 8px 12px; border-radius: 6px; text-decoration: none;">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Delete this user?');" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background: #dc3545; color: #fff; border: 1px solid #dc3545; padding: 8px 12px; border-radius: 6px; cursor: pointer;">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </form>
            </div>
        </div>

        <div style="padding: 20px;">
            <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                <div style="padding: 14px; border: 1px solid #eee; border-radius: 8px;">
                    <div style="font-size: 0.85rem; color:#666; margin-bottom: 6px;">Email</div>
                    <div style="font-weight: 700;">{{ $user->email }}</div>
                </div>
                <div style="padding: 14px; border: 1px solid #eee; border-radius: 8px;">
                    <div style="font-size: 0.85rem; color:#666; margin-bottom: 6px;">Phone</div>
                    <div style="font-weight: 700;">{{ $user->phone ?: '—' }}</div>
                </div>
                <div style="padding: 14px; border: 1px solid #eee; border-radius: 8px;">
                    <div style="font-size: 0.85rem; color:#666; margin-bottom: 6px;">Email Verified</div>
                    <div style="font-weight: 700;">
                        {{ $user->email_verified_at ? 'Verified' : 'Pending' }}
                    </div>
                </div>
                <div style="padding: 14px; border: 1px solid #eee; border-radius: 8px;">
                    <div style="font-size: 0.85rem; color:#666; margin-bottom: 6px;">Orders</div>
                    <div style="font-weight: 700;">{{ $user->orders->count() }}</div>
                </div>
            </div>

            <div style="margin-top: 16px; padding: 14px; border: 1px solid #eee; border-radius: 8px;">
                <div style="font-size: 0.85rem; color:#666; margin-bottom: 10px;">Address</div>
                <div style="line-height: 1.6;">
                    <div>{{ $user->profile?->address ?: '—' }}</div>
                    <div style="color:#666; font-size: 0.9rem;">
                        {{ $user->profile?->city ?: '' }} {{ $user->profile?->postal_code ?: '' }} {{ $user->profile?->country ?: '' }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="background: #fff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); overflow: hidden;">
        <div style="padding: 20px; border-bottom: 1px solid #eee;">
            <h3 style="margin: 0;">Recent Orders</h3>
        </div>
        <div style="padding: 20px; display:flex; flex-direction: column; gap: 12px;">
            @forelse($user->orders->take(6) as $o)
                <div style="border: 1px solid #eee; border-radius: 8px; padding: 12px;">
                    <div style="display:flex; justify-content: space-between; gap: 10px;">
                        <div style="font-weight: 700;">{{ $o->order_number }}</div>
                        <div style="color:#666;">${{ number_format((float) $o->total, 0) }}</div>
                    </div>
                    <div style="margin-top: 6px; color:#666; font-size: 0.9rem;">
                        {{ $o->created_at?->format('M d, Y') }}
                    </div>
                </div>
            @empty
                <div style="color:#888;">No orders found.</div>
            @endforelse
        </div>
    </div>
</div>

<style>
    @media (max-width: 992px) {
        div[style*="grid-template-columns: 1fr 360px"] {
            grid-template-columns: 1fr !important;
        }
    }
    @media (max-width: 768px) {
        div[style*="grid-template-columns: 1fr 1fr"] {
            grid-template-columns: 1fr !important;
        }
    }
</style>
@endsection

