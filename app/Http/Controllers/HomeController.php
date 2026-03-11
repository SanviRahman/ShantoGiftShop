<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function home()
    {
        $sidebarCategories = Category::with('children')
            ->whereNull('parent_id')
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        $homeCategories = Category::where('is_active', true)
            ->whereDoesntHave('children')
            ->orderBy('name')
            ->take(6)
            ->get();

        $flashSales = Product::with(['category', 'detail'])
            ->where('is_active', true)
            ->where('is_flash_sale', true)
            ->latest()
            ->take(8)
            ->get();

        $bestSellers = Product::with(['category', 'detail'])
            ->where('is_active', true)
            ->where('is_best_seller', true)
            ->latest()
            ->take(4)
            ->get();

        $exploreProducts = Product::with(['category', 'detail'])
            ->where('is_active', true)
            ->latest()
            ->take(8)
            ->get();

        $featuredProducts = Product::with(['category', 'detail'])
            ->where('is_active', true)
            ->where('is_featured', true)
            ->latest()
            ->take(3)
            ->get();

        return view('index', compact(
            'sidebarCategories',
            'homeCategories',
            'flashSales',
            'bestSellers',
            'exploreProducts',
            'featuredProducts'
        ));
    }

    public function about()
    {
        return view('about');
    }
}