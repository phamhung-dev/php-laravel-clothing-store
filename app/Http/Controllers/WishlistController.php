<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function addToWishlist(Request $request){
        $request->validate([
            'id' => 'required|integer',
        ]);
        $message = 'Not found product.';
        $status = 404;
        $product = Product::active()->find($request->id);
        if($product){
            $wishlist = Wishlist::where([
                ['user_id', Auth::user()->id],
                ['product_id', $product->id]
            ])->first();
            if($wishlist){
                $message = 'Product is already in your wishlist.';
            }
            else{
                $wishlist = new Wishlist();
                $wishlist->user_id = Auth::user()->id;
                $wishlist->product_id = $product->id;
                $wishlist->save();
                $message = 'Product added to your wishlist.';
            }
            $status = 200;
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
        ]);
    }

    public function myWishlist(Request $request){
        $wishlists = Wishlist::with('product')->where('user_id', Auth::user()->id)->get();
        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $wishlists,
        ]);
    }

    public function removeWishlist(Request $request){
        $request->validate([
            'id' => 'required|integer',
        ]);
        $message = 'Not found product.';
        $status = 404;
        $product = Product::active()->find($request->id);
        if($product){
            $wishlist = Wishlist::where([
                ['user_id', Auth::user()->id],
                ['product_id', $product->id]
            ])->first();
            if($wishlist){
                $wishlist->delete();
                $message = 'Product removed from your wishlist.';
            }
            else{
                $message = 'Product is not in your wishlist.';
            }
            $status = 200;
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
        ]);
    }
}
