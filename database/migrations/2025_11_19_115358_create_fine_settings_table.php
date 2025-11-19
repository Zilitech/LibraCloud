<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFineSettingsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fine_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('due_days')->default(14); // Book due period
            $table->integer('overdue_start')->default(1); // Days after due date to start fine
            $table->decimal('daily_fine', 8, 2)->default(10.00); // Daily fine amount
            $table->decimal('max_fine', 8, 2)->nullable(); // Optional max fine
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fine_settings');
    }
}
