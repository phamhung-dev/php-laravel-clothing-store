<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductInventory;
use Exception;
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
    public function create(Request $request){
        $request->validate(
            [
                'size' => 'required|string|max:256',
                'color' => 'required|string|max:512',
                'quantity' => 'required|numeric|min:1',
                'is_active' => 'in:on,off',
            ]
        );
        $request->merge([
            'is_active' => $request->is_active == 'on' ? 1 : 0,
        ]);
        
        ProductInventory::create($request->all());
        return redirect()->route('admin.inventory');
    }
    public function edit($id)
    {
        $productInventory = ProductInventory::find($id);
        $products = Product::all();
        return view('admin.inventory.edit', compact('productInventory','products'));
    }
    public function update(Request $request, $id){
        $request->validate(
            [
                'size' => 'required|string|max:256',
                'color' => 'required|string|max:512',
                'quantity' => 'required|numeric|min:1',
                'is_active' => 'in:on,off',
            ]
        );
        $request->merge([
            'is_active' => $request->is_active == 'on' ? 1 : 0,
        ]);
        try {
            ProductInventory::find($id)->update($request->all());    
        } catch (Exception $err) {
            return back()->withError('Can not update inventory, please try again.')->withInput();
        }
          
        return redirect()->route('admin.inventory');
    }
}
