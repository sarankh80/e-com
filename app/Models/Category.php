<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'name_kh', 'parent_id', 'image', 'slug', 'description', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function parent()   { return $this->belongsTo(Category::class, 'parent_id'); }
    public function children() { return $this->hasMany(Category::class, 'parent_id'); }
    public function products() { return $this->hasMany(Product::class); }

    public function scopeRoot($q)   { return $q->where('parent_id', 0)->orWhereNull('parent_id'); }
    public function scopeActive($q) { return $q->where('is_active', true); }

    public function getImageUrlAttribute(): string
    {
        if ($this->image && str_starts_with($this->image, 'http')) return $this->image;
        return $this->image ? asset('storage/' . $this->image) : 'https://placehold.co/200x200/f8fafc/94a3b8?text=' . urlencode($this->name);
    }
}
