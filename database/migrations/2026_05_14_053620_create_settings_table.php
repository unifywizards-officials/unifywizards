<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();

            $table->string('header_logo')->nullable();
            $table->string('footer_logo')->nullable();
            $table->string('dark_footer_logo1')->nullable();
            $table->string('dark_footer_logo2')->nullable();

            $table->text('footer_description')->nullable();

            $table->string('footer_email')->nullable();
            $table->string('footer_number')->nullable();

            $table->json('social_links')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
