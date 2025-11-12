<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('book_title');
            $table->string('book_code')->nullable();
            $table->string('isbn')->nullable();
$table->unsignedBigInteger('author_id')->nullable();
$table->foreign('author_id')->references('id')->on('authors')->onDelete('set null');
            $table->string('publisher')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('subject')->nullable();
            $table->string('rack_number')->nullable();
            $table->integer('quantity')->default(1);
            $table->decimal('price', 8, 2)->nullable();
            $table->date('purchase_date')->nullable();
            $table->string('condition')->default('New');
            $table->string('cover_image')->nullable();
            $table->string('ebook_file')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
