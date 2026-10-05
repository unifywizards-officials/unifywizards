<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();

            // Left side content
            $table->string('badge')->nullable();
            $table->string('heading')->nullable();
            $table->text('description_1')->nullable();
            $table->text('description_2')->nullable();

            // Platform reviews — JSON array
            // Structure: [{"icon":"google.png","title":"Google","rating":"4.9","small_text":"150+ reviews"}, ...]
            $table->json('review_items')->nullable();

            // Testimonials — JSON array
            // Structure: [{"review":"Great work!","name":"Rahul","designation":"CEO"}, ...]
            $table->json('testimonial_items')->nullable();

            // Bottom stats
            $table->string('retention_rate')->nullable();
            $table->string('satisfaction_rate')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
