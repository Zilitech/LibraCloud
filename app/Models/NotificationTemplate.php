<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_name',
        'destination', // store as JSON
        'recipient',   // store as JSON
        'template_id',
        'message',
    ];

    protected $casts = [
        'destination' => 'array',
        'recipient' => 'array',
    ];
}
