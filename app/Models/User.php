<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Wishlist;
use App\Models\Address;
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Customer's cart
    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    // Customer's orders
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function wishlists()
{
    return $this->hasMany(Wishlist::class);
}
public function addresses()
{
    return $this->hasMany(Address::class);
}
}