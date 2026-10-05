<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_proposals', function (Blueprint $table) {

            $table->id();

            $table->string('first_name')->nullable();

            $table->string('last_name')->nullable();

            $table->string('email')->nullable();

            $table->longText('message')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_proposals');
    }
};