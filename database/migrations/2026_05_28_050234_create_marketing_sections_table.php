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
        Schema::create('marketing_sections', function (Blueprint $table) {

            $table->id();

            $table->string('title')->nullable();

            $table->string('highlight_text')->nullable();

            $table->longText('description')->nullable();

            $table->string('link_text')->nullable();

            $table->string('link_url')->nullable();

            $table->json('tabs')->nullable();

            $table->boolean('status')->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marketing_sections');
    }
};