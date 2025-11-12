<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'current_stock',
        'added_quantity',
        'damaged',
        'rack_number',
        'condition',
        'supplier',
        'purchase_date',
        'remarks',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    
}
