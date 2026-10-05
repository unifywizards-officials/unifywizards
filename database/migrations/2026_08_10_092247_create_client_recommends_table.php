<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('client_recommends', function (Blueprint $table) {
            $table->id();

            $table->string('title')->default('Clients Recommend Us');

            $table->text('description')->nullable();

            $table->json('clients')->nullable();

            $table->boolean('status')->default(1);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('client_recommends');
    }
};