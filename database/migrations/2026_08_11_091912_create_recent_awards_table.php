<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recent_awards', function (Blueprint $table) {
            $table->id();

            // Section heading
            $table->string('title')->nullable();

            // Section description
            $table->text('description')->nullable();

            // Multiple awards
            $table->json('awards')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recent_awards');
    }
};