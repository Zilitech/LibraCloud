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
        Schema::create('fines', function (Blueprint $table) {
            $table->id();
            $table->string('issue_id')->unique();
            $table->string('member_id')->nullable();
            $table->string('member_name');
            $table->string('book_name');
            $table->date('issue_date');
            $table->date('due_date');
            $table->integer('days_overdue')->default(0);
            $table->decimal('fine', 10, 2)->default(0);
            $table->enum('status', ['Pending', 'Paid', 'Overdue'])->default('Overdue');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fines');
    }
};
