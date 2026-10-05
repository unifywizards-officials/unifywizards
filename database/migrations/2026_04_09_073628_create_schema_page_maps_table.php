<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('schema_page_maps', function (Blueprint $table) {
    $table->id();
    $table->foreignId('schema_id')->constrained()->onDelete('cascade');
    $table->string('page'); // /about-us, blog/post-slug
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schema_page_maps');
    }
};
