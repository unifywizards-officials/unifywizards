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
        Schema::table('contact_proposals', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
            $table->string('website_url')->nullable()->after('phone');
            $table->string('looking_for')->nullable()->after('website_url');
            $table->longText('business_challenges')->nullable()->after('looking_for');
            $table->string('source')->nullable()->after('business_challenges');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contact_proposals', function (Blueprint $table) {
            $table->dropColumn(['phone', 'website_url', 'looking_for', 'business_challenges', 'source']);
        });
    }
};
