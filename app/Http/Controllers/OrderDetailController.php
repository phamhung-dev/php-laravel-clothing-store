<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    public function index(){
        $orderDetails = OrderDetail::with('User')
        ->with('Coupon')
        ->with('Payment')
        ->orderBy('created_at', 'desc')
        ->get();
        return view('admin.order_detail.list', compact('orderDetails'));
    }
}
