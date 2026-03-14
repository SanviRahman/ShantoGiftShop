@extends('admin.layout')

@section('title', 'Contacts')
@section('header', 'Contacts')

@section('content')
<div class="card admin-card"
    style="background: #fff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); overflow: hidden;">
    <div class="admin-card-head"
        style="padding: 20px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center; gap: 10px; flex-wrap: wrap;">
        <h3 style="margin: 0;">All Contacts</h3>
        <form method="GET" action="{{ route('admin.contacts.index') }}"
            style="display:flex; gap: 8px; align-items:center; flex-wrap: wrap; margin-left: auto;">
            <input type="text" name="q" value="{{ $q ?? '' }}" placeholder="Search..."
                style="padding: 8px 12px; border: 1px solid #ddd; border-radius: 6px; min-width: 220px;">
            <select name="status" style="padding: 8px 12px; border: 1px solid #ddd; border-radius: 6px;">
                <option value="">All Status</option>
                <option value="new" {{ ($status ?? '') === 'new' ? 'selected' : '' }}>New</option>
                <option value="read" {{ ($status ?? '') === 'read' ? 'selected' : '' }}>Read</option>
                <option value="replied" {{ ($status ?? '') === 'replied' ? 'selected' : '' }}>Replied</option>
                <option value="closed" {{ ($status ?? '') === 'closed' ? 'selected' : '' }}>Closed</option>
            </select>
            <button type="submit"
                style="background: #1aa6d9; color:#fff; border: 1px solid #1aa6d9; padding: 8px 12px; border-radius: 6px; cursor:pointer;">
                <i class="fas fa-search"></i>
            </button>
            @if(!empty($q) || !empty($status))
            <a href="{{ route('admin.contacts.index') }}"
                style="background: #f8f9fa; color:#333; border: 1px solid #ddd; padding: 8px 12px; border-radius: 6px; text-decoration:none;">
                Clear
            </a>
            @endif
        </form>
        <span style="font-size: 0.9rem; color: #666;">Total: {{ $contacts->total() }}</span>
    </div>

    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f8f9fa; text-align: left;">
                    <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">ID</th>
                    <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">Name</th>
                    <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">Email</th>
                    <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">Subject</th>
                    <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">Status</th>
                    <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">Date</th>
                    <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contacts as $c)
                <tr style="border-bottom: 1px solid #dee2e6;">
                    <td style="padding: 12px 20px;">#{{ $c->id }}</td>
                    <td style="padding: 12px 20px; font-weight: 600; color: #333;">{{ $c->name }}</td>
                    <td style="padding: 12px 20px; color:#666;">{{ $c->email }}</td>
                    <td style="padding: 12px 20px; color:#333;">
                        <div style="max-width: 320px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            {{ $c->subject }}
                        </div>
                    </td>
                    <td style="padding: 12px 20px;">
                        @php
                        $badge = match($c->status) {
                        'new' => ['#0d6efd', '#e7f1ff'],
                        'read' => ['#6c757d', '#f1f3f5'],
                        'replied' => ['#198754', '#eaf7ef'],
                        'closed' => ['#dc3545', '#fdecee'],
                        default => ['#6c757d', '#f1f3f5'],
                        };
                        @endphp
                        <span
                            style="display:inline-block; padding: 5px 10px; border-radius: 999px; font-size: 0.8rem; font-weight: 700; color: {{ $badge[0] }}; background: {{ $badge[1] }};">
                            {{ ucfirst($c->status) }}
                        </span>
                    </td>
                    <td style="padding: 12px 20px; color:#666;">{{ $c->created_at?->format('M d, Y') }}</td>
                    <td style="padding: 12px 20px;">
                        <a href="{{ route('admin.contacts.show', $c) }}"
                            style="color: #1aa6d9; margin-right: 10px; font-size: 1.1rem;">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.contacts.edit', $c) }}"
                            style="color: #ffc107; margin-right: 10px; font-size: 1.1rem;">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.contacts.destroy', $c) }}" method="POST"
                            onsubmit="return confirm('Delete this contact?');" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                style="background: none; border: none; color: #dc3545; cursor: pointer; font-size: 1.1rem;">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="padding: 20px; text-align:center; color:#888;">No contacts found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="padding: 20px;">
        {{ $contacts->links() }}
    </div>
</div>

<style>
@media (max-width: 768px) {
    .admin-card>div[style*="padding: 20px"] {
        padding: 14px !important;
    }

    .admin-card-head form {
        width: 100%;
        margin-left: 0 !important;
    }

    .admin-card-head form input,
    .admin-card-head form select {
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