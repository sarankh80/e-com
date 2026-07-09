<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = ['name', 'email', 'password', 'phone', 'avatar', 'is_admin'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
        'is_admin'          => 'boolean',
    ];

    public function cart()             { return $this->hasOne(Cart::class); }
    public function orders()           { return $this->hasMany(Order::class); }
    public function wishlist()         { return $this->hasMany(Wishlist::class); }
    public function reviews()          { return $this->hasMany(ProductReview::class); }
    public function addresses()        { return $this->hasMany(ShippingAddress::class); }
    public function defaultAddress()   { return $this->hasOne(ShippingAddress::class)->where('is_default', true); }

    public function getAvatarUrlAttribute(): string
    {
        if ($this->avatar) return asset('storage/' . $this->avatar);
        $hash = md5(strtolower(trim($this->email)));
        return "https://www.gravatar.com/avatar/{$hash}?d=mp&s=80";
    }

    function factory(): UserFactory { return new UserFactory(); }
}
