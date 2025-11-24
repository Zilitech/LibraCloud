<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // Specify the table name
    protected $table = 'roles';

    // Mass assignable fields
    protected $fillable = ['name'];

    // Define the many-to-many relationship with permissions
    public function permissions() {
        return $this->belongsToMany(Permission::class, 'role_permission');
    }
}
