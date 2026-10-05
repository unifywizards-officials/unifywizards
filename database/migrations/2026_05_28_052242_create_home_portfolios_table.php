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
        Schema::create('home_portfolios', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | SECTION HEADER
            |--------------------------------------------------------------------------
            */

            $table->string('sub_title')->nullable();

            $table->string('title')->nullable();

            $table->string('highlight_text')->nullable();

            $table->text('description')->nullable();

            $table->string('button_text')->nullable();

            $table->string('button_link')->nullable();

            /*
            |--------------------------------------------------------------------------
            | PROJECTS JSON
            |--------------------------------------------------------------------------
            */

            $table->longText('projects_json')->nullable();

            /*
            |--------------------------------------------------------------------------
            | STATUS
            |--------------------------------------------------------------------------
            */

            $table->boolean('status')->default(1);

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_portfolios');
    }
};