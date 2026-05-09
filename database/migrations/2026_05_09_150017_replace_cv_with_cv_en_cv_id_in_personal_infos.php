<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('personal_infos', function (Blueprint $table) {
            $table->dropColumn('cv');
            $table->string('cv_en')->nullable()->after('picture');
            $table->string('cv_id')->nullable()->after('cv_en');
        });
    }

    public function down(): void
    {
        Schema::table('personal_infos', function (Blueprint $table) {
            $table->dropColumn(['cv_en', 'cv_id']);
            $table->string('cv')->nullable()->after('picture');
        });
    }
};
