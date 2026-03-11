<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $cloths = Category::create([
            'name' => 'Cloths',
            'slug' => 'cloths',
            'icon_class' => 'fas fa-shirt',
        ]);

        Category::create([
            'parent_id' => $cloths->id,
            'name' => "Women's Fashion",
            'slug' => 'womens-fashion',
            'icon_class' => 'fas fa-person-dress',
        ]);

        Category::create([
            'parent_id' => $cloths->id,
            'name' => "Men's Fashion",
            'slug' => 'mens-fashion',
            'icon_class' => 'fas fa-person',
        ]);

        $categories = [
            ['Electronics', 'electronics', 'fas fa-mobile-screen-button'],
            ['Home & Lifestyle', 'home-lifestyle', 'fas fa-couch'],
            ['Medicine', 'medicine', 'fas fa-capsules'],
            ['Sports & Outdoor', 'sports-outdoor', 'fas fa-football'],
            ["Baby's & Toys", 'babys-toys', 'fas fa-baby'],
            ['Groceries & Pets', 'groceries-pets', 'fas fa-basket-shopping'],
            ['Health & Beauty', 'health-beauty', 'fas fa-heart-pulse'],
        ];

        foreach ($categories as [$name, $slug, $icon]) {
            Category::create([
                'name' => $name,
                'slug' => $slug,
                'icon_class' => $icon,
            ]);
        }
    }
}
