<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeCategorySection extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'subtitle',
        'product_count_text',
        'icon',
        'sort_order',
        'status',
    ];

    /**
     * Relationship: Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Scope for active sections.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
