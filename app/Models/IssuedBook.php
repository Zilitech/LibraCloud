<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssuedBook extends Model
{
    use HasFactory;

    // Table name (optional if follows convention)
    protected $table = 'issued_books';

    // Mass assignable fields
    protected $fillable = [
        'issue_id',
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

    // Optional: cast dates
    protected $dates = [
        'issue_date',
        'due_date',
        'created_at',
        'updated_at'
    ];
}
