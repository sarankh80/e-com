<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'name_kh',
        'parent_id',
        'image',
        'slug',
        'description',
        'is_active',
    ];
}
