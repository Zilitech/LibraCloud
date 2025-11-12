<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
   protected $fillable = [
    'book_title',
    'book_code',
    'isbn',
    'author_id',
    'publisher',
    'category_id',
    'subject',
    'rack_number',
    'quantity',
    'price',
    'purchase_date',
    'condition',
    'cover_image',
    'ebook_file',
    'description'
];

public function author()
{
    return $this->belongsTo(Author::class);
}

}