<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fine extends Model
{
    use HasFactory;

    protected $fillable = [
        'issue_id',
        'member_id',
        'book_id',
        'member_name',
        'book_name',
        'issue_date',
        'due_date',
        'return_date',
        'days_overdue',
        'fine_amount',
        'status',
        'paid_at',
    ];

    protected $dates = [
        'issue_date',
        'due_date',
        'return_date',
        'paid_at',
        'created_at',
        'updated_at',
    ];

    // Optional relation to overdue book
    public function overdueBook()
    {
        return $this->belongsTo(OverdueBook::class, 'issue_id', 'issue_id');
    }
}
