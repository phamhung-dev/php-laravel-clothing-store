<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $primaryKey = ['user_id', 'product_id'];
    public $incrementing = false;

    protected $dateFormat = 'Y-m-d';
    protected $fillable = ['user_id', 'product_id'];

    // get user associated
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // get product associated
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
