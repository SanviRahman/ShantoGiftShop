<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'sku',
        'short_description',
        'price',
        'old_price',
        'rating',
        'review_count',
        'discount_percent',
        'stock_qty',
        'is_flash_sale',
        'is_best_seller',
        'is_featured',
        'is_active',
        'featured_image',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'old_price' => 'decimal:2',
        'rating' => 'decimal:1',
        'is_flash_sale' => 'boolean',
        'is_best_seller' => 'boolean',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function detail()
    {
        return $this->hasOne(ProductDetail::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function wishlistItems()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function getImageUrlAttribute(): string
    {
        if (!$this->featured_image) {
            return 'https://via.placeholder.com/400x400/F5F5F5/000000?text=Product';
        }

        if (Str::startsWith($this->featured_image, ['http://', 'https://'])) {
            return $this->featured_image;
        }

        return asset('storage/' . $this->featured_image);
    }
}