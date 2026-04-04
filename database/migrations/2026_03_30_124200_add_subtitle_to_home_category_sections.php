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
        Schema::table('home_category_sections', function (Blueprint $table) {
            $table->string('subtitle')->nullable()->after('title');
            $table->string('product_count_text')->nullable()->after('subtitle');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('home_category_sections', function (Blueprint $table) {
            $table->dropColumn(['subtitle', 'product_count_text']);
        });
    }
};
