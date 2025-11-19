<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FineSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'due_days',
        'overdue_start',
        'daily_fine',
        'max_fine',
    ];
}
