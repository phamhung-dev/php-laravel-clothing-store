<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $dateFormat = 'Y-m-d';
    protected $fillable = ['name', 'image', 'image_hover', 'description', 'gender', 'weight', 'dimensions', 'materials', 'other_info', 'import_price', 'sell_price', 'discount_percent', 'product_category_id', 'is_active'];

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    // get list product inventories
    public function productInventories()
    {
        return $this->hasMany(ProductInventory::class);
    }

    // get list wishlists
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }
}
