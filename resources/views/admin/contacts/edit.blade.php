@extends('admin.layout')

@section('title', 'Edit Contact')
@section('header', 'Edit Contact')

@section('content')
<div class="card admin-card" style="background: #fff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); max-width: 900px; margin: 0 auto;">
    <div style="padding: 20px; border-bottom: 1px solid #eee; display:flex; justify-content: space-between; align-items:center; gap: 12px; flex-wrap: wrap;">
        <div>
            <h3 style="margin: 0;">Edit Contact #{{ $contact->id }}</h3>
            <div style="margin-top: 6px; color:#666; font-size: 0.9rem;">{{ $contact->created_at?->format('M d, Y h:i A') }}</div>
        </div>
        <a href="{{ route('admin.contacts.show', $contact) }}" style="background: #f8f9fa; color: #333; border: 1px solid #ddd; padding: 8px 12px; border-radius: 6px; text-decoration: none;">
            Back
        </a>
    </div>

    <div style="padding: 20px;">
        <form action="{{ route('admin.contacts.update', $contact) }}" method="POST" style="display:grid; grid-template-columns: 1fr 1fr; gap: 16px;">
            @csrf
            @method('PUT')

            <div>
                <label for="name" style="display: block; margin-bottom: 8px; font-weight: 500;">Name</label>
                <input type="text" name="name" id="name" required
                    style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;"
                    value="{{ old('name', $contact->name) }}">
                @error('name')
                    <div style="color: #dc3545; font-size: 0.85rem; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="email" style="display: block; margin-bottom: 8px; font-weight: 500;">Email</label>
                <input type="email" name="email" id="email" required
                    style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;"
                    value="{{ old('email', $contact->email) }}">
                @error('email')
                    <div style="color: #dc3545; font-size: 0.85rem; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="phone" style="display: block; margin-bottom: 8px; font-weight: 500;">Phone</label>
                <input type="text" name="phone" id="phone"
                    style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;"
                    value="{{ old('phone', $contact->phone) }}">
                @error('phone')
                    <div style="color: #dc3545; font-size: 0.85rem; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="status" style="display: block; margin-bottom: 8px; font-weight: 500;">Status</label>
                <select name="status" id="status" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
                    @php $st = old('status', $contact->status); @endphp
                    <option value="new" {{ $st === 'new' ? 'selected' : '' }}>New</option>
                    <option value="read" {{ $st === 'read' ? 'selected' : '' }}>Read</option>
                    <option value="replied" {{ $st === 'replied' ? 'selected' : '' }}>Replied</option>
                    <option value="closed" {{ $st === 'closed' ? 'selected' : '' }}>Closed</option>
                </select>
                @error('status')
                    <div style="color: #dc3545; font-size: 0.85rem; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="grid-column: span 2;">
                <label for="subject" style="display: block; margin-bottom: 8px; font-weight: 500;">Subject</label>
                <input type="text" name="subject" id="subject"
                    style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;"
                    value="{{ old('subject', $contact->subject) }}">
                @error('subject')
                    <div style="color: #dc3545; font-size: 0.85rem; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="grid-column: span 2;">
                <label for="message" style="display: block; margin-bottom: 8px; font-weight: 500;">Message</label>
                <textarea name="message" id="message" rows="7" required
                    style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; resize: vertical;">{{ old('message', $contact->message) }}</textarea>
                @error('message')
                    <div style="color: #dc3545; font-size: 0.85rem; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="grid-column: span 2; display:flex; gap: 10px; flex-wrap: wrap;">
                <button type="submit" style="background: var(--primary-color); color: #fff; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; font-size: 1rem;">
                    Update
                </button>
                <a href="{{ route('admin.contacts.show', $contact) }}" style="background: #f8f9fa; color: #333; border: 1px solid #ddd; padding: 10px 20px; border-radius: 4px; text-decoration: none; display: inline-block;">
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
    }
</style>
@endsection
