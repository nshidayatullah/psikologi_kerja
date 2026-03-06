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
        Schema::table('survey_sessions', function (Blueprint $table) {
            $table->longText('pic1_signature')->nullable();
            $table->longText('pic2_signature')->nullable();
            $table->longText('reviewer_signature')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('survey_sessions', function (Blueprint $table) {
            $table->dropColumn(['pic1_signature', 'pic2_signature', 'reviewer_signature']);
        });
    }
};
