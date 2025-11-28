<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('email_settings', function (Blueprint $table) {
            $table->id();
            $table->string('email_engine')->default('SMTP');
            $table->string('smtp_username');
            $table->string('smtp_password');
            $table->string('smtp_server');
            $table->integer('smtp_port');
            $table->enum('smtp_security', ['OFF', 'SSL', 'TLS'])->default('OFF');
            $table->enum('smtp_auth', ['ON', 'OFF'])->default('ON');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('email_settings');
    }
};
