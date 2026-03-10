<?php


namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

/*
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

*/



class HomeController extends Controller
{
    public function home()
    {
        $sidebarCategories = Category::where('is_active', true)
            ->whereDoesntHave('children')
            ->orderBy('name')
            ->get();

        $homeCategories = Category::where('is_active', true)
            ->whereDoesntHave('children')
            ->take(6)
            ->get();

        $flashSales = Product::where('is_active', true)
            ->where('is_flash_sale', true)
            ->latest()
            ->take(8)
            ->get();

        $bestSellers = Product::where('is_active', true)
            ->where('is_best_seller', true)
            ->latest()
            ->take(4)
            ->get();

        $exploreProducts = Product::where('is_active', true)
            ->latest()
            ->take(8)
            ->get();

        $featuredProducts = Product::where('is_active', true)
            ->where('is_featured', true)
            ->latest()
            ->take(4)
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