<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Coupon;
use App\Models\OrderDetail;
use App\Models\Payment;
use Exception;
use Illuminate\Http\Request;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class OrderDetailController extends Controller
{
    public function orderDetail(Request $request)
    {
        $request->validate(
            [
                'order_id' => 'required|integer|exists:order_details,id',
                'email' => 'required|string|email|max:256|exists:users',
            ],
            [
                'order_id.exists' => 'Order detail does not exist.',
                'email.exists' => 'Account does not exist.',
            ]
        );
        $user = User::whereEmail($request->email)->first();
        $orderDetail = OrderDetail::whereId($request->order_id)->first();
        if ($user->id == $orderDetail->user_id) {
            $orderItems = OrderItem::whereOrderDetailId($orderDetail->id)->get();
            return view('web.order_detail')->with([
                'orderDetail' => $orderDetail,
                'orderItems' => $orderItems,
            ]);
        }
        return redirect()->back()->withErrors([
            'error' => 'No order detail found.'
        ]);
    }
    public function index()
    {
        $orderDetails = OrderDetail::with('User')
            ->with('Coupon')
            ->with('Payment')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.order_detail.list', compact('orderDetails'));
    }

    public function userOrderDetail(Request $request){
        $request->validate([
            'id' => 'required|integer',
        ]);
        $orderDetail = OrderDetail::where([
                ['id', $request->id],
                ['user_id', Auth::user()->id],
            ])->first();
        if($orderDetail){
            $orderItems = OrderItem::whereOrderDetailId($orderDetail->id)->get();
            return view('web.user.order_detail')->with([
                'orderDetail' => $orderDetail,
                'orderItems' => $orderItems,
            ]);
        }
        return abort(404);
    }

    public function checkout(){
        $user = User::find(Auth::user()->id);
        $cartItems = CartItem::where('user_id', $user->id)->get();
        if($cartItems->count() == 0){
            return redirect()->route('products');
        }
        $subtotal = $cartItems->sum(function($cartItem){
            $product = $cartItem->productInventory()->first()->product()->first();
            return $product->sell_price * (1 - $product->discount_percent / 100.0) * $cartItem->quantity;
        });
        $total = $subtotal;
        $payments = Payment::all();
        return view('web.user.checkout')->with([
            'user' => $user,
            'cartItems' => $cartItems,
            'subtotal' => $subtotal,
            'total' => $total,
            'payments' => $payments,
        ]);
    }

    public function handleCheckout(Request $request){
        $request->validate([
            'coupon_id' => 'nullable|integer|exists:coupons,id',
            'payment_id' => 'required|integer|exists:payments,id',
            'note' => 'nullable|string|max:512',
            'apartment_number' => 'required|string|max:256',
            'street' => 'required|string|max:256',
            'ward' => 'required|string|max:256',
            'district' => 'required|string|max:256',
            'city' => 'required|string|max:256',
            'telephone' => 'required|string|min:10|max:10|regex:/^0[0-9]{9}$/',
        ],
        [
            'telephone.regex' => 'Telephone must be 10 digits and start with 0.',
        ]);
        $user = User::find(Auth::user()->id);
        $cartItems = CartItem::where('user_id', $user->id)->get();
        $subtotal = $cartItems->sum(function($cartItem){
            $product = $cartItem->productInventory()->first()->product()->first();
            return $product->sell_price * (1 - $product->discount_percent / 100.0) * $cartItem->quantity;
        });
        $coupon = Coupon::where([
            ['id', $request->coupon_id],
            ['is_active', 1],
        ])->first();
        $total = $subtotal;
        $checkCartItems = $this->checkCartItems($cartItems);
        if(($coupon || !$request->coupon_id || $request->coupon_id == '') && $checkCartItems){
            $discount_percent =  $coupon->discount_percent ?? 0;
            $total = $subtotal * (1 - $discount_percent / 100.0);
            $request->merge([
                'user_id' => $user->id,
                'subtotal' => $subtotal,
                'total' => $total,
                'status' => 1,
            ]);
            $orderDetail = OrderDetail::create($request->all());
            foreach($cartItems as $cartItem){
                $product = $cartItem->productInventory()->first()->product()->first();
                OrderItem::create([
                    'product_inventory_id' => $cartItem->product_inventory_id,
                    'order_detail_id' => $orderDetail->id,
                    'price' => $product->sell_price * (1 - $product->discount_percent / 100.0),
                    'discount_percent' => $product->discount_percent,
                    'quantity' => $cartItem->quantity,
                ]);
                $productInventory = $cartItem->productInventory()->first();
                $productInventory->quantity -= $cartItem->quantity;
                $productInventory->save();
                $cartItem->delete();
            }
            return redirect()->route('user.my-cart.checkout-success');
        }
        $response = [];
        if(!$coupon && $request->coupon_id && $request->coupon_id != ''){
            $response['coupon_id'] = 'Coupon is not valid.';
        }
        if(!$checkCartItems){
            $response['cart_items'] = 'Some products are out of stock.';
        }
        return redirect()->back()->withErrors($response);
    }

    public function checkoutSuccess(){
        return view('web.user.checkout_success');
    }

    private function checkCartItems($cartItems){
        foreach($cartItems as $cartItem){
            $productInventory = $cartItem->productInventory()->first();
            if($productInventory->quantity < $cartItem->quantity){
                return false;
            }
        }
        return true;
    }
    
    public function showOrderDetailInfo($id)
    {
        try {
            $orderDetail = OrderDetail::with('User')
                ->with('Coupon')
                ->where('id', $id)
                ->first();
            $orderItems = OrderItem::with('ProductInventory.Product')
                ->where('order_detail_id', $id)
                ->get();
            return  view('admin.order_detail.edit', compact('orderDetail', 'orderItems'));
        } catch (Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }
    }
    public function updateOrderStatus(Request $request){
        try {
            $orderDetail = OrderDetail::find($request->id);
            $orderDetail->status = $request->status;
            $orderDetail->save();
            return redirect()
            ->route('admin.order')
            ->with('success','Update status successfully');
        } catch (Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }
    }
}
