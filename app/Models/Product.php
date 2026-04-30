<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * We EXCLUDE _token because it is not a database column.
     */
    protected $fillable = [
        'name',
        'name_kh',
        'image',
        'slug',
        'description',
        'price',
        'category_id',
        'stock',
        'is_active',
        'is_featured',
        'views',
        'sales',
        'rating',
    ];

    /**
     * Relationship: A product belongs to a category.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
