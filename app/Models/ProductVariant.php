<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable = ['product_id', 'name', 'value', 'sku', 'price_adjustment', 'stock', 'image', 'is_active', 'sort_order'];

    protected $casts = ['price_adjustment' => 'decimal:2', 'is_active' => 'boolean'];

    public function product() { return $this->belongsTo(Product::class); }

    public function getFinalPriceAttribute(): float
    {
        return (float) $this->product->price + (float) $this->price_adjustment;
    }

    public function getIsInStockAttribute(): bool { return $this->stock > 0; }
}
