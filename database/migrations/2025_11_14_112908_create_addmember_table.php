<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();

            $table->string('memberid')->nullable();   // Member ID
            $table->string('fullname');               // Full Name
            $table->string('gender')->nullable();     // Gender
            $table->date('dateofbirth')->nullable();  // Date of Birth
            $table->string('membertype')->nullable(); // Student / Faculty / Guest

            $table->string('departmentclass')->nullable();    // Dept / Class
            $table->string('rollnoemployeeid')->nullable();   // Roll No / Employee ID
            $table->string('yearsemester')->nullable();       // Year / Sem

            $table->string('email')->nullable();     // Email
            $table->string('phone')->nullable();     // Phone
            $table->text('address')->nullable();     // Address

            $table->string('city')->nullable();      // City
            $table->string('state')->nullable();     // State
            $table->string('pincode')->nullable();   // PIN Code

            $table->date('joiningdate')->nullable(); // Joining Date
            $table->string('status')->default('Active'); // Active / Inactive

            $table->string('profilephoto')->nullable(); // File name of uploaded photo

            $table->boolean('cardIssued')->default(false); // Library Card Issued

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
