<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalUsers = User::where('usertype', 'user')->count();
        $totalRevenue = Order::where('payment_status', 'paid')->sum('total');

        $start = Carbon::now()->subDays(13)->startOfDay();
        $end = Carbon::now()->endOfDay();

        $ordersByDate = Order::whereBetween('created_at', [$start, $end])
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count', 'date')
            ->all();

        $revenueByDate = Order::where('payment_status', 'paid')
            ->whereBetween('created_at', [$start, $end])
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total) as revenue'))
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('revenue', 'date')
            ->all();

        $chartLabels = [];
        $chartOrderCounts = [];
        $chartRevenue = [];

        for ($d = $start->copy(); $d->lte($end); $d->addDay()) {
            $key = $d->toDateString();
            $chartLabels[] = $d->format('M d');
            $chartOrderCounts[] = (int) ($ordersByDate[$key] ?? 0);
            $chartRevenue[] = (float) ($revenueByDate[$key] ?? 0);
        }

        $paymentMethodData = Order::whereBetween('created_at', [Carbon::now()->subDays(30)->startOfDay(), Carbon::now()->endOfDay()])
            ->select('payment_method', DB::raw('COUNT(*) as count'))
            ->groupBy('payment_method')
            ->orderByDesc('count')
            ->pluck('count', 'payment_method')
            ->all();

        $statusData = Order::select('order_status', DB::raw('COUNT(*) as count'))
            ->groupBy('order_status')
            ->orderByDesc('count')
            ->pluck('count', 'order_status')
            ->all();

        $recentOrders = Order::latest()->take(8)->get([
            'id',
            'order_number',
            'customer_name',
            'total',
            'payment_status',
            'order_status',
            'created_at',
        ]);

        return view('admin.index', compact(
            'totalOrders',
            'totalProducts',
            'totalUsers',
            'totalRevenue',
            'chartLabels',
            'chartOrderCounts',
            'chartRevenue',
            'paymentMethodData',
            'statusData',
            'recentOrders',
        ));
    }
}
