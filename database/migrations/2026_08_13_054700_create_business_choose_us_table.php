<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('business_choose_us', function (Blueprint $table) {
            $table->id();

            $table->string('heading')->nullable();

            $table->longText('description')->nullable();

            $table->json('choose_items')->nullable();

            $table->boolean('status')->default(1);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('business_choose_us');
    }
};