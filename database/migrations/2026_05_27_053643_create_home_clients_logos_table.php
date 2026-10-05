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
        Schema::create('home_clients_logos', function (Blueprint $table) {

            $table->id();

            $table->string('title')->nullable();

            $table->string('highlight_number')->nullable();

            $table->string('highlight_text')->nullable();

            $table->json('logos')->nullable();

            $table->tinyInteger('status')
                ->default(1);

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_clients_logos');
    }
};