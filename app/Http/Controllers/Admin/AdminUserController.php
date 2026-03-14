<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));

        $users = User::withCount('orders')
            ->where('usertype', '!=', 'admin')
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($q1) use ($q) {
                    $q1->where('name', 'like', '%'.$q.'%')
                        ->orWhere('email', 'like', '%'.$q.'%')
                        ->orWhere('phone', 'like', '%'.$q.'%');
                });
            })
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.users.index', compact('users', 'q'));
    }

    public function show(User $user)
    {
        if ($user->usertype === 'admin') {
            return back()->with('error', 'Cannot view admin user.');
        }

        $user->load(['orders', 'profile']);
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        if ($user->usertype === 'admin') {
            return back()->with('error', 'Cannot edit admin user.');
        }

        $user->load('profile');

        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if ($user->usertype === 'admin') {
            return back()->with('error', 'Cannot update admin user.');
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,'.$user->id],
            'phone' => ['nullable', 'string', 'max:30', 'unique:users,phone,'.$user->id],
            'email_verified' => ['nullable'],
            'password' => ['nullable', 'confirmed', 'min:6'],
            'first_name' => ['nullable', 'string', 'max:100'],
            'last_name' => ['nullable', 'string', 'max:100'],
            'address' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:100'],
            'postal_code' => ['nullable', 'string', 'max:50'],
            'country' => ['nullable', 'string', 'max:100'],
        ]);

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'email_verified_at' => $request->boolean('email_verified') ? ($user->email_verified_at ?? now()) : null,
        ]);

        if (! empty($data['password'])) {
            $user->update([
                'password' => $data['password'],
            ]);
        }

        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'first_name' => $data['first_name'] ?? null,
                'last_name' => $data['last_name'] ?? null,
                'phone' => $data['phone'] ?? null,
                'address' => $data['address'] ?? null,
                'city' => $data['city'] ?? null,
                'postal_code' => $data['postal_code'] ?? null,
                'country' => $data['country'] ?? null,
            ]
        );

        return redirect()
            ->route('admin.users.show', $user)
            ->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        if ($user->usertype === 'admin') {
            return back()->with('error', 'Cannot delete admin user.');
        }

        $user->delete();

        return back()->with('success', 'User deleted successfully.');
    }
}
