<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('home_industries', function (Blueprint $table) {

            $table->id();

            $table->string('sub_title')->nullable();

            $table->string('title')->nullable();

            $table->string('button_text')->nullable();

            $table->string('button_link')->nullable();

            $table->longText('industries')->nullable();

            $table->boolean('status')->default(1);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_industries');
    }
};