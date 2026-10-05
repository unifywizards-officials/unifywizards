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
        Schema::create('home_company_overviews', function (Blueprint $table) {

            $table->id();

            $table->string('sub_title')->nullable();

            $table->string('title')->nullable();

            $table->string('button_text')->nullable();

            $table->string('button_link')->nullable();

            $table->string('video_image')->nullable();

            $table->string('video_link')->nullable();

            $table->string('customer_bg')->nullable();

            $table->string('customer_text')->nullable();

            $table->longText('customers')->nullable();

            $table->longText('counter_items')->nullable();

            $table->tinyInteger('status')->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_company_overviews');
    }
};