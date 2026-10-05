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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('content');
            $table->string('featured_image')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
             // Focus Keyword Analyzer
            $table->string('focus_keyword')->nullable();
            $table->integer('seo_score')->nullable();
            $table->json('seo_checks')->nullable();

            // Page Analysis
            $table->integer('readability_errors')->nullable();
            $table->json('readability_checks')->nullable();
            $table->json('title_checks')->nullable();
            
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
       public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {

            $table->dropColumn([
                'focus_keyword',
                'seo_score',
                'seo_checks',
                'readability_errors',
                'readability_checks',
                'title_checks',
            ]);
        });
    }
};
