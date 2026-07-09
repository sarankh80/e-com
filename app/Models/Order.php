<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number', 'user_id', 'coupon_id', 'shipping_address_id',
        'status', 'payment_method', 'payment_status',
        'subtotal', 'discount', 'shipping_cost', 'tax', 'total',
        'coupon_code', 'notes', 'tracking_number', 'shipping_method',
        'paid_at', 'shipped_at', 'delivered_at',
    ];

    protected $casts = [
        'subtotal'      => 'decimal:2',
        'discount'      => 'decimal:2',
        'shipping_cost' => 'decimal:2',
        'tax'           => 'decimal:2',
        'total'         => 'decimal:2',
        'paid_at'       => 'datetime',
        'shipped_at'    => 'datetime',
        'delivered_at'  => 'datetime',
    ];

    public function user()            { return $this->belongsTo(User::class); }
    public function items()           { return $this->hasMany(OrderItem::class); }
    public function payment()         { return $this->hasOne(Payment::class); }
    public function coupon()          { return $this->belongsTo(Coupon::class); }
    public function shippingAddress() { return $this->belongsTo(ShippingAddress::class); }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'pending'    => 'warning',
            'processing' => 'primary',
            'shipped'    => 'info',
            'delivered'  => 'success',
            'cancelled'  => 'danger',
            'refunded'   => 'gray',
            default      => 'gray',
        };
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($order) {
            if (!$order->order_number) {
                $order->order_number = 'ORD-' . strtoupper(substr(uniqid(), -8));
            }
        });
    }
}
