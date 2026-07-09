<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'name_kh', 'slug', 'sku', 'image', 'short_description', 'description',
        'price', 'compare_price', 'cost_price', 'category_id', 'brand_id', 'stock', 'unit',
        'tags', 'specifications', 'is_active', 'is_featured', 'is_new', 'is_on_sale',
        'views', 'sales', 'rating', 'review_count', 'weight', 'meta_title', 'meta_description',
    ];

    protected $casts = [
        'price'          => 'decimal:2',
        'compare_price'  => 'decimal:2',
        'cost_price'     => 'decimal:2',
        'tags'           => 'array',
        'specifications' => 'array',
        'is_active'      => 'boolean',
        'is_featured'    => 'boolean',
        'is_new'         => 'boolean',
        'is_on_sale'     => 'boolean',
    ];

    /* ── Relationships ─────────────────────────────── */
    public function category()   { return $this->belongsTo(Category::class); }
    public function brand()      { return $this->belongsTo(Brand::class); }
    public function images()     { return $this->hasMany(ProductImage::class)->orderBy('sort_order'); }
    public function variants()   { return $this->hasMany(ProductVariant::class)->orderBy('sort_order'); }
    public function reviews()    { return $this->hasMany(ProductReview::class)->where('is_approved', true); }
    public function cartItems()  { return $this->hasMany(CartItem::class); }
    public function orderItems() { return $this->hasMany(OrderItem::class); }
    public function wishlists()  { return $this->hasMany(Wishlist::class); }

    /* ── Accessors ─────────────────────────────────── */
    public function getImageUrlAttribute(): string
    {
        if ($this->image && str_starts_with($this->image, 'http')) return $this->image;
        return $this->image ? asset('storage/' . $this->image) : 'https://placehold.co/600x600/f8fafc/94a3b8?text=' . urlencode($this->name);
    }

    public function getDiscountPercentAttribute(): int
    {
        if (!$this->compare_price || $this->compare_price <= $this->price) return 0;
        return (int) round((($this->compare_price - $this->price) / $this->compare_price) * 100);
    }

    public function getIsInStockAttribute(): bool { return $this->stock > 0; }

    public function getStockStatusAttribute(): string
    {
        if ($this->stock <= 0) return 'Out of Stock';
        if ($this->stock <= 5) return 'Low Stock';
        return 'In Stock';
    }

    public function getFormattedPriceAttribute(): string
    {
        return '$' . number_format($this->price, 2);
    }

    public function getPrimaryImageAttribute(): string
    {
        return $this->images->first()?->image_url ?? $this->image_url;
    }

    /* ── Scopes ────────────────────────────────────── */
    public function scopeActive($q)   { return $q->where('is_active', true); }
    public function scopeFeatured($q) { return $q->where('is_featured', true); }
    public function scopeNew($q)      { return $q->where('is_new', true); }
    public function scopeOnSale($q)   { return $q->where('is_on_sale', true)->whereNotNull('compare_price'); }
    public function scopeInStock($q)  { return $q->where('stock', '>', 0); }

    public function scopeSearch($q, $term)
    {
        return $q->where(fn($q) =>
            $q->where('name', 'like', "%{$term}%")
              ->orWhere('description', 'like', "%{$term}%")
              ->orWhere('sku', 'like', "%{$term}%")
        );
    }

    public function incrementViews(): void { $this->increment('views'); }
}
