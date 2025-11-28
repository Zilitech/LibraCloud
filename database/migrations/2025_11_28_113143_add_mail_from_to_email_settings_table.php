<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('email_settings', function (Blueprint $table) {
            $table->string('mail_from_address')->after('smtp_auth')->nullable();
            $table->string('mail_from_name')->after('mail_from_address')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('email_settings', function (Blueprint $table) {
            $table->dropColumn(['mail_from_address', 'mail_from_name']);
        });
    }
};
