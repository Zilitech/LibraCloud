<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
    {
        Schema::create('issued_books', function (Blueprint $table) {
            $table->id();
            $table->string('issue_id')->unique();

            // Store member and book details directly
            $table->string('member_name');
            $table->string('book_name');
            $table->string('book_isbn');
            $table->string('author_name');

            $table->date('issue_date');
            $table->date('due_date');
            $table->integer('quantity');
            $table->string('status');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('issued_books');
    }
};
