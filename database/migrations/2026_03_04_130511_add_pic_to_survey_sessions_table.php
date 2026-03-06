<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('survey_sessions', function (Blueprint $table) {
            $table->string('pic1_name')->nullable();
            $table->string('pic1_role')->nullable();
            $table->string('pic2_name')->nullable();
            $table->string('pic2_role')->nullable();
            $table->string('reviewer_name')->nullable();
            $table->string('reviewer_role')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('survey_sessions', function (Blueprint $table) {
            $table->dropColumn(['pic1_name', 'pic1_role', 'pic2_name', 'pic2_role', 'reviewer_name', 'reviewer_role']);
        });
    }
};
