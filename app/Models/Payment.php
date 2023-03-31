<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $dateFormat = 'Y-m-d';
    protected $fillable = ['name', 'description'];

    // get list order details
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
