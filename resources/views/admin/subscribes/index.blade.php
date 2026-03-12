@extends('admin.layout')

@section('title', 'Subscribers')
@section('header', 'Subscribers')

@section('content')
<div class="card admin-card" style="background: #fff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); overflow: hidden;">
    <div class="admin-card-head" style="padding: 20px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center; gap: 10px; flex-wrap: wrap;">
        <h3 style="margin: 0;">All Subscribers</h3>
        <form method="GET" action="{{ route('admin.subscribes.index') }}" style="display:flex; gap: 8px; align-items:center; flex-wrap: wrap; margin-left: auto;">
            <input type="text" name="q" value="{{ $q ?? '' }}" placeholder="Search email..."
                style="padding: 8px 12px; border: 1px solid #ddd; border-radius: 6px; min-width: 220px;">
            <button type="submit" style="background: #1aa6d9; color:#fff; border: 1px solid #1aa6d9; padding: 8px 12px; border-radius: 6px; cursor:pointer;">
                <i class="fas fa-search"></i>
            </button>
            @if(!empty($q))
                <a href="{{ route('admin.subscribes.index') }}" style="background: #f8f9fa; color:#333; border: 1px solid #ddd; padding: 8px 12px; border-radius: 6px; text-decoration:none;">
                    Clear
                </a>
            @endif
        </form>
        <span style="font-size: 0.9rem; color: #666;">Total: {{ $subscribes->total() }}</span>
    </div>

    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f8f9fa; text-align: left;">
                    <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">ID</th>
                    <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">Email</th>
                    <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">Subscribed</th>
                    <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($subscribes as $s)
                    <tr style="border-bottom: 1px solid #dee2e6;">
                        <td style="padding: 12px 20px;">#{{ $s->id }}</td>
                        <td style="padding: 12px 20px; font-weight: 600; color: #333;">{{ $s->email }}</td>
                        <td style="padding: 12px 20px; color:#666;">{{ $s->created_at?->diffForHumans() }}</td>
                        <td style="padding: 12px 20px;">
                            <a href="{{ route('admin.subscribes.edit', $s) }}" style="color: #ffc107; margin-right: 10px; font-size: 1.1rem;">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.subscribes.destroy', $s) }}" method="POST" onsubmit="return confirm('Delete this subscriber?');" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background: none; border: none; color: #dc3545; cursor: pointer; font-size: 1.1rem;">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="padding: 20px; text-align:center; color:#888;">No subscribers found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="padding: 20px;">
        {{ $subscribes->links() }}
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

