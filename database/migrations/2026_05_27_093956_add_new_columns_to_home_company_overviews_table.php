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
    Schema::table('home_company_overviews', function (Blueprint $table) {

        $table->string('main_image')->nullable();

        $table->string('video_url')->nullable();

        $table->longText('customer_images')->nullable();

        $table->longText('counters')->nullable();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('home_company_overviews', function (Blueprint $table) {
            //
        });
    }
};
