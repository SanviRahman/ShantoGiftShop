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
        $catalog = [
            'babys-toys' => [
                ['title' => 'Remote Control Racing Car', 'price' => 45, 'old_price' => 60, 'rating' => 4.5, 'review_count' => 54, 'discount_percent' => 25, 'stock_qty' => 30, 'is_flash_sale' => true, 'is_best_seller' => true, 'featured_image' => 'https://images.unsplash.com/photo-1515488042361-ee00e0ddd4e4?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Soft Teddy Bear', 'price' => 20, 'old_price' => 28, 'rating' => 4.8, 'review_count' => 77, 'discount_percent' => 29, 'stock_qty' => 50, 'is_flash_sale' => true, 'featured_image' => 'https://images.unsplash.com/photo-1587300003388-59208cc962cb?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Kids Learning Blocks Set', 'price' => 32, 'old_price' => 40, 'rating' => 4.6, 'review_count' => 63, 'stock_qty' => 40, 'is_best_seller' => true, 'featured_image' => 'https://images.unsplash.com/photo-1587654780291-39c9404d746b?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Baby Walker Deluxe', 'price' => 85, 'old_price' => 95, 'rating' => 4.3, 'review_count' => 35, 'stock_qty' => 18, 'featured_image' => 'https://images.unsplash.com/photo-1516627145497-ae6968895b74?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Musical Toy Piano', 'price' => 38, 'old_price' => 50, 'rating' => 4.4, 'review_count' => 42, 'discount_percent' => 24, 'stock_qty' => 22, 'featured_image' => 'https://images.unsplash.com/photo-1513883049090-d0b7439799bf?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Baby Feeding Chair', 'price' => 72, 'old_price' => 90, 'rating' => 4.5, 'review_count' => 27, 'stock_qty' => 15, 'featured_image' => 'https://images.unsplash.com/photo-1503454537195-1dcabb73ffb9?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Toy Kitchen Play Set', 'price' => 55, 'old_price' => 70, 'rating' => 4.7, 'review_count' => 58, 'stock_qty' => 26, 'is_best_seller' => true, 'featured_image' => 'https://images.unsplash.com/photo-1566576912321-d58ddd7a6088?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Baby Stroller Compact', 'price' => 110, 'old_price' => 130, 'rating' => 4.4, 'review_count' => 31, 'stock_qty' => 12, 'featured_image' => 'https://images.unsplash.com/photo-1544126592-807ade215a0b?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Kids Drawing Board', 'price' => 24, 'old_price' => 30, 'rating' => 4.2, 'review_count' => 21, 'stock_qty' => 35, 'featured_image' => 'https://images.unsplash.com/photo-1516627145497-ae6968895b74?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Plush Animal Combo Pack', 'price' => 29, 'old_price' => 39, 'rating' => 4.6, 'review_count' => 47, 'stock_qty' => 28, 'is_featured' => true, 'featured_image' => 'https://images.unsplash.com/photo-1559454403-b8fb88521f11?auto=format&fit=crop&w=800&q=80'],
            ],

            'electronics' => [
                ['title' => 'HAVIT HV-G92 Gamepad', 'price' => 120, 'old_price' => 160, 'rating' => 5, 'review_count' => 88, 'discount_percent' => 40, 'stock_qty' => 20, 'is_flash_sale' => true, 'is_best_seller' => true, 'featured_image' => 'https://images.unsplash.com/photo-1593305841991-05c297ba4575?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'AK-900 Wired Keyboard', 'price' => 960, 'old_price' => 1160, 'rating' => 4.5, 'review_count' => 75, 'discount_percent' => 35, 'stock_qty' => 15, 'is_flash_sale' => true, 'featured_image' => 'https://images.unsplash.com/photo-1511467687858-23d96c32e4ae?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'IPS LCD Gaming Monitor', 'price' => 370, 'old_price' => 400, 'rating' => 5, 'review_count' => 99, 'discount_percent' => 30, 'stock_qty' => 10, 'is_flash_sale' => true, 'is_best_seller' => true, 'featured_image' => 'https://images.unsplash.com/photo-1527443224154-c4a3942d3acf?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'RGB Liquid CPU Cooler', 'price' => 160, 'old_price' => 170, 'rating' => 4.5, 'review_count' => 65, 'stock_qty' => 25, 'is_best_seller' => true, 'featured_image' => 'https://images.unsplash.com/photo-1587202372775-e229f172b9d7?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'CANON EOS DSLR Camera', 'price' => 360, 'rating' => 5, 'review_count' => 95, 'stock_qty' => 9, 'is_featured' => true, 'featured_image' => 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'ASUS FHD Gaming Laptop', 'price' => 700, 'rating' => 5, 'review_count' => 325, 'stock_qty' => 7, 'is_featured' => true, 'featured_image' => 'https://images.unsplash.com/photo-1603302576837-37561b2e2302?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Wireless Bluetooth Earbuds', 'price' => 89, 'old_price' => 110, 'rating' => 4.6, 'review_count' => 112, 'discount_percent' => 19, 'stock_qty' => 40, 'featured_image' => 'https://images.unsplash.com/photo-1572569511254-d8f925fe2cbb?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Smart Watch Pro', 'price' => 150, 'old_price' => 190, 'rating' => 4.4, 'review_count' => 84, 'discount_percent' => 21, 'stock_qty' => 18, 'featured_image' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Portable Mini Speaker', 'price' => 65, 'old_price' => 80, 'rating' => 4.3, 'review_count' => 57, 'stock_qty' => 24, 'featured_image' => 'https://images.unsplash.com/photo-1545454675-3531b543be5d?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'USB Condenser Microphone', 'price' => 130, 'old_price' => 150, 'rating' => 4.7, 'review_count' => 49, 'stock_qty' => 13, 'is_best_seller' => true, 'featured_image' => 'https://images.unsplash.com/photo-1580894908361-967195033215?auto=format&fit=crop&w=800&q=80'],
            ],

            'groceries-pets' => [
                ['title' => 'Breed Dry Dog Food', 'price' => 100, 'rating' => 4, 'review_count' => 35, 'stock_qty' => 30, 'is_featured' => true, 'featured_image' => 'https://images.unsplash.com/photo-1568640347023-a616a30bc3bd?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Premium Cat Food Pack', 'price' => 42, 'old_price' => 50, 'rating' => 4.5, 'review_count' => 41, 'discount_percent' => 16, 'stock_qty' => 45, 'featured_image' => 'https://images.unsplash.com/photo-1516734212186-a967f81ad0d7?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Organic Honey Jar', 'price' => 18, 'old_price' => 22, 'rating' => 4.7, 'review_count' => 52, 'stock_qty' => 60, 'featured_image' => 'https://images.unsplash.com/photo-1587049352851-8d4e89133924?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Fresh Grain Rice Bag', 'price' => 28, 'old_price' => 34, 'rating' => 4.3, 'review_count' => 26, 'stock_qty' => 38, 'featured_image' => 'https://images.unsplash.com/photo-1586201375761-83865001e31c?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Pet Grooming Brush', 'price' => 16, 'old_price' => 20, 'rating' => 4.4, 'review_count' => 33, 'stock_qty' => 34, 'featured_image' => 'https://images.unsplash.com/photo-1517849845537-4d257902454a?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Healthy Mixed Nuts Box', 'price' => 24, 'old_price' => 30, 'rating' => 4.6, 'review_count' => 48, 'stock_qty' => 29, 'is_best_seller' => true, 'featured_image' => 'https://images.unsplash.com/photo-1599599810769-bcde5a160d32?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Bird Food Premium Mix', 'price' => 14, 'old_price' => 18, 'rating' => 4.2, 'review_count' => 19, 'stock_qty' => 37, 'featured_image' => 'https://images.unsplash.com/photo-1452570053594-1b985d6ea890?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Natural Olive Oil Bottle', 'price' => 21, 'old_price' => 27, 'rating' => 4.5, 'review_count' => 44, 'stock_qty' => 31, 'featured_image' => 'https://images.unsplash.com/photo-1474979266404-7eaacbcd87c5?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Pet Chew Toy Bone', 'price' => 12, 'old_price' => 15, 'rating' => 4.1, 'review_count' => 22, 'stock_qty' => 43, 'featured_image' => 'https://images.unsplash.com/photo-1548199973-03cce0bbc87b?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Coffee Beans Classic Roast', 'price' => 26, 'old_price' => 32, 'rating' => 4.8, 'review_count' => 61, 'stock_qty' => 27, 'is_featured' => true, 'featured_image' => 'https://images.unsplash.com/photo-1447933601403-0c6688de566e?auto=format&fit=crop&w=800&q=80'],
            ],

            'health-beauty' => [
                ['title' => 'Curology Product Set', 'price' => 500, 'rating' => 4.5, 'review_count' => 145, 'stock_qty' => 20, 'is_featured' => true, 'featured_image' => 'https://images.unsplash.com/photo-1556228578-0d85b1a4d571?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Vitamin C Face Serum', 'price' => 32, 'old_price' => 40, 'rating' => 4.7, 'review_count' => 68, 'discount_percent' => 20, 'stock_qty' => 36, 'is_best_seller' => true, 'featured_image' => 'https://images.unsplash.com/photo-1620916566398-39f1143ab7be?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Herbal Shampoo Care', 'price' => 18, 'old_price' => 24, 'rating' => 4.4, 'review_count' => 51, 'stock_qty' => 50, 'featured_image' => 'https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Matte Lipstick Set', 'price' => 27, 'old_price' => 35, 'rating' => 4.3, 'review_count' => 47, 'stock_qty' => 40, 'featured_image' => 'https://images.unsplash.com/photo-1586495777744-4413f21062fa?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Organic Aloe Vera Gel', 'price' => 15, 'old_price' => 20, 'rating' => 4.6, 'review_count' => 37, 'stock_qty' => 42, 'featured_image' => 'https://images.unsplash.com/photo-1619451334792-150fd785ee74?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Luxury Perfume Spray', 'price' => 75, 'old_price' => 95, 'rating' => 4.8, 'review_count' => 59, 'stock_qty' => 16, 'is_flash_sale' => true, 'featured_image' => 'https://images.unsplash.com/photo-1541643600914-78b084683601?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Body Lotion Smooth Care', 'price' => 19, 'old_price' => 25, 'rating' => 4.2, 'review_count' => 28, 'stock_qty' => 46, 'featured_image' => 'https://images.unsplash.com/photo-1571781926291-c477ebfd024b?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Face Wash Gentle Clean', 'price' => 14, 'old_price' => 18, 'rating' => 4.5, 'review_count' => 39, 'stock_qty' => 52, 'featured_image' => 'https://images.unsplash.com/photo-1556228720-195a672e8a03?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Nail Polish Combo Pack', 'price' => 22, 'old_price' => 29, 'rating' => 4.1, 'review_count' => 24, 'stock_qty' => 33, 'featured_image' => 'https://images.unsplash.com/photo-1604654894610-df63bc536371?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Hair Dryer Professional', 'price' => 66, 'old_price' => 80, 'rating' => 4.4, 'review_count' => 31, 'stock_qty' => 21, 'is_featured' => true, 'featured_image' => 'https://images.unsplash.com/photo-1522338140262-f46f5913618a?auto=format&fit=crop&w=800&q=80'],
            ],

            'home-lifestyle' => [
                ['title' => 'S-Series Comfort Chair', 'price' => 375, 'old_price' => 400, 'rating' => 4.5, 'review_count' => 99, 'discount_percent' => 25, 'stock_qty' => 8, 'is_flash_sale' => true, 'is_best_seller' => true, 'featured_image' => 'https://images.unsplash.com/photo-1503602642458-232111445657?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Small BookShelf', 'price' => 360, 'rating' => 5, 'review_count' => 65, 'stock_qty' => 10, 'is_best_seller' => true, 'featured_image' => 'https://images.unsplash.com/photo-1594620302200-9a762244a156?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Modern Floor Lamp', 'price' => 84, 'old_price' => 100, 'rating' => 4.4, 'review_count' => 41, 'stock_qty' => 19, 'featured_image' => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Wooden Coffee Table', 'price' => 210, 'old_price' => 250, 'rating' => 4.6, 'review_count' => 29, 'stock_qty' => 11, 'featured_image' => 'https://images.unsplash.com/photo-1499933374294-4584851497cc?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Decorative Wall Clock', 'price' => 48, 'old_price' => 60, 'rating' => 4.3, 'review_count' => 34, 'stock_qty' => 24, 'featured_image' => 'https://images.unsplash.com/photo-1563861826100-9cb868fdbe1c?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Kitchen Storage Rack', 'price' => 67, 'old_price' => 80, 'rating' => 4.5, 'review_count' => 38, 'stock_qty' => 17, 'is_featured' => true, 'featured_image' => 'https://images.unsplash.com/photo-1484154218962-a197022b5858?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Luxury Bedsheet Set', 'price' => 58, 'old_price' => 72, 'rating' => 4.7, 'review_count' => 56, 'stock_qty' => 27, 'featured_image' => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Minimalist Sofa Cushion', 'price' => 26, 'old_price' => 34, 'rating' => 4.2, 'review_count' => 20, 'stock_qty' => 35, 'featured_image' => 'https://images.unsplash.com/photo-1519947486511-46149fa0a254?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Ceramic Flower Vase', 'price' => 31, 'old_price' => 39, 'rating' => 4.4, 'review_count' => 23, 'stock_qty' => 29, 'featured_image' => 'https://images.unsplash.com/photo-1517705008128-361805f42e86?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Dining Chair Set', 'price' => 290, 'old_price' => 340, 'rating' => 4.6, 'review_count' => 32, 'stock_qty' => 9, 'is_best_seller' => true, 'featured_image' => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=800&q=80'],
            ],

            'medicine' => [
                ['title' => 'Digital Thermometer', 'price' => 18, 'old_price' => 24, 'rating' => 4.5, 'review_count' => 62, 'stock_qty' => 45, 'is_best_seller' => true, 'featured_image' => 'https://images.unsplash.com/photo-1584515933487-779824d29309?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'First Aid Box Complete', 'price' => 34, 'old_price' => 42, 'rating' => 4.7, 'review_count' => 43, 'stock_qty' => 28, 'featured_image' => 'https://images.unsplash.com/photo-1579154204601-01588f351e67?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Blood Pressure Monitor', 'price' => 72, 'old_price' => 88, 'rating' => 4.6, 'review_count' => 39, 'stock_qty' => 16, 'featured_image' => 'https://images.unsplash.com/photo-1584362917165-526a968579e8?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Vitamin Tablet Pack', 'price' => 15, 'old_price' => 20, 'rating' => 4.4, 'review_count' => 50, 'stock_qty' => 60, 'featured_image' => 'https://images.unsplash.com/photo-1587854692152-cbe660dbde88?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Pulse Oximeter Device', 'price' => 29, 'old_price' => 36, 'rating' => 4.3, 'review_count' => 27, 'stock_qty' => 22, 'featured_image' => 'https://images.unsplash.com/photo-1584515933487-779824d29309?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Medical Face Mask Pack', 'price' => 10, 'old_price' => 14, 'rating' => 4.2, 'review_count' => 44, 'stock_qty' => 75, 'is_flash_sale' => true, 'featured_image' => 'https://images.unsplash.com/photo-1584036561566-baf8f5f1b144?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Hand Sanitizer Gel', 'price' => 8, 'old_price' => 12, 'rating' => 4.5, 'review_count' => 58, 'stock_qty' => 80, 'featured_image' => 'https://images.unsplash.com/photo-1584744982491-665216d95f8b?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Hot Water Bag', 'price' => 12, 'old_price' => 16, 'rating' => 4.1, 'review_count' => 19, 'stock_qty' => 33, 'featured_image' => 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Pain Relief Spray', 'price' => 14, 'old_price' => 18, 'rating' => 4.4, 'review_count' => 26, 'stock_qty' => 37, 'featured_image' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Nebulizer Machine', 'price' => 65, 'old_price' => 78, 'rating' => 4.6, 'review_count' => 22, 'stock_qty' => 12, 'is_featured' => true, 'featured_image' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=800&q=80'],
            ],

            'mens-fashion' => [
                ['title' => 'The North Coat', 'price' => 260, 'old_price' => 360, 'rating' => 5, 'review_count' => 65, 'discount_percent' => 28, 'stock_qty' => 18, 'is_best_seller' => true, 'featured_image' => 'https://images.unsplash.com/photo-1591047139829-d91aecb6caea?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Gucci Duffle Bag', 'price' => 960, 'old_price' => 1160, 'rating' => 4.5, 'review_count' => 65, 'discount_percent' => 18, 'stock_qty' => 12, 'is_best_seller' => true, 'featured_image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Classic Denim Jacket', 'price' => 120, 'old_price' => 150, 'rating' => 4.6, 'review_count' => 44, 'stock_qty' => 22, 'featured_image' => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Slim Fit Casual Shirt', 'price' => 42, 'old_price' => 55, 'rating' => 4.3, 'review_count' => 38, 'stock_qty' => 35, 'featured_image' => 'https://images.unsplash.com/photo-1603252109303-2751441dd157?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Formal Leather Shoes', 'price' => 88, 'old_price' => 110, 'rating' => 4.7, 'review_count' => 53, 'stock_qty' => 20, 'featured_image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Cotton Polo T-Shirt', 'price' => 28, 'old_price' => 36, 'rating' => 4.2, 'review_count' => 29, 'stock_qty' => 46, 'featured_image' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Men Sport Sneakers', 'price' => 75, 'old_price' => 95, 'rating' => 4.5, 'review_count' => 48, 'stock_qty' => 26, 'is_flash_sale' => true, 'featured_image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Luxury Wrist Watch', 'price' => 140, 'old_price' => 180, 'rating' => 4.8, 'review_count' => 61, 'stock_qty' => 14, 'is_featured' => true, 'featured_image' => 'https://images.unsplash.com/photo-1523170335258-f5ed11844a49?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Winter Hoodie Premium', 'price' => 58, 'old_price' => 72, 'rating' => 4.4, 'review_count' => 33, 'stock_qty' => 31, 'featured_image' => 'https://images.unsplash.com/photo-1556821840-3a63f95609a7?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Tailored Office Pant', 'price' => 49, 'old_price' => 60, 'rating' => 4.3, 'review_count' => 25, 'stock_qty' => 28, 'featured_image' => 'https://images.unsplash.com/photo-1473966968600-fa801b869a1a?auto=format&fit=crop&w=800&q=80'],
            ],

            'sports-outdoor' => [
                ['title' => 'Football Training Ball', 'price' => 26, 'old_price' => 34, 'rating' => 4.5, 'review_count' => 46, 'stock_qty' => 40, 'is_best_seller' => true, 'featured_image' => 'https://images.unsplash.com/photo-1517649763962-0c623066013b?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Camping Tent 4 Person', 'price' => 110, 'old_price' => 140, 'rating' => 4.7, 'review_count' => 39, 'stock_qty' => 12, 'featured_image' => 'https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Mountain Hiking Backpack', 'price' => 68, 'old_price' => 84, 'rating' => 4.6, 'review_count' => 51, 'stock_qty' => 19, 'featured_image' => 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Yoga Mat Premium', 'price' => 24, 'old_price' => 30, 'rating' => 4.4, 'review_count' => 37, 'stock_qty' => 34, 'featured_image' => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Dumbbell Set 10KG', 'price' => 55, 'old_price' => 70, 'rating' => 4.5, 'review_count' => 29, 'stock_qty' => 17, 'featured_image' => 'https://images.unsplash.com/photo-1517836357463-d25dfeac3438?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Running Shoes Outdoor', 'price' => 72, 'old_price' => 90, 'rating' => 4.3, 'review_count' => 42, 'stock_qty' => 23, 'featured_image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Cycling Helmet Safe Ride', 'price' => 38, 'old_price' => 48, 'rating' => 4.2, 'review_count' => 21, 'stock_qty' => 26, 'featured_image' => 'https://images.unsplash.com/photo-1485965120184-e220f721d03e?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Cricket Bat Pro Edition', 'price' => 64, 'old_price' => 80, 'rating' => 4.6, 'review_count' => 33, 'stock_qty' => 15, 'is_featured' => true, 'featured_image' => 'https://images.unsplash.com/photo-1531415074968-036ba1b575da?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Fishing Rod Starter Kit', 'price' => 59, 'old_price' => 74, 'rating' => 4.1, 'review_count' => 18, 'stock_qty' => 14, 'featured_image' => 'https://images.unsplash.com/photo-1517411032315-54ef2cb783bb?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Badminton Racket Pair', 'price' => 33, 'old_price' => 42, 'rating' => 4.4, 'review_count' => 27, 'stock_qty' => 29, 'is_flash_sale' => true, 'featured_image' => 'https://images.unsplash.com/photo-1626224583764-f87db24ac4ea?auto=format&fit=crop&w=800&q=80'],
            ],

            'womens-fashion' => [
                ['title' => 'Elegant Floral Dress', 'price' => 68, 'old_price' => 85, 'rating' => 4.7, 'review_count' => 58, 'stock_qty' => 24, 'is_best_seller' => true, 'featured_image' => 'https://images.unsplash.com/photo-1496747611176-843222e1e57c?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Women Handbag Premium', 'price' => 92, 'old_price' => 120, 'rating' => 4.5, 'review_count' => 44, 'stock_qty' => 18, 'featured_image' => 'https://images.unsplash.com/photo-1584917865442-de89df76afd3?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Classic High Heel Sandal', 'price' => 54, 'old_price' => 68, 'rating' => 4.4, 'review_count' => 36, 'stock_qty' => 21, 'featured_image' => 'https://images.unsplash.com/photo-1543163521-1bf539c55dd2?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Women Casual Top', 'price' => 30, 'old_price' => 38, 'rating' => 4.2, 'review_count' => 29, 'stock_qty' => 40, 'featured_image' => 'https://images.unsplash.com/photo-1483985988355-763728e1935b?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Luxury Party Gown', 'price' => 130, 'old_price' => 160, 'rating' => 4.8, 'review_count' => 32, 'stock_qty' => 12, 'is_featured' => true, 'featured_image' => 'https://images.unsplash.com/photo-1496747611176-843222e1e57c?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Women Denim Jacket', 'price' => 76, 'old_price' => 94, 'rating' => 4.5, 'review_count' => 39, 'stock_qty' => 19, 'featured_image' => 'https://images.unsplash.com/photo-1529139574466-a303027c1d8b?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Soft Knit Cardigan', 'price' => 44, 'old_price' => 58, 'rating' => 4.3, 'review_count' => 25, 'stock_qty' => 28, 'featured_image' => 'https://images.unsplash.com/photo-1529139574466-a303027c1d8b?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Ladies Wrist Watch', 'price' => 88, 'old_price' => 110, 'rating' => 4.6, 'review_count' => 41, 'stock_qty' => 16, 'is_flash_sale' => true, 'featured_image' => 'https://images.unsplash.com/photo-1523170335258-f5ed11844a49?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Designer Sunglasses Women', 'price' => 36, 'old_price' => 45, 'rating' => 4.4, 'review_count' => 34, 'stock_qty' => 30, 'featured_image' => 'https://images.unsplash.com/photo-1511499767150-a48a237f0083?auto=format&fit=crop&w=800&q=80'],
                ['title' => 'Women Office Blazer', 'price' => 82, 'old_price' => 99, 'rating' => 4.5, 'review_count' => 27, 'stock_qty' => 14, 'is_best_seller' => true, 'featured_image' => 'https://images.unsplash.com/photo-1483985988355-763728e1935b?auto=format&fit=crop&w=800&q=80'],
            ],
        ];

        foreach ($catalog as $categorySlug => $products) {
            $category = Category::where('slug', $categorySlug)->first();

            if (!$category) {
                continue;
            }

            foreach ($products as $item) {
                $product = Product::create([
                    'category_id' => $category->id,
                    'title' => $item['title'],
                    'slug' => Str::slug($item['title'] . '-' . $categorySlug),
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
                    'is_active' => true,
                ]);

                $gallery = [
                    $item['featured_image'],
                    $item['featured_image'],
                    $item['featured_image'],
                    $item['featured_image'],
                ];

                $sizes = in_array($categorySlug, ['mens-fashion', 'womens-fashion'])
                    ? ['XS', 'S', 'M', 'L', 'XL']
                    : [];

                $product->detail()->create([
                    'description' => 'High quality ' . $item['title'] . ' for your daily use.',
                    'colors' => ['#A0BCE0', '#E07575', '#000000'],
                    'sizes' => $sizes,
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
}