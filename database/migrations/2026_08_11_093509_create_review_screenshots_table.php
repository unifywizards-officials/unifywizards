<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('review_screenshots', function (Blueprint $table) {
            $table->id();

            $table->string('heading');
            $table->longText('description')->nullable();

            // Multiple images will be stored as JSON
            $table->json('images')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('review_screenshots');
    }
};