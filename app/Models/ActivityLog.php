<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $table = 'activity_logs'; // Specify table name
    protected $fillable = [
        'user_id',
        'action',
        'details',
        'status',
        'created_at',
        'updated_at'
    ];

    // Relationship with User (assuming you have a User model)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
