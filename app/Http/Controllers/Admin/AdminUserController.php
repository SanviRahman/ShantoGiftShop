<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::withCount('orders')
            ->where('usertype', '!=', 'admin')
            ->latest()
            ->paginate(20);

        return view('admin.users.index', compact('users'));
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
