<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('auto_numbers', function (Blueprint $table) {
            $table->id();
            $table->string('type')->unique(); // book_code or member_id
            $table->string('prefix', 10);
            $table->integer('last_number')->default(0);
            $table->integer('digits')->default(4);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('auto_numbers');
    }
};
