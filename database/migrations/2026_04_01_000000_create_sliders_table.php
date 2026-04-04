<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sliders', function (Blueprint $image) {
            $image->id();
            $image->string('image');
            $image->string('title')->nullable();
            $image->string('sub_title')->nullable();
            $image->string('link')->nullable();
            $image->integer('order')->default(0);
            $image->boolean('status')->default(true);
            $image->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sliders');
    }
};
