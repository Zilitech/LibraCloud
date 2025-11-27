<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AutoNumber extends Model
{
    protected $table = 'auto_numbers';

    protected $fillable = [
        'type',
        'prefix',
        'last_number',
        'digits'
    ];
}
