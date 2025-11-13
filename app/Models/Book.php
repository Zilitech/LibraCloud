<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;
    

    // Fillable fields for mass assignment
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
        'description',
        
    ];

    

    // Relationship with Author
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    // Relationship with Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Accessor for formatted price
     */
    public function getFormattedPriceAttribute()
    {
        return $this->price ? '₹' . number_format($this->price, 2) : '-';
    }

    /**
     * Accessor for cover image URL
     */
    public function getCoverImageUrlAttribute()
    {
        return $this->cover_image ? asset($this->cover_image) : asset('images/default_book_cover.png');
    }

    /**
     * Accessor for eBook URL
     */
    public function getEbookUrlAttribute()
    {
        return $this->ebook_file ? asset($this->ebook_file) : null;
    }


    protected $casts = [
        'purchase_date' => 'date', // Cast to Carbon automatically
    ];

    public function inventory()
{
    return $this->hasOne(Inventory::class);
}





}

