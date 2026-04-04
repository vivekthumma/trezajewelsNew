<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Seed the settings table.
     */
    public function run(): void
    {
        $settings = [
            [
                'slug' => 'site_logo',
                'value' => 'logo-default.png',
                'type' => 'file',
            ],
            [
                'slug' => 'favicon',
                'value' => 'favicon-default.png',
                'type' => 'file',
            ],
            [
                'slug' => 'site_email',
                'value' => 'info@trezajewels.com',
                'type' => 'email',
            ],
            [
                'slug' => 'site_phone',
                'value' => '+1 234 567 890',
                'type' => 'text',
            ],
            [
                'slug' => 'site_address',
                'value' => '123 Diamond Street, Jewelry District, New York, NY 10001',
                'type' => 'textarea',
            ],
            [
                'slug' => 'instagram_link',
                'value' => 'https://www.instagram.com/trezajewels',
                'type' => 'url',
            ],
            [
                'slug' => 'twitter_link',
                'value' => 'https://twitter.com/trezajewels',
                'type' => 'url',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['slug' => $setting['slug']], $setting);
        }
    }
}
