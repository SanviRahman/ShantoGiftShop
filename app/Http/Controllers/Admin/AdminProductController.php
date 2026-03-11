<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
            ->latest()
            ->paginate(15);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'old_price' => 'nullable|numeric|min:0',
            'stock_qty' => 'required|integer|min:0',
            'sku' => 'nullable|string|unique:products,sku',
            'short_description' => 'nullable|string',
            'featured_image' => 'nullable|image|max:2048', // 2MB
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        $data = $request->except('featured_image');
        $data['slug'] = Str::slug($request->title) . '-' . Str::random(6);
        $data['is_active'] = $request->boolean('is_active', true);
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_flash_sale'] = $request->boolean('is_flash_sale');
        $data['is_best_seller'] = $request->boolean('is_best_seller');

        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('products', 'public');
            $data['featured_image'] = $path;
        }

        Product::create($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'old_price' => 'nullable|numeric|min:0',
            'stock_qty' => 'required|integer|min:0',
            'sku' => 'nullable|string|unique:products,sku,' . $product->id,
            'short_description' => 'nullable|string',
            'featured_image' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        $data = $request->except('featured_image');
        // Keep existing slug or update? Usually better to keep unless explicitly changed.
        // If title changed significantly, maybe update slug, but for SEO stability, keep it.
        // $data['slug'] = Str::slug($request->title); 
        
        $data['is_active'] = $request->boolean('is_active');
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_flash_sale'] = $request->boolean('is_flash_sale');
        $data['is_best_seller'] = $request->boolean('is_best_seller');

        if ($request->hasFile('featured_image')) {
            // Delete old image
            if ($product->featured_image && Storage::disk('public')->exists($product->featured_image)) {
                Storage::disk('public')->delete($product->featured_image);
            }
            
            $path = $request->file('featured_image')->store('products', 'public');
            $data['featured_image'] = $path;
        }

        $product->update($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        if ($product->featured_image && Storage::disk('public')->exists($product->featured_image)) {
            Storage::disk('public')->delete($product->featured_image);
        }

        $product->delete();

        return back()->with('success', 'Product deleted successfully.');
    }
}
