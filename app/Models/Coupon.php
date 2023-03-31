<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $dateFormat = 'Y-m-d';
    protected $fillable = ['name', 'description', 'discount_percent', 'start_date', 'end_date', 'is_active'];

    // get list order details
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
