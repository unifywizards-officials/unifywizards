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
        Schema::create('home_hero_sections', function (Blueprint $table) {

            $table->id();

            // Hero Content
            $table->string('sub_title')->nullable();
            $table->string('title')->nullable();
            $table->string('highlight_text')->nullable();

            $table->longText('description')->nullable();

            // Main Hero Image
            $table->string('hero_image')->nullable();

            // Pattern Shape
            $table->string('pattern_shape')->nullable();

            // Customers Area
            $table->string('customer_count')->nullable();
            $table->string('customer_text')->nullable();

            // Customer Images (JSON)
            $table->json('customer_images')->nullable();

            // Awards Images (JSON)
            $table->json('award_images')->nullable();

            // Scroll Button
            $table->string('scroll_button_text')->nullable();
            $table->string('scroll_button_link')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_hero_sections');
    }
};