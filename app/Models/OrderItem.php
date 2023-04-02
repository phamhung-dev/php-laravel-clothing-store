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

    public function discountPrice(){
        return $this->quantity * $this->price * (1 - $this->discount_percent / 100.0);
    }

    // Set the keys for a save update query
    protected function setKeysForSaveQuery($query)
    {
        $query->where('product_inventory_id', '=', $this->getAttribute('product_inventory_id'))
            ->where('order_detail_id', '=', $this->getAttribute('order_detail_id'));
        return $query;
    }

    // Get the primary key value for a save query.
    protected function getKeyForSaveQuery()
    {
        $keys = $this->getKeyName();
        if (!is_array($keys)) {
            return $this->getAttribute($keys);
        }
        foreach ($keys as $keyName) {
            if (is_null($this->getAttribute($keyName))) {
                return;
            }
        }
        return $keys;
    }
}
