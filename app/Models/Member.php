<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'members';

    protected $fillable = [
        'memberid',
        'fullname',
        'gender',
        'dateofbirth',
        'membertype',
        'departmentclass',
        'rollnoemployeeid',
        'yearsemester',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'pincode',
        'joiningdate',
        'status',
        'profilephoto',
        'cardIssued',
    ];
}
