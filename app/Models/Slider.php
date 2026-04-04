<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'title',
        'sub_title',
        'link',
        'order',
        'status',
    ];

    /**
     * Scope for active sliders.
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
}
