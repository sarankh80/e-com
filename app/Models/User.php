<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    function factory(): UserFactory
    {
        return new UserFactory();
    }
    function hasRole($role): bool
    {
        return $this->roles()->where('name', $role)->exists();
    }
    // function hasPermissionTo($permission): bool
    // {
    //     return $this->permissions()->where('name', $permission)->exists() ||
    //            $this->roles()->whereHas('permissions', function ($query) use ($permission) {
    //                $query->where('name', $permission);
    //            })->exists();
    // }
    // function permissions()
    // {
    //     return $this->belongsToMany(Permission::class, 'model_has_permissions', 'model_id', 'permission_id');
    // }
    // function roles()
    // {
    //     return $this->belongsToMany(Role::class, 'model_has_roles', 'model_id', 'role_id');
    // }
    // function assignRole($role): void
    // {
    //     $this->roles()->attach($role);
    // }
    // function givePermissionTo($permission): void
    // {
    //     $this->permissions()->attach($permission);
    // }
}
