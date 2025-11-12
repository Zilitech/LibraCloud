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
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->string('library_name');
            $table->string('library_code')->nullable();
            $table->string('site_name');
            $table->text('address')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('email');
            $table->integer('max_book_issue')->default(1);
            $table->decimal('daily_fine', 8, 2)->nullable();
            $table->integer('grace_period')->nullable();
            $table->string('due_date_alerts')->default('Enable');
            $table->string('new_arrival_alerts')->default('Enable');
            $table->string('logo')->nullable();
            $table->string('background_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_settings');
    }
};
