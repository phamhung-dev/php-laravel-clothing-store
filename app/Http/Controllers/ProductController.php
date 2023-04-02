<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::with('ProductCategory')
        ->orderBy('name', 'desc')
        ->get();
        return view('admin.product.list', compact('products'));
    }
    public function showFormCreate(){

        $productCategories = ProductCategory::all();
        return view('admin.product.create', compact('productCategories'));
    }
    public function edit($id)
    {
        $product = Product::with('ProductCategory')
        ->find($id);
        $productCategories = ProductCategory::all();
        return view('admin.product.edit',compact('product','productCategories'));
    }
}
