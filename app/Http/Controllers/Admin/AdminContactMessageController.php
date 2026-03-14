<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class AdminContactMessageController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));
        $status = trim((string) $request->query('status', ''));

        $contacts = ContactMessage::query()
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($q1) use ($q) {
                    $q1->where('name', 'like', '%'.$q.'%')
                        ->orWhere('email', 'like', '%'.$q.'%')
                        ->orWhere('phone', 'like', '%'.$q.'%')
                        ->orWhere('subject', 'like', '%'.$q.'%')
                        ->orWhere('message', 'like', '%'.$q.'%');
                });
            })
            ->when($status !== '', function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.contacts.index', compact('contacts', 'q', 'status'));
    }

    public function show(ContactMessage $contact)
    {
        if ($contact->status === 'new') {
            $contact->update(['status' => 'read']);
        }

        return view('admin.contacts.show', compact('contact'));
    }

    public function edit(ContactMessage $contact)
    {
        return view('admin.contacts.edit', compact('contact'));
    }

    public function update(Request $request, ContactMessage $contact)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:120'],
            'phone' => ['nullable', 'string', 'max:30'],
            'subject' => ['nullable', 'string', 'max:120'],
            'message' => ['required', 'string', 'max:2000'],
            'status' => ['required', 'in:new,read,replied,closed'],
        ]);

        $contact->update($data);

        return redirect()
            ->route('admin.contacts.show', $contact)
            ->with('success', 'Contact updated successfully.');
    }

    public function destroy(ContactMessage $contact)
    {
        $contact->delete();

        return back()->with('success', 'Contact deleted successfully.');
    }
}

