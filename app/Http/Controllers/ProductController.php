<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();

        $query = Product::with(['category', 'detail'])
            ->where('is_active', true);

        if ($request->filled('category')) {
            $category = Category::where('slug', $request->category)->first();

            if ($category) {
                $categoryIds = $category->children()->pluck('id')->push($category->id);
                $query->whereIn('category_id', $categoryIds);
            }
        }

        if ($request->filled('min')) {
            $query->where('price', '>=', (float) $request->min);
        }

        if ($request->filled('max')) {
            $query->where('price', '<=', (float) $request->max);
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%'.$request->search.'%');
        }

        switch ($request->sort) {
            case 'price-low':
                $query->orderBy('price');
                break;
            case 'price-high':
                $query->orderByDesc('price');
                break;
            case 'newest':
                $query->latest();
                break;
            default:
                $query->orderByDesc('is_featured')->latest();
                break;
        }

        $products = $query->paginate(9)->withQueryString();

        return view('products', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        $product->load(['category.parent', 'detail']);

        $isClothsCategory =
            in_array($product->category->slug, ['cloths', 'mens-fashion', 'womens-fashion'], true) ||
            in_array((string) optional($product->category->parent)->slug, ['cloths', 'mens-fashion', 'womens-fashion'], true);

        if (! $product->detail) {
            $gallery = array_slice(array_values(array_filter([
                $product->image_url,
                $product->image_url,
                $product->image_url,
                $product->image_url,
            ])), 0, 4);

            $sizes = $isClothsCategory ? ['XS', 'S', 'M', 'L', 'XL'] : [];

            $product->detail()->create([
                'description' => $product->short_description ?: ('High quality '.$product->title.' for your daily use.'),
                'colors' => $isClothsCategory ? ['#A0BCE0', '#E07575', '#000000'] : [],
                'sizes' => $sizes,
                'gallery' => $gallery,
                'specifications' => [
                    'brand' => 'ShantoGiftShop',
                    'origin' => 'Bangladesh',
                    'warranty' => '6 Months',
                ],
            ]);

            $product->load('detail');
        }

        $relatedProducts = Product::where('is_active', true)
            ->where('category_id', $product->category_id)
            ->whereKeyNot($product->id)
            ->take(4)
            ->get();

        return view('product-details', compact('product', 'relatedProducts', 'isClothsCategory'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)
            ->whereDoesntHave('children')
            ->orderBy('name')
            ->get();

        return view('admin.products.form', [
            'product' => new Product,
            'categories' => $categories,
            'isEdit' => false,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'sku' => ['nullable', 'string', 'max:100', 'unique:products,sku'],
            'short_description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'old_price' => ['nullable', 'numeric', 'min:0'],
            'rating' => ['nullable', 'numeric', 'min:0', 'max:5'],
            'review_count' => ['nullable', 'integer', 'min:0'],
            'discount_percent' => ['nullable', 'integer', 'min:0', 'max:100'],
            'stock_qty' => ['required', 'integer', 'min:0'],
            'featured_image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'description' => ['nullable', 'string'],
            'colors' => ['nullable', 'string'],
            'sizes' => ['nullable', 'string'],
        ]);

        $imagePath = $request->file('featured_image')->store('products', 'public');

        $product = Product::create([
            'category_id' => $data['category_id'],
            'title' => $data['title'],
            'slug' => Str::slug($data['title']).'-'.Str::lower(Str::random(5)),
            'sku' => $data['sku'] ?? 'SKU-'.strtoupper(Str::random(8)),
            'short_description' => $data['short_description'] ?? null,
            'price' => $data['price'],
            'old_price' => $data['old_price'] ?? null,
            'rating' => $data['rating'] ?? 0,
            'review_count' => $data['review_count'] ?? 0,
            'discount_percent' => $data['discount_percent'] ?? null,
            'stock_qty' => $data['stock_qty'],
            'is_flash_sale' => $request->boolean('is_flash_sale'),
            'is_best_seller' => $request->boolean('is_best_seller'),
            'is_featured' => $request->boolean('is_featured'),
            'is_active' => $request->boolean('is_active', true),
            'featured_image' => $imagePath,
        ]);

        $colors = ! empty($data['colors'])
            ? array_map('trim', explode(',', $data['colors']))
            : ['#A0BCE0', '#E07575', '#000000'];

        $sizes = ! empty($data['sizes'])
            ? array_map('trim', explode(',', $data['sizes']))
            : [];

        $gallery = [
            asset('storage/'.$imagePath),
            asset('storage/'.$imagePath),
            asset('storage/'.$imagePath),
            asset('storage/'.$imagePath),
        ];

        $product->detail()->create([
            'description' => $data['description'] ?? ($data['title'].' description'),
            'colors' => $colors,
            'sizes' => $sizes,
            'gallery' => $gallery,
            'specifications' => [
                'brand' => 'ShantoGiftShop',
                'origin' => 'Bangladesh',
                'warranty' => '6 Months',
            ],
        ]);

        return redirect()->route('products.show', $product)->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $product->load('detail');

        $categories = Category::where('is_active', true)
            ->whereDoesntHave('children')
            ->orderBy('name')
            ->get();

        return view('admin.products.form', [
            'product' => $product,
            'categories' => $categories,
            'isEdit' => true,
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $product->load('detail');

        $data = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'sku' => ['nullable', 'string', 'max:100', Rule::unique('products', 'sku')->ignore($product->id)],
            'short_description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'old_price' => ['nullable', 'numeric', 'min:0'],
            'rating' => ['nullable', 'numeric', 'min:0', 'max:5'],
            'review_count' => ['nullable', 'integer', 'min:0'],
            'discount_percent' => ['nullable', 'integer', 'min:0', 'max:100'],
            'stock_qty' => ['required', 'integer', 'min:0'],
            'featured_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'description' => ['nullable', 'string'],
            'colors' => ['nullable', 'string'],
            'sizes' => ['nullable', 'string'],
        ]);

        $imagePath = $product->featured_image;

        if ($request->hasFile('featured_image')) {
            if ($product->featured_image && Storage::disk('public')->exists($product->featured_image)) {
                Storage::disk('public')->delete($product->featured_image);
            }

            $imagePath = $request->file('featured_image')->store('products', 'public');
        }

        $product->update([
            'category_id' => $data['category_id'],
            'title' => $data['title'],
            'slug' => $product->slug,
            'sku' => $data['sku'] ?? $product->sku,
            'short_description' => $data['short_description'] ?? null,
            'price' => $data['price'],
            'old_price' => $data['old_price'] ?? null,
            'rating' => $data['rating'] ?? 0,
            'review_count' => $data['review_count'] ?? 0,
            'discount_percent' => $data['discount_percent'] ?? null,
            'stock_qty' => $data['stock_qty'],
            'is_flash_sale' => $request->boolean('is_flash_sale'),
            'is_best_seller' => $request->boolean('is_best_seller'),
            'is_featured' => $request->boolean('is_featured'),
            'is_active' => $request->boolean('is_active', true),
            'featured_image' => $imagePath,
        ]);

        $colors = ! empty($data['colors'])
            ? array_map('trim', explode(',', $data['colors']))
            : ['#A0BCE0', '#E07575', '#000000'];

        $sizes = ! empty($data['sizes'])
            ? array_map('trim', explode(',', $data['sizes']))
            : [];

        $gallery = [
            asset('storage/'.$imagePath),
            asset('storage/'.$imagePath),
            asset('storage/'.$imagePath),
            asset('storage/'.$imagePath),
        ];

        $product->detail()->updateOrCreate(
            ['product_id' => $product->id],
            [
                'description' => $data['description'] ?? ($data['title'].' description'),
                'colors' => $colors,
                'sizes' => $sizes,
                'gallery' => $gallery,
                'specifications' => [
                    'brand' => 'ShantoGiftShop',
                    'origin' => 'Bangladesh',
                    'warranty' => '6 Months',
                ],
            ]
        );

        return redirect()->route('products.show', $product)->with('success', 'Product updated successfully.');
    }
}
