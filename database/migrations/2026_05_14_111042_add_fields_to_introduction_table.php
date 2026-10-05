<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('introduction', function (Blueprint $table) {

            // CMS type (introduction / experience / award)
            $table->string('type')->nullable()->after('id');

            // main content fields
            $table->string('name')->nullable()->after('type');
            $table->string('title')->nullable()->after('name');
            $table->string('icon')->nullable()->after('title');
            $table->string('heading')->nullable()->after('icon');

            $table->longText('long_description')->nullable()->after('heading');
            $table->string('image')->nullable()->after('long_description');

            // repeatable stats fields
            $table->string('number')->nullable()->after('image');
            $table->string('suffix')->nullable()->after('number');

            // ordering + status
            $table->integer('sort_order')->default(0)->after('suffix');
            $table->boolean('status')->default(1)->after('sort_order');
        });
    }

    public function down(): void
    {
        Schema::table('introduction', function (Blueprint $table) {

            $table->dropColumn([
                'type',
                'name',
                'title',
                'icon',
                'heading',
                'long_description',
                'image',
                'number',
                'suffix',
                'sort_order',
                'status'
            ]);

        });
    }
};