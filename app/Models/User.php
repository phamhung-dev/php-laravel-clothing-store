<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $dateFormat = 'Y-m-d';
    protected $fillable = ['first_name', 'last_name', 'avatar', 'email', 'password', 'birthdate', 'gender', 'telephone', 'apartment_number', 'street', 'ward', 'district', 'city', 'receive_newsletter', 'receive_offers', 'is_locked'];

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

}
