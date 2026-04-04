<?php

use App\Models\Setting;

function setting($slug, $default = null)
{
    return optional(Setting::where('slug', $slug)->first())->value ?? $default;
}

function setting_asset($slug, $default_asset_path = null)
{
    $val = setting($slug);
    if ($val) {
        return imgPath('uploads/settings/' . $val);
    }
    return asset($default_asset_path);
}

if (!function_exists('imgPath')) {
    function imgPath($path)
    {
        if (empty($path)) {
            return asset('assets/images/placeholder.png');
        }
        
        if (str_contains($path, 'http://') || str_contains($path, 'https://') || str_contains($path, 'assets/')) {
            return asset($path);
        }
        
        return asset(env('IMG_PATH', '/uploads/') . $path);
    }
}