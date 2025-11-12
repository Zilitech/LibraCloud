<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admin_login';
    protected $fillable = ['name', 'email', 'password', 'role', 'status', 'last_login_at'];
}

