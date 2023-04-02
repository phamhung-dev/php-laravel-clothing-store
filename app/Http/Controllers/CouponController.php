<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Exception;
use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
    //
    public function index(){
        $coupons = Coupon::all();
        return view('admin.coupon.list', compact('coupons'));
    }
    public function showCreateForm(){
        return view('admin.coupon.create');
    }
    public function create(Request $request){
        $request->validate(
            [
                'name' => 'required|string|max:256',
                'description' => 'nullable|string|max:512',
                'discount_percent' => 'required|numeric|min:0|max:100',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after:start_date',
                'is_active' => 'in:on,off',
            ]
        );
        $request->merge([
            'is_active' => $request->is_active == 'on' ? 1 : 0,
        ]);
        
        Coupon::create($request->all());
        return redirect()->route('admin.coupon');
    }
    public function edit($id)
    {
        $coupon = Coupon::find($id);
        return view('admin.coupon.edit',compact('coupon'));
    }

    public function applyCoupon(Request $request){
        $request->validate([
            'name' => 'required|string|max:32',
        ]);
        $status = 404;
        $message = 'Coupon does not exist.';
        $coupon = Coupon::where([
            ['name', $request->name],
            ['start_date', '<=', date('Y-m-d')],
            ['end_date', '>=', date('Y-m-d')],
            ['is_active', 1],
        ])->first();
        $user = User::find(Auth::user()->id);
        $cartItems = CartItem::where('user_id', $user->id)->get();
        $subtotal = $cartItems->sum(function($cartItem){
            $product = $cartItem->productInventory()->first()->product()->first();
            return $product->sell_price * (1 - $product->discount_percent / 100.0) * $cartItem->quantity;
        });
        $discount = 0;
        $total = $subtotal;
        if($coupon){
            $discount = $subtotal * $coupon->discount_percent / 100.0;
            $total = $subtotal - $discount;
            $status = 200;
            $message = 'Coupon applied.';
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => [
                'coupon_id' => $coupon->id ?? '',
                'subtotal' => $subtotal,
                'discount' => $discount,
                'total' => $total,
            ]
        ]);
    }
    
    public function update(Request $request, $id){
        $request->validate(
            [
                'name' => 'required|string|max:256',
                'description' => 'nullable|string|max:512',
                'discount_percent' => 'required|numeric|min:0|max:100',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after:start_date',
                'is_active' => 'in:on,off',
            ]
        );
        $request->merge([
            'is_active' => $request->is_active == 'on' ? 1 : 0,
        ]);
        try {
            Coupon::find($id)->update($request->all());    
        } catch (Exception $err) {
            return back()->withError('Can not update coupon, please try again.')->withInput();
        }
          
        return redirect()->route('admin.coupon');
    }
}
