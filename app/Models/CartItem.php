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

    // Set the keys for a save update query
    protected function setKeysForSaveQuery($query)
    {
        $query->where('user_id', '=', $this->getAttribute('user_id'))
            ->where('product_inventory_id', '=', $this->getAttribute('product_inventory_id'));
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
    public function price(){
        $product = $this->productInventory()->first()->product()->first();
        return $this->quantity * $product->sell_price * (1 - $product->discount_percent / 100.0);
    }
}
