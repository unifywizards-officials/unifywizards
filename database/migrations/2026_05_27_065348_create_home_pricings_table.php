<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('home_pricings', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | SECTION HEADER
            |--------------------------------------------------------------------------
            */

            $table->string('sub_title')->nullable();

            $table->string('title')->nullable();

            $table->string('highlight_text')->nullable();

            /*
            |--------------------------------------------------------------------------
            | PRICING CARDS
            |--------------------------------------------------------------------------
            */

            $table->longText('pricing_cards')->nullable();

            /*
            |--------------------------------------------------------------------------
            | STATUS
            |--------------------------------------------------------------------------
            */

            $table->tinyInteger('status')
                ->default(1);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_pricings');
    }
};