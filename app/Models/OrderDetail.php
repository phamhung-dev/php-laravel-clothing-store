<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $dateFormat = 'Y-m-d';
    protected $fillable = ['user_id', 'subtotal', 'total', 'coupon_id', 'payment_id', 'note', 'apartment_number', 'street', 'ward', 'district', 'city', 'telephone', 'status'];

    // get user associated
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // get coupon associated
    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    // get payment associated
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    // get list order items
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

}
