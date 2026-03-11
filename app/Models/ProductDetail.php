<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'description',
        'colors',
        'sizes',
        'gallery',
        'specifications',
    ];

    protected $casts = [
        'colors' => 'array',
        'sizes' => 'array',
        'gallery' => 'array',
        'specifications' => 'array',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
