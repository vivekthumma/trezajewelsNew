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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('sku')->unique();
            $table->decimal('price', 15, 2);
            $table->decimal('discount_price', 15, 2)->nullable();
            $table->decimal('making_charge', 15, 2)->nullable();
            $table->integer('quantity')->default(0);
            $table->string('metal_type')->nullable(); // Yellow Gold, Rose Gold, White Gold, etc.
            $table->string('purity')->nullable(); // 14K, 18K, 22K, PT950, etc.
            $table->string('weight')->nullable(); // In grams
            $table->string('stone_type')->nullable(); // Diamond, Emerald, Ruby, etc.
            $table->string('stone_weight')->nullable(); // In carats
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->string('main_image')->nullable();
            $table->boolean('status')->default(1);
            $table->boolean('featured')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
