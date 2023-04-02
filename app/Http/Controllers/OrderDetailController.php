<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderDetail;
use App\Models\OrderItem;
use App\Models\User;

class OrderDetailController extends Controller
{
    public function orderDetail(Request $request){
        $request->validate([
            'order_id' => 'required|integer|exists:order_details,id',
            'email' => 'required|string|email|max:256|exists:users',
        ],
        [
            'order_id.exists' => 'Order detail does not exist.',
            'email.exists' => 'Account does not exist.',
        ]);
        $user = User::whereEmail($request->email)->first();
        $orderDetail = OrderDetail::whereId($request->order_id)->first();
        if($user->id == $orderDetail->user_id){
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
}
