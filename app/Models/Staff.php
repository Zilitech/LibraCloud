<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $table = 'staff';

    protected $fillable = [
        'name', 'email', 'phone', 'dob', 'gender',
        'role_name', // store role name only
        'department', 'joining_date', 'employee_id', 'status',
        'address', 'city', 'state', 'zip', 'country'
    ];
}
