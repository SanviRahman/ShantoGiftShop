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
        $q = trim((string) request()->query('q', ''));

        $products = Product::with('category')
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($q1) use ($q) {
                    $q1->where('title', 'like', '%' . $q . '%')
                        ->orWhere('sku', 'like', '%' . $q . '%')
                        ->orWhere('slug', 'like', '%' . $q . '%')
                        ->orWhereHas('category', function ($q2) use ($q) {
                            $q2->where('name', 'like', '%' . $q . '%')
                                ->orWhere('slug', 'like', '%' . $q . '%');
                        });
                });
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.products.index', compact('products', 'q'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'             => 'required|string|max:255',
            'category_id'       => 'required|exists:categories,id',
            'price'             => 'required|numeric|min:0',
            'old_price'         => 'nullable|numeric|min:0',
            'discount_percent'  => 'nullable|integer|min:0|max:100',
            'rating'            => 'nullable|numeric|min:0|max:5',
            'review_count'      => 'nullable|integer|min:0',
            'stock_qty'         => 'required|integer|min:0',
            'sku'               => 'nullable|string|unique:products,sku',
            'short_description' => 'nullable|string',
            'featured_image'    => 'nullable|image|max:2048',
            'gallery_images'    => 'nullable|array|max:4',
            'gallery_images.*'  => 'image|max:2048',
            'sizes'             => 'nullable|string|max:100',
            'is_active'         => 'boolean',
            'is_featured'       => 'boolean',
        ]);

        $data                     = $request->except('featured_image', 'gallery_images', 'sizes');
        $data['slug']             = Str::slug($request->title) . '-' . Str::random(6);
        $data['is_active']        = $request->boolean('is_active', true);
        $data['is_featured']      = $request->boolean('is_featured');
        $data['is_flash_sale']    = $request->boolean('is_flash_sale');
        $data['is_best_seller']   = $request->boolean('is_best_seller');
        $data['discount_percent'] = $request->filled('discount_percent')
            ? (int) $request->discount_percent
            : null;

        if ($request->hasFile('featured_image')) {
            $path                   = $request->file('featured_image')->store('products', 'public');
            $data['featured_image'] = $path;
        }

        $product = Product::create($data);

        $category         = Category::with('parent')->find($product->category_id);
        $isClothsCategory =
        in_array((string) $category?->slug, ['cloths', 'mens-fashion', 'womens-fashion'], true) ||
        in_array((string) $category?->parent?->slug, ['cloths', 'mens-fashion', 'womens-fashion'], true);

        $sizesInput = trim((string) $request->input('sizes', ''));
        $sizes      = [];
        if ($sizesInput !== '') {
            $sizes = preg_split('/[,|]+/', strtoupper($sizesInput)) ?: [];
            $sizes = array_values(array_unique(array_filter(array_map('trim', $sizes))));
        } elseif ($isClothsCategory) {
            $sizes = ['XS', 'S', 'M', 'L', 'XL'];
        }

        $gallery = [];
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images', []) as $file) {
                if (! $file) {
                    continue;
                }
                $gPath     = $file->store('products/gallery', 'public');
                $gallery[] = asset('storage/' . $gPath);
            }
        }

        if (! $gallery) {
            $gallery = array_fill(0, 4, $product->image_url);
        }

        $gallery = array_values(array_filter($gallery));
        $gallery = array_slice($gallery, 0, 4);
        if (count($gallery) < 4) {
            $pad = $gallery[0] ?? $product->image_url;
            while (count($gallery) < 4) {
                $gallery[] = $pad;
            }
        }

        $product->detail()->updateOrCreate([], [
            'description'    => $product->short_description ?: ('High quality ' . $product->title . ' for your daily use.'),
            'colors'         => $isClothsCategory ? ['#A0BCE0', '#E07575', '#000000'] : [],
            'sizes'          => $sizes,
            'gallery'        => $gallery,
            'specifications' => [
                'brand'    => 'ShantoGiftShop',
                'origin'   => 'Bangladesh',
                'warranty' => '6 Months',
            ],
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $product->load('detail');
        $categories = Category::where('is_active', true)->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title'             => 'required|string|max:255',
            'category_id'       => 'required|exists:categories,id',
            'price'             => 'required|numeric|min:0',
            'old_price'         => 'nullable|numeric|min:0',
            'discount_percent'  => 'nullable|integer|min:0|max:100',
            'rating'            => 'nullable|numeric|min:0|max:5',
            'review_count'      => 'nullable|integer|min:0',
            'stock_qty'         => 'required|integer|min:0',
            'sku'               => 'nullable|string|unique:products,sku,' . $product->id,
            'short_description' => 'nullable|string',
            'featured_image'    => 'nullable|image|max:2048',
            'gallery_images'    => 'nullable|array|max:4',
            'gallery_images.*'  => 'image|max:2048',
            'sizes'             => 'nullable|string|max:100',
            'is_active'         => 'boolean',
            'is_featured'       => 'boolean',
        ]);

        $data = $request->except('featured_image', 'gallery_images', 'sizes');

        $data['is_active']        = $request->boolean('is_active');
        $data['is_featured']      = $request->boolean('is_featured');
        $data['is_flash_sale']    = $request->boolean('is_flash_sale');
        $data['is_best_seller']   = $request->boolean('is_best_seller');
        $data['discount_percent'] = $request->filled('discount_percent')
            ? (int) $request->discount_percent
            : null;

        if ($request->hasFile('featured_image')) {
            // Delete old image
            if ($product->featured_image && Storage::disk('public')->exists($product->featured_image)) {
                Storage::disk('public')->delete($product->featured_image);
            }

            $path                   = $request->file('featured_image')->store('products', 'public');
            $data['featured_image'] = $path;
        }

        $product->update($data);

        $category         = Category::with('parent')->find($product->category_id);
        $isClothsCategory =
        in_array((string) $category?->slug, ['cloths', 'mens-fashion', 'womens-fashion'], true) ||
        in_array((string) $category?->parent?->slug, ['cloths', 'mens-fashion', 'womens-fashion'], true);

        $sizesInput = trim((string) $request->input('sizes', ''));
        $sizes      = null;
        if ($sizesInput !== '') {
            $parsed = preg_split('/[,|]+/', strtoupper($sizesInput)) ?: [];
            $parsed = array_values(array_unique(array_filter(array_map('trim', $parsed))));
            $sizes  = $parsed;
        }

        $gallery = null;
        if ($request->hasFile('gallery_images')) {
            $gallery = [];
            foreach ($request->file('gallery_images', []) as $file) {
                if (! $file) {
                    continue;
                }
                $gPath     = $file->store('products/gallery', 'public');
                $gallery[] = asset('storage/' . $gPath);
            }
        }

        $existingGallery = (array) data_get($product->detail, 'gallery', []);
        if ($gallery === null) {
            $gallery = $existingGallery ?: array_fill(0, 4, $product->image_url);
        }

        $gallery = array_values(array_filter($gallery));
        $gallery = array_slice($gallery, 0, 4);
        if (count($gallery) < 4) {
            $pad = $gallery[0] ?? $product->image_url;
            while (count($gallery) < 4) {
                $gallery[] = $pad;
            }
        }

        $detailPayload = [
            'description'    => $product->short_description ?: ('High quality ' . $product->title . ' for your daily use.'),
            'colors'         => $isClothsCategory ? ['#A0BCE0', '#E07575', '#000000'] : [],
            'gallery'        => $gallery,
            'specifications' => [
                'brand'    => 'ShantoGiftShop',
                'origin'   => 'Bangladesh',
                'warranty' => '6 Months',
            ],
        ];

        if ($sizes !== null) {
            $detailPayload['sizes'] = $sizes;
        } elseif ($isClothsCategory && empty((array) data_get($product->detail, 'sizes', []))) {
            $detailPayload['sizes'] = ['XS', 'S', 'M', 'L', 'XL'];
        }

        $product->detail()->updateOrCreate([], $detailPayload);

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
