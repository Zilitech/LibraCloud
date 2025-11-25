<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fine extends Model
{
    use HasFactory;

    protected $fillable = [
        'fine_id',
        'member_id',
        'book_id',
        'issue_date',
        'due_date',
        'return_date',
        'days_overdue',
        'fine_amount',
        'status',
        'college_id',
    ];

    // Relation to overdue book
    public function overdueBook()
    {
        return $this->belongsTo(OverdueBook::class, 'book_id', 'id');
    }
}
