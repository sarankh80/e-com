<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = ['code', 'type', 'value', 'min_order', 'max_discount', 'usage_limit', 'usage_count', 'is_active', 'starts_at', 'expires_at'];

    protected $casts = ['is_active' => 'boolean', 'starts_at' => 'date', 'expires_at' => 'date', 'value' => 'decimal:2', 'min_order' => 'decimal:2'];

    public function isValid(float $orderTotal): bool
    {
        if (!$this->is_active) return false;
        if ($this->starts_at && $this->starts_at->isFuture()) return false;
        if ($this->expires_at && $this->expires_at->isPast()) return false;
        if ($this->usage_limit && $this->usage_count >= $this->usage_limit) return false;
        if ($orderTotal < $this->min_order) return false;
        return true;
    }

    public function calculateDiscount(float $subtotal): float
    {
        if ($this->type === 'percent') {
            $discount = $subtotal * ($this->value / 100);
            return $this->max_discount ? min($discount, $this->max_discount) : $discount;
        }
        return min($this->value, $subtotal);
    }
}
