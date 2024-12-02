<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('classrooms')
            ->whereNull('theme')
            ->update(['theme' => '#1967d2']);
        Schema::table('classrooms', function (Blueprint $table) {
            $table->enum('theme', ['#1967d2', '#1e8e3e', '#e52592', '#e8710a', '#129eaf', '#9334e6', '#4285f4', '#5f6368'])->default('#1967d2')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('classrooms', function (Blueprint $table) {
            $table->string('theme')->nullable()->change();
        });
    }
};
