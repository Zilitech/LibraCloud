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
    // Add book_id if missing
    if (!Schema::hasColumn('overdue_books', 'book_id')) {
        Schema::table('overdue_books', function (Blueprint $table) {
            $table->unsignedBigInteger('book_id')->nullable()->after('issue_id');
        });
    }

    // Force member_id to NULL before type conversion
    DB::statement("UPDATE overdue_books SET member_id = NULL");

    // Now safely cast member_id to BIGINT
    DB::statement('ALTER TABLE overdue_books ALTER COLUMN member_id TYPE BIGINT USING member_id::bigint');

    // Allow null
    DB::statement('ALTER TABLE overdue_books ALTER COLUMN member_id DROP NOT NULL');
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('overdue_books', function (Blueprint $table) {
            //
        });
    }
};
