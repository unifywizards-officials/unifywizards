<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('outstanding_results', function (Blueprint $table) {
            $table->id();

            $table->string('heading');
            $table->longText('description')->nullable();

            $table->json('results')->nullable();

            $table->boolean('status')->default(1);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('outstanding_results');
    }
};