<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'status', // boolean: 1 = active, 0 = inactive
    ];

    protected $casts = [
        'purchase_date' => 'date',
        'status' => 'boolean',
    ];

    // Relationship: Book belongs to Author using author_name
    public function author()
    {
        return $this->belongsTo(Author::class, 'author_name', 'author_name');
    }

    // Additional relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function inventory()
    {
        return $this->hasOne(Inventory::class);
    }

    // Accessors
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
}
