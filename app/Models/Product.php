<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    'price',
    'stock', // ADD THIS
    'image',
    'ram',
    'storage',
    'description',
    'category_id',
];   // ADD THIS (Required for Phase 2-d)
   

    // Define Relationship: A product belongs to a category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}