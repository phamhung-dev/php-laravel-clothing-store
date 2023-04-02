<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\ProductInventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartItemController extends Controller
{
    public function addToCart(Request $request){
        $request->validate([
            'id' => 'required|integer',
            'size' => 'required|string',
            'color' => 'required|string',
            'quantity' => 'required|integer'
        ]);
        $message = 'Product with this size and color are not available.';
        $status = 404;
        $productInventory = ProductInventory::where([
            ['product_id', $request->id],
            ['size', $request->size],
            ['color', $request->color]
        ])->first();
        if($productInventory){
            if($productInventory->quantity < $request->quantity || $request->quantity < 1){
                $message = 'Quantity is invalid or product with this size and color are not available.';
            }
            else{
                $cartItem = CartItem::where([
                    ['user_id', Auth::user()->id],
                    ['product_inventory_id', $productInventory->id]
                ])->first();
                if($cartItem){
                    $cartItem->quantity = $request->quantity;
                    $cartItem->save();
                    $message = 'Product with this size and color are already in your cart. Quantity updated.';
                }
                else{
                    $cartItem = new CartItem();
                    $cartItem->user_id = Auth::user()->id;
                    $cartItem->product_inventory_id = $productInventory->id;
                    $cartItem->quantity = $request->quantity;
                    $cartItem->save();
                    $message = 'Product with this size and color added to your cart.';
                }
                $status = 200;
            }
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
        ]);
    }

    public function myCart(Request $request){
        $cartItems = CartItem::with('productInventory', 'productInventory.product')->where('user_id', Auth::user()->id)->get();
        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $cartItems,
        ]);
    }

    public function removeCartItem(Request $request){
        $request->validate([
            'id' => 'required|integer',
        ]);
        $message = 'Not found product.';
        $status = 404;
        $productInventory = ProductInventory::find($request->id);
        if($productInventory){
            $cartItem = CartItem::where([
                ['user_id', Auth::user()->id],
                ['product_inventory_id', $productInventory->id]
            ])->first();
            if($cartItem){
                $cartItem->delete();
                $message = 'Product removed from your cart.';
            }
            else{
                $message = 'Product is not in your cart.';
            }
            $status = 200;
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
        ]);
    }
}
