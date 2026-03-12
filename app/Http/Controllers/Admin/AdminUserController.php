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
        $user->load(['orders', 'profile']);
        return view('admin.users.show', compact('user'));
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
