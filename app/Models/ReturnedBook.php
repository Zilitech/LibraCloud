<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnedBook extends Model
{
    use HasFactory;

    protected $table = 'returned_books';

    protected $fillable = [
        'issue_id',
        'member_id',    // added
        'member_name',
        'book_name',
        'book_isbn',
        'author_name',
        'issue_date',
        'due_date',
        'quantity',
        'status',
        'remarks',
    ];

    protected $dates = ['issue_date','due_date','created_at','updated_at'];
}
