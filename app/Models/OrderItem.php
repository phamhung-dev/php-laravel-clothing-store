<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $primaryKey = ['product_inventory_id', 'order_detail_id'];
    public $incrementing = false;

    protected $dateFormat = 'Y-m-d';
    protected $fillable = ['product_inventory_id', 'order_detail_id', 'price', 'discount_percent', 'quantity'];

    // get product inventory associated
    public function productInventory()
    {
        return $this->belongsTo(ProductInventory::class);
    }

    // get order detail associated
    public function orderDetail()
    {
        return $this->belongsTo(OrderDetail::class);
    }
}
