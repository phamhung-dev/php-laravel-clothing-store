<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\OrderDetail;
use App\Models\OrderItem;


class UserController extends Controller
{
    public function myAccount()
    {
        return view('web.user.my_account');
    }

    public function myCart()
    {
        return view('web.user.my_cart');
    }

    public function myWishlist()
    {
        return view('web.user.my_wishlist');
    }

    public function dashboard()
    {
        $totalUser = User::where('is_admin', '=', '0')->count();
        $totalProduct = Product::count();
        $totalOrderDetail = OrderDetail::count();
        $totalMoney = OrderDetail::where('status', '2')->sum('total');
        $listSumByMonth = collect();
        $year = date('Y');
        for ($i = 0; $i < 12; $i++) {
            $total = OrderDetail::where('status', '=', '2')
                ->whereYear('created_at', '=', $year)
                ->whereMonth('created_at', '=', $i)
                ->sum('total');
            $listSumByMonth->push($total);
        }

        $listCountOrderByStatus = collect();
        for ($i = 0; $i < 3; $i++) {
            $statusCount = OrderDetail::where('status', '=', $i)
                ->count();
            $listCountOrderByStatus->push($statusCount);
        }
        $listTop5OrderItems = OrderItem::with('ProductInventory.Product')
        ->with('OrderDetail')
        ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        return view('admin.dashboard', compact('totalUser', 'totalProduct', 'totalOrderDetail', 'totalMoney', 'listSumByMonth', 'listCountOrderByStatus','listTop5OrderItems'));
    }
    public function showUsers(){
        $users = User::all();
        return view('admin.user.list', compact('users'));
    }
}
