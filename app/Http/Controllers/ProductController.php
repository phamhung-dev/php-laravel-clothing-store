<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function singleProduct(Request $request){
        $request->validate([
            'id' => 'required|integer'
        ]);
        $product = Product::active()->find($request->id);
        if($product){
            $maxQuantity = $product->productInventories()->sum('quantity');
            $sizes = $product->productInventories()->select('size')->distinct()->get();
            $colors = $product->productInventories()->select('color')->distinct()->get();
            $relatedProducts = Product::active()->where([
                ['product_category_id', $product->product_category_id],
                ['id', '!=', $product->id]
            ])->take(4)->get();
            return view('web.single_product')->with([
                'product' => $product,
                'maxQuantity' => $maxQuantity,
                'sizes' => $sizes,
                'colors' => $colors,
                'relatedProducts' => $relatedProducts,
            ]);
        }
        return abort(404);
    }
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
