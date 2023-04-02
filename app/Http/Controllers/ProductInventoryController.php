<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductInventory;
use Illuminate\Http\Request;

class ProductInventoryController extends Controller
{
    public function index(){
        $productInventories = ProductInventory::with('Product')
        ->orderBy('color', 'desc')
        ->get();
        return view('admin.inventory.list', compact('productInventories'));
    }
    public function showFormCreate(){
        $products = Product::all();
        return view('admin.inventory.create', compact('products'));
    }
}
