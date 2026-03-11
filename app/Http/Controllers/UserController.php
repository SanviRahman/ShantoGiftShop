<?php

namespace App\Http\Controllers;

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
}
