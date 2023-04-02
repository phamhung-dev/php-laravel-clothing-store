<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use Exception;
use Illuminate\Http\Request;
use App\Models\OrderItem;
use App\Models\User;

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
