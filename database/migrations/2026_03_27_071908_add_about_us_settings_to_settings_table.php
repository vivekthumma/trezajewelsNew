<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('settings')->insert([
            [
                'slug' => 'about_heading',
                'value' => 'About us',
                'type' => 'text',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'about_company_title',
                'value' => 'Our company',
                'type' => 'text',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'about_company_description',
                'value' => 'Our organization excels in delivering innovative solutions tailored to client needs. With a commitment to quality and cutting-edge technology, we turn visionary ideas into reality, driving success and growth.',
                'type' => 'textarea',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'about_company_image',
                'value' => 'about-company.png',
                'type' => 'file',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'about_teamwork_title',
                'value' => 'Team work',
                'type' => 'text',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'about_teamwork_description',
                'value' => 'Success relies on collective effort where diverse skills merge seamlessly. By combining our strengths and working together effectively, we overcome challenges, drive innovation, and achieve remarkable results.',
                'type' => 'textarea',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'about_teamwork_image',
                'value' => 'about-team.png',
                'type' => 'file',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('settings')->whereIn('slug', [
            'about_heading',
            'about_company_title',
            'about_company_description',
            'about_company_image',
            'about_teamwork_title',
            'about_teamwork_description',
            'about_teamwork_image'
        ])->delete();
    }
};
