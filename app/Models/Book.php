<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_title',
        'book_code',
        'isbn',
        'author_name',
        'publisher',
        'category_name',
        'subject',
        'rack_number',
        'quantity',
        'price',
        'purchase_date',
        'condition',
        'cover_image',
        'ebook_file',
        'description',
    ];

    protected $casts = [
        'purchase_date' => 'date',
    ];

    public function getFormattedPriceAttribute()
    {
        return $this->price ? '₹' . number_format($this->price, 2) : '-';
    }

    public function getCoverImageUrlAttribute()
    {
        return $this->cover_image ?? asset('images/default_book_cover.png');
    }

    public function getEbookUrlAttribute()
    {
        return $this->ebook_file ? asset($this->ebook_file) : null;
    }

     // Book belongs to Author
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    // Book belongs to Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Book has one inventory
    public function inventory()
    {
        return $this->hasOne(Inventory::class);
    }
}
