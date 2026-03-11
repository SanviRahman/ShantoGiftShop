<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    // User account page
    public function account()
    {
        return view('user.account');
    }

    public function wishlist()
    {
        return view('user.wishlist');
    }

    public function signup()
    {
        return view('user.signup');
    }

    public function login()
    {
        return view('user.login');
    }

    public function subscribe(Request $request)
    {
         $data = $request->validate([
            'email' => ['required', 'email', 'unique:subscribes,email'],
        ]);

        return redirect()->back()->with('success', 'Subscribed successfully.');
    }
   
}
