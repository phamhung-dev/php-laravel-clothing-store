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

    public function ship_address()
    {
        return trim($this->apartment_number . ', ' . $this->street . ', ' . $this->ward . ', ' . $this->district . ', ' . $this->city);
    }

    public function discountTotal(){
        if($this->coupon_id){
            return $this->subtotal * $this->coupon()->first()->discount_percent / 100.0;
        }
        return 0;
    }

    public function status()
    {
        switch ($this->status) {
            case 0:
                return 'Canceled';
            case 1:
                return 'Pending';
            case 2:
                return 'Completed';
        }
    }

}
