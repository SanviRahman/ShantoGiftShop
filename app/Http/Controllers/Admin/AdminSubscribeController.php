<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscribe;
use Illuminate\Http\Request;

class AdminSubscribeController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));

        $subscribes = Subscribe::query()
            ->when($q !== '', function ($query) use ($q) {
                $query->where('email', 'like', '%'.$q.'%');
            })
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.subscribes.index', compact('subscribes', 'q'));
    }

    public function edit(Subscribe $subscribe)
    {
        return view('admin.subscribes.edit', compact('subscribe'));
    }

    public function update(Request $request, Subscribe $subscribe)
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'max:255', 'unique:subscribes,email,'.$subscribe->id],
        ]);

        $subscribe->update([
            'email' => $data['email'],
        ]);

        return redirect()
            ->route('admin.subscribes.index')
            ->with('success', 'Subscriber updated successfully.');
    }

    public function destroy(Subscribe $subscribe)
    {
        $subscribe->delete();

        return back()->with('success', 'Subscriber deleted successfully.');
    }
}

