<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $dateFormat = 'Y-m-d';
    protected $fillable = ['name', 'description', 'is_active'];

    // get list products
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
