<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $fillable = ['title', 'title_kh', 'image', 'slug', 'description', 'is_active'];
}
