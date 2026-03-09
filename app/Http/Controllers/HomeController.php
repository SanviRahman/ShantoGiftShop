<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return view('index');
    }


    public function contact()
    {
        return view('contact');
    }

    public function about()
    {
        return view('about');
    }


    public function products()
    {
        return view('products');
    }

    public function productDetails()
    {
        return view('products-details');
    }
    public function cart()
    {
        return view('cart');
    }

    public function error()
    {
        return view('error');
    }
}
