<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberCategory extends Model

{

    protected $table = 'membercategory';
    protected $fillable = ['membercategoryname', 'maxbooks', 'fineperday'];

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function staff()
    {
        return $this->hasMany(Staff::class, 'role_id');
    }
}
