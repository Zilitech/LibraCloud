<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ebooks', function (Blueprint $table) {
            $table->id();
            $table->string('book_title');
            $table->string('author_name');     // updated from author
            $table->string('category_name');   // updated from category
            $table->string('file_path')->nullable(); // updated from pdf_path
            $table->integer('total_pages')->nullable();
            $table->float('price')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ebooks');
    }
};
