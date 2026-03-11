@extends('admin.layout')

@section('title', 'Users Management')
@section('header', 'Users Management')

@section('content')
<div class="card" style="background: #fff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); overflow: hidden;">
    <div style="padding: 20px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center;">
        <h3 style="margin: 0;">All Users</h3>
        <span style="font-size: 0.9rem; color: #666;">Total: {{ $users->total() }}</span>
    </div>
    
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f8f9fa; text-align: left;">
                    <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">ID</th>
                    <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">Name</th>
                    <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">Email</th>
                    <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">Phone</th>
                    <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">Verified</th>
                    <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">Orders</th>
                    <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">Status</th>
                    <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr style="border-bottom: 1px solid #dee2e6;">
                    <td style="padding: 12px 20px;">#{{ $user->id }}</td>
                    <td style="padding: 12px 20px;">
                        <div style="font-weight: 500;">{{ $user->name }}</div>
                        <div style="font-size: 0.85rem; color: #888;">Joined {{ $user->created_at->diffForHumans() }}</div>
                    </td>
                    <td style="padding: 12px 20px;">{{ $user->email }}</td>
                    <td style="padding: 12px 20px;">{{ $user->phone ?? 'N/A' }}</td>
                    <td style="padding: 12px 20px;">
                        @if($user->email_verified_at)
                            <span style="background: #d4edda; color: #155724; padding: 4px 8px; border-radius: 4px; font-size: 0.85rem;">Verified</span>
                        @else
                            <span style="background: #fff3cd; color: #856404; padding: 4px 8px; border-radius: 4px; font-size: 0.85rem;">Pending</span>
                        @endif
                    </td>
                    <td style="padding: 12px 20px;">{{ $user->orders_count }}</td>
                    <td style="padding: 12px 20px;">
                        {{-- Fake/Suspicious Detection Logic --}}
                        @if($user->orders_count == 0 && $user->created_at->diffInDays(now()) > 30)
                            <span style="color: #dc3545; font-weight: bold; font-size: 0.85rem;">Inactive</span>
                        @elseif(!$user->email_verified_at && $user->orders_count == 0)
                            <span style="color: #ffc107; font-weight: bold; font-size: 0.85rem;">Unverified</span>
                        @else
                            <span style="color: #28a745; font-weight: bold; font-size: 0.85rem;">Active</span>
                        @endif
                    </td>
                    <td style="padding: 12px 20px;">
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you sure?');" style="display: inline;">
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
        {{ $users->links() }}
    </div>
</div>
@endsection
