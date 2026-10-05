<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('introduction', function (Blueprint $table) {

            $table->id();

            $table->string('type')->nullable();

            $table->string('name')->nullable();
            $table->string('title')->nullable();
            $table->string('icon')->nullable();
            $table->string('heading')->nullable();

            $table->longText('long_description')->nullable();
            $table->string('image')->nullable();

            $table->string('number')->nullable();
            $table->string('suffix')->nullable();

            $table->integer('sort_order')->default(0);
            $table->boolean('status')->default(1);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('introduction');
    }
};
