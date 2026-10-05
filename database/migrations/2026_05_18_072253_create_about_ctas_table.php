<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_about_ctas_table.php

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
        Schema::create('about_ctas', function (Blueprint $table) {

            $table->id();

            $table->string('small_label')->nullable();

            $table->string('main_heading')->nullable();

            $table->longText('description')->nullable();

            $table->string('button_1_text')->nullable();
            $table->string('button_1_url')->nullable();

            $table->string('button_2_text')->nullable();
            $table->string('button_2_url')->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_ctas');
    }
};