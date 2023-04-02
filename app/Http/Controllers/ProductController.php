<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function singleProduct(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
        ]);
        $product = Product::active()->find($request->id);
        if ($product) {
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
    public function index()
    {
        $products = Product::with('ProductCategory')
            ->orderBy('name', 'desc')
            ->get();
        return view('admin.product.list', compact('products'));
    }
    public function showFormCreate()
    {

        $productCategories = ProductCategory::all();
        return view('admin.product.create', compact('productCategories'));
    }

    public function edit($id)
    {
        $product = Product::with('ProductCategory')
            ->find($id);
        $productCategories = ProductCategory::all();
        return view('admin.product.edit', compact('product', 'productCategories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:256',
            'image_upload' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_hover_upload' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string|max:512',
            'weight' => 'required|string|max:32',
            'dimensions' => 'required|string|max:128',
            'materials' => 'required|string|max:512',
            'other_info' => 'required|string|max:512',
            'import_price' => 'required|numeric|min:1',
            'sell_price' => 'required|numeric|min:1',
            'discount_percent' => 'required|numeric|min:0|max:100',
            'is_active' => 'in:on,off',
        ]);
        $request->merge([
            'image' => base64_encode(file_get_contents($request->file('image_upload')->path())),
            'image_hover' => base64_encode(file_get_contents($request->file('image_hover_upload')->path())),
            'is_active' => $request->is_active == 'on' ? 1 : 0,
        ]);
        try {
            Product::create($request->all());
        } catch (\Exception $err) {
            return back()->withError('can not create new product')->withInput();
        }
        return redirect()->route('admin.product');
    }
    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required|string|max:256',
            'image_upload' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_hover_upload' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string|max:512',
            'weight' => 'required|string|max:32',
            'dimensions' => 'required|string|max:128',
            'materials' => 'required|string|max:512',
            'other_info' => 'required|string|max:512',
            'import_price' => 'required|numeric|min:1',
            'sell_price' => 'required|numeric|min:1',
            'discount_percent' => 'required|numeric|min:0|max:100',
            'is_active' => 'in:on,off',
        ]);
        if ($request->image_upload !=null) {
            $request->merge([
                'image' => base64_encode(file_get_contents($request->file('image_upload')->path())),
                'is_active' => $request->is_active == 'on' ? 1 : 0,
            ]);
        }
        else if ($request->image_hover_upload !=null) {
            $request->merge([
                'image_hover' => base64_encode(file_get_contents($request->file('image_hover_upload')->path())),
                'is_active' => $request->is_active == 'on' ? 1 : 0,
            ]);
        }
        else if ($request->image_hover_upload !=null && $request->image_hover_upload !=null ) {
            $request->merge([
                'image' => base64_encode(file_get_contents($request->file('image_upload')->path())),
                'image_hover' => base64_encode(file_get_contents($request->file('image_hover_upload')->path())),
                'is_active' => $request->is_active == 'on' ? 1 : 0,
            ]);
        }
        else{
            return back()->withError('can not update product')->withInput();
        }
        try {
            Product::find($id)->update($request->all());
        } catch (Exception $err) {
            return back()->withError('can not update product')->withInput();
        }
        return redirect()->route('admin.product');
    }
}
