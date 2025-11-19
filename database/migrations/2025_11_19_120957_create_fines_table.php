<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fines', function (Blueprint $table) {
            $table->id();
            $table->string('fine_id')->unique(); // e.g., FINE-001
            $table->unsignedBigInteger('member_id'); // references members table
            $table->unsignedBigInteger('book_id'); // references books table
            $table->date('issue_date');
            $table->date('due_date');
            $table->date('return_date')->nullable();
            $table->integer('days_overdue')->default(0);
            $table->decimal('fine_amount', 10, 2)->default(0);
            $table->enum('status', ['Pending', 'Paid', 'Overdue'])->default('Pending');
            $table->unsignedBigInteger('college_id'); // Different fine setting per college
            $table->timestamps();

            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fines');
    }
}
