<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('notification_templates', function (Blueprint $table) {
            $table->id();
            $table->string('event_name'); // e.g., Issued Book, Returned Book
            $table->string('destination')->nullable(); // Email, SMS, Mobile App
            $table->string('recipient')->nullable(); // Student, Member
            $table->string('template_id')->nullable(); // Template ID if required
            $table->text('message')->nullable(); // Template message
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('notification_templates');
    }
};
