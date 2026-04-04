<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['slug', 'value', 'type'];

    /**
     * Clear settings cache on any change.
     */
    protected static function booted()
    {
        static::updated(function ($setting) {
            Cache::forget('site_settings');
        });

        static::created(function ($setting) {
            Cache::forget('site_settings');
        });

        static::deleted(function ($setting) {
            Cache::forget('site_settings');
        });
    }

    /**
     * Get a setting value by slug.
     * Uses caching for performance.
     */
    public static function get($slug, $default = null)
    {
        $settings = Cache::rememberForever('site_settings', function () {
            return Setting::all()->pluck('value', 'slug')->toArray();
        });

        return $settings[$slug] ?? $default;
    }
}
