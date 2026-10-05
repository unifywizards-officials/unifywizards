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
        Schema::create('home_our_solutions', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | SECTION HEADING
            |--------------------------------------------------------------------------
            */

            $table->string('sub_title')->nullable();

            $table->string('title')->nullable();

            $table->string('highlight_text')->nullable();

            /*
            |--------------------------------------------------------------------------
            | SERVICES JSON
            |--------------------------------------------------------------------------
            */

            $table->longText('services')->nullable();

            /*
            |--------------------------------------------------------------------------
            | BOTTOM CTA
            |--------------------------------------------------------------------------
            */

            $table->text('bottom_text')->nullable();

            $table->string('bottom_button_text')->nullable();

            $table->string('bottom_button_link')->nullable();

            /*
            |--------------------------------------------------------------------------
            | STATUS
            |--------------------------------------------------------------------------
            */

            $table->tinyInteger('status')->default(1);

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_our_solutions');
    }
};