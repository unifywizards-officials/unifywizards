<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blog_histories', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('blog_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();

            $table->string('action');
            $table->string('blog_title');

            $table->timestamps();

            $table->foreign('blog_id')
                ->references('id')
                ->on('blogs')
                ->nullOnDelete();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blog_histories');
    }
};