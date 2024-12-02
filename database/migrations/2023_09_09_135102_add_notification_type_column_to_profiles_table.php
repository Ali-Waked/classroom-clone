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
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('recive_email_notification')->nullable();
            $table->string('recive_sms_notification')->nullable();
            $table->string('recive_broadcast_notification')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn(['recive_email_notification', 'recive_sms_notification', 'recive_broadcast_notification']);
        });
    }
};
