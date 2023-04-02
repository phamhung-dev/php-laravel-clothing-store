<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $dateFormat = 'Y-m-d';
    protected $fillable = ['first_name', 'last_name', 'avatar', 'email', 'password', 'birthdate', 'gender', 'telephone', 'apartment_number', 'street', 'ward', 'district', 'city', 'receive_newsletter', 'receive_offers', 'is_admin', 'is_locked'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // get list cart items
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    // get list order details
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    // get list wishlists
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    // get list role users
    public function roleUsers()
    {
        return $this->hasMany(RoleUser::class);
    }

    public function scopeAdmin($query)
    {
        return $query->where('is_admin', 1);
    }

    public function scopeUser($query)
    {
        return $query->where('is_admin', 0);
    }
}
