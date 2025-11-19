<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fine extends Model
{
    use HasFactory;

    protected $fillable = [
        'fine_id',
        'overdue_book_id',
        'member',
        'book_title',
        'issue_date',
        'due_date',
        'return_date',
        'days_overdue',
        'fine_amount',
        'status',
    ];

    // Relation to overdue book
    public function overdueBook()
    {
        return $this->belongsTo(OverdueBook::class);
    }
}
