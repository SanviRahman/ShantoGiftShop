<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlistItems = Wishlist::with('product.detail')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        $recommendedProducts = Product::where('is_active', true)
            ->latest()
            ->take(4)
            ->get();

        return view('user.wishlist', compact('wishlistItems', 'recommendedProducts'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
        ]);

        Wishlist::firstOrCreate([
            'user_id' => auth()->id(),
            'product_id' => $data['product_id'],
        ]);

        return back()->with('success', 'Added to wishlist.');
    }

    public function destroy(Wishlist $wishlist)
    {
        abort_unless($wishlist->user_id === auth()->id(), 403);

        $wishlist->delete();

        return back()->with('success', 'Removed from wishlist.');
    }
}
