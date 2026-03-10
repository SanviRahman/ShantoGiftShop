<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'category_slug' => 'electronics',
                'title' => 'HAVIT HV-G92 Gamepad',
                'price' => 120,
                'old_price' => 160,
                'rating' => 5,
                'review_count' => 88,
                'discount_percent' => 40,
                'stock_qty' => 20,
                'is_flash_sale' => true,
                'is_best_seller' => true,
                'featured_image' => 'https://images.unsplash.com/photo-1593305841991-05c297ba4575?auto=format&fit=crop&w=800&q=80',
            ],
            [
                'category_slug' => 'electronics',
                'title' => 'AK-900 Wired Keyboard',
                'price' => 960,
                'old_price' => 1160,
                'rating' => 4.5,
                'review_count' => 75,
                'discount_percent' => 35,
                'stock_qty' => 15,
                'is_flash_sale' => true,
                'is_best_seller' => false,
                'featured_image' => 'https://images.unsplash.com/photo-1511467687858-23d96c32e4ae?auto=format&fit=crop&w=800&q=80',
            ],
            [
                'category_slug' => 'electronics',
                'title' => 'IPS LCD Gaming Monitor',
                'price' => 370,
                'old_price' => 400,
                'rating' => 5,
                'review_count' => 99,
                'discount_percent' => 30,
                'stock_qty' => 10,
                'is_flash_sale' => true,
                'is_best_seller' => true,
                'featured_image' => 'https://images.unsplash.com/photo-1527443224154-c4a3942d3acf?auto=format&fit=crop&w=800&q=80',
            ],
            [
                'category_slug' => 'home-lifestyle',
                'title' => 'S-Series Comfort Chair',
                'price' => 375,
                'old_price' => 400,
                'rating' => 4.5,
                'review_count' => 99,
                'discount_percent' => 25,
                'stock_qty' => 8,
                'is_flash_sale' => true,
                'is_best_seller' => true,
                'featured_image' => 'https://images.unsplash.com/photo-1503602642458-232111445657?auto=format&fit=crop&w=800&q=80',
            ],
            [
                'category_slug' => 'mens-fashion',
                'title' => 'The North Coat',
                'price' => 260,
                'old_price' => 360,
                'rating' => 5,
                'review_count' => 65,
                'discount_percent' => 28,
                'stock_qty' => 18,
                'is_best_seller' => true,
                'featured_image' => 'https://images.unsplash.com/photo-1591047139829-d91aecb6caea?auto=format&fit=crop&w=800&q=80',
            ],
            [
                'category_slug' => 'mens-fashion',
                'title' => 'Gucci Duffle Bag',
                'price' => 960,
                'old_price' => 1160,
                'rating' => 4.5,
                'review_count' => 65,
                'discount_percent' => 18,
                'stock_qty' => 12,
                'is_best_seller' => true,
                'featured_image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=800&q=80',
            ],
            [
                'category_slug' => 'electronics',
                'title' => 'RGB Liquid CPU Cooler',
                'price' => 160,
                'old_price' => 170,
                'rating' => 4.5,
                'review_count' => 65,
                'stock_qty' => 25,
                'is_best_seller' => true,
                'featured_image' => 'https://images.unsplash.com/photo-1587202372775-e229f172b9d7?auto=format&fit=crop&w=800&q=80',
            ],
            [
                'category_slug' => 'home-lifestyle',
                'title' => 'Small BookShelf',
                'price' => 360,
                'rating' => 5,
                'review_count' => 65,
                'stock_qty' => 10,
                'is_best_seller' => true,
                'featured_image' => 'https://images.unsplash.com/photo-1594620302200-9a762244a156?auto=format&fit=crop&w=800&q=80',
            ],
            [
                'category_slug' => 'groceries-pets',
                'title' => 'Breed Dry Dog Food',
                'price' => 100,
                'rating' => 4,
                'review_count' => 35,
                'stock_qty' => 30,
                'is_featured' => true,
                'featured_image' => 'https://images.unsplash.com/photo-1568640347023-a616a30bc3bd?auto=format&fit=crop&w=800&q=80',
            ],
            [
                'category_slug' => 'electronics',
                'title' => 'CANON EOS DSLR Camera',
                'price' => 360,
                'rating' => 5,
                'review_count' => 95,
                'stock_qty' => 9,
                'is_featured' => true,
                'featured_image' => 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?auto=format&fit=crop&w=800&q=80',
            ],
            [
                'category_slug' => 'electronics',
                'title' => 'ASUS FHD Gaming Laptop',
                'price' => 700,
                'rating' => 5,
                'review_count' => 325,
                'stock_qty' => 7,
                'is_featured' => true,
                'featured_image' => 'https://images.unsplash.com/photo-1603302576837-37561b2e2302?auto=format&fit=crop&w=800&q=80',
            ],
            [
                'category_slug' => 'health-beauty',
                'title' => 'Curology Product Set',
                'price' => 500,
                'rating' => 4.5,
                'review_count' => 145,
                'stock_qty' => 20,
                'is_featured' => true,
                'featured_image' => 'https://images.unsplash.com/photo-1556228578-0d85b1a4d571?auto=format&fit=crop&w=800&q=80',
            ],
        ];

        foreach ($products as $item) {
            $category = Category::where('slug', $item['category_slug'])->first();

            $product = Product::create([
                'category_id' => $category->id,
                'title' => $item['title'],
                'slug' => Str::slug($item['title']),
                'sku' => 'SKU-' . strtoupper(Str::random(8)),
                'short_description' => $item['title'] . ' short description',
                'price' => $item['price'],
                'old_price' => $item['old_price'] ?? null,
                'rating' => $item['rating'],
                'review_count' => $item['review_count'],
                'discount_percent' => $item['discount_percent'] ?? null,
                'stock_qty' => $item['stock_qty'],
                'is_flash_sale' => $item['is_flash_sale'] ?? false,
                'is_best_seller' => $item['is_best_seller'] ?? false,
                'is_featured' => $item['is_featured'] ?? false,
                'featured_image' => $item['featured_image'],
            ]);

            $gallery = [
                $item['featured_image'],
                $item['featured_image'],
                $item['featured_image'],
                $item['featured_image'],
            ];

            $product->detail()->create([
                'description' => 'High quality ' . $item['title'] . ' for your daily use.',
                'colors' => ['#A0BCE0', '#E07575', '#000000'],
                'sizes' => ['XS', 'S', 'M', 'L', 'XL'],
                'gallery' => $gallery,
                'specifications' => [
                    'brand' => 'ShantoGiftShop',
                    'origin' => 'Bangladesh',
                    'warranty' => '6 Months',
                ],
            ]);
        }
    }
}