<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $primaryKey = ['user_id', 'product_inventory_id'];
    public $incrementing = false;
    protected $dateFormat = 'Y-m-d';
    protected $fillable = ['user_id', 'product_inventory_id', 'quantity'];

    // get user associated
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // get product inventory associated
    public function productInventory()
    {
        return $this->belongsTo(ProductInventory::class);
    }
}
