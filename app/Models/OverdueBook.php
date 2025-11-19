<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OverdueBook extends Model
{
    use HasFactory;

    protected $fillable = [
        'issue_id',
        'book_name',
        'member_name',
        'member_id',
        'issue_date',
        'due_date',
        'days_overdue',
        'fine',
        'status',
    ];

    protected $dates = [
        'issue_date',
        'due_date',
        'created_at',
        'updated_at'
    ];
}
