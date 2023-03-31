<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductInventory extends Model
{
    use HasFactory;

    protected $dateFormat = 'Y-m-d';
    protected $fillable = ['product_id', 'size', 'color', 'quantity', 'is_active'];

    // get list cart items
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    // get list order items
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // get product associated
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
