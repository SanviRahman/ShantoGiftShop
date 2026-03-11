<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalUsers = User::where('usertype', 'user')->count();
        $totalRevenue = Order::where('payment_status', 'paid')->sum('total');

        return view('admin.index', compact('totalOrders', 'totalProducts', 'totalUsers', 'totalRevenue'));
    }
}
