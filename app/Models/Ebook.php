<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ebook extends Model
{
    use HasFactory;

    protected $table = 'ebooks';

    protected $fillable = [
        'book_title',
        'author_name',      // updated
        'category_name',    // updated
        'file_path',        // updated
        'total_pages',
        'price',
        'description',
    ];
}
