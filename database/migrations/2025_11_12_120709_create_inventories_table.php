<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('book_id');
            $table->integer('added_quantity')->default(0);
            $table->integer('damaged')->default(0);
            $table->string('rack_number')->nullable();
            $table->string('condition')->nullable();
            $table->string('supplier')->nullable();
            $table->date('purchase_date')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();

            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
