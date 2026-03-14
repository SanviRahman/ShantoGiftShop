@extends('admin.layout')

@section('title', 'Contact Details')
@section('header', 'Contact Details')

@section('content')
<div style="display:grid; grid-template-columns: 1fr 360px; gap: 20px;">
    <div style="background: #fff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); overflow: hidden;">
        <div style="padding: 20px; border-bottom: 1px solid #eee; display:flex; justify-content: space-between; align-items:center; gap: 12px; flex-wrap: wrap;">
            <div>
                <h3 style="margin: 0;">#{{ $contact->id }} - {{ $contact->subject ?: 'No Subject' }}</h3>
                <div style="color:#666; font-size:0.9rem; margin-top: 4px;">
                    {{ $contact->created_at?->format('M d, Y h:i A') }}
                </div>
            </div>
            <div style="display:flex; gap: 10px; flex-wrap: wrap; justify-content:flex-end;">
                <a href="{{ route('admin.contacts.edit', $contact) }}" style="background: #ffc107; color: #111; border: 1px solid #ffc107; padding: 8px 12px; border-radius: 6px; text-decoration: none;">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" onsubmit="return confirm('Delete this contact?');" style="display:inline;">
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
                    <div style="font-size: 0.85rem; color:#666; margin-bottom: 6px;">Name</div>
                    <div style="font-weight: 700;">{{ $contact->name }}</div>
                </div>
                <div style="padding: 14px; border: 1px solid #eee; border-radius: 8px;">
                    <div style="font-size: 0.85rem; color:#666; margin-bottom: 6px;">Email</div>
                    <div style="font-weight: 700;">{{ $contact->email }}</div>
                </div>
                <div style="padding: 14px; border: 1px solid #eee; border-radius: 8px;">
                    <div style="font-size: 0.85rem; color:#666; margin-bottom: 6px;">Phone</div>
                    <div style="font-weight: 700;">{{ $contact->phone ?: '—' }}</div>
                </div>
                <div style="padding: 14px; border: 1px solid #eee; border-radius: 8px;">
                    <div style="font-size: 0.85rem; color:#666; margin-bottom: 6px;">Status</div>
                    <div style="font-weight: 700;">{{ ucfirst($contact->status) }}</div>
                </div>
            </div>

            <div style="margin-top: 16px; padding: 14px; border: 1px solid #eee; border-radius: 8px;">
                <div style="font-size: 0.85rem; color:#666; margin-bottom: 10px;">Message</div>
                <div style="white-space: pre-wrap; line-height: 1.6;">{{ $contact->message }}</div>
            </div>
        </div>
    </div>

    <div style="background: #fff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); overflow: hidden;">
        <div style="padding: 20px; border-bottom: 1px solid #eee;">
            <h3 style="margin: 0;">Quick Actions</h3>
        </div>
        <div style="padding: 20px; display:flex; flex-direction: column; gap: 10px;">
            <a href="{{ route('admin.contacts.index', ['status' => 'new']) }}" style="background: #e7f1ff; color:#0d6efd; border: 1px solid #d6e8ff; padding: 10px 12px; border-radius: 8px; text-decoration:none; font-weight: 700;">
                View New
            </a>
            <a href="{{ route('admin.contacts.index', ['status' => 'read']) }}" style="background: #f1f3f5; color:#6c757d; border: 1px solid #e9ecef; padding: 10px 12px; border-radius: 8px; text-decoration:none; font-weight: 700;">
                View Read
            </a>
            <a href="{{ route('admin.contacts.index', ['status' => 'replied']) }}" style="background: #eaf7ef; color:#198754; border: 1px solid #d7f0e2; padding: 10px 12px; border-radius: 8px; text-decoration:none; font-weight: 700;">
                View Replied
            </a>
            <a href="{{ route('admin.contacts.index', ['status' => 'closed']) }}" style="background: #fdecee; color:#dc3545; border: 1px solid #f8d7da; padding: 10px 12px; border-radius: 8px; text-decoration:none; font-weight: 700;">
                View Closed
            </a>
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

