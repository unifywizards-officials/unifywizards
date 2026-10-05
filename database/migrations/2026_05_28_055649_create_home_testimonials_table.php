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
        Schema::create('home_testimonials', function (Blueprint $table) {

            $table->id();

            // Header Section
            $table->string('sub_title')->nullable();

            $table->string('title')->nullable();

            $table->string('highlight_text')->nullable();

            // Testimonials JSON
            $table->json('testimonials_json')->nullable();

            // Status
            $table->boolean('status')->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_testimonials');
    }
};