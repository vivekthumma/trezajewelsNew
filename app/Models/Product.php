<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'name', 'slug', 'sku', 'price', 'discount_price',
        'making_charge', 'quantity', 'metal_type', 'purity', 'weight',
        'stone_type', 'stone_weight', 'short_description', 'description',
        'main_image', 'status', 'featured'
    ];

    /**
     * Auto-generate slug from name on saving.
     */
    protected static function booted()
    {
        static::saving(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
    }

    /**
     * Relationship: Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relationship: Gallery Images
     */
    public function gallery()
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * Scopes
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', 1);
    }
}
