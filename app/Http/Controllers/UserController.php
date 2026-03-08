<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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

}
