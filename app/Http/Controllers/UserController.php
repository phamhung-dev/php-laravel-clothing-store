<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\OrderDetail;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function myAccount()
    {
        $orders = OrderDetail::where('user_id', Auth::user()->id)->get();
        $user = User::find(Auth::user()->id);
        return view('web.user.my_account')->with([
            'orders' => $orders,
            'user' => $user,
        ]);
    }

    public function updateAccount(Request $request)
    {
        $request->validate(
            [
                'upload' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'gender' => 'required|in:1,0',
                'first_name' => 'required|string|max:256',
                'last_name' => 'required|string|max:256',
                'birthdate' => 'required|date|before:'.now()->subYears(18)->toDateString(),
                'password' => 'nullable|string|min:8|max:32|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)(?=.*[@$!%*?&])[A-Za-z\\d@$!%*?&]{8,10}$/',
                'apartment_number' => 'required|string|max:256',
                'street' => 'required|string|max:256',
                'ward' => 'required|string|max:256',
                'district' => 'required|string|max:256',
                'city' => 'required|string|max:256',
                'receive_newsletter' => 'in:on,off',
                'receive_offers' => 'in:on,off',
            ],
            [
                'password.regex' => 'Password must be at least 8 and up to 10 characters, one uppercase letter, one lowercase letter, one number and one special character.',
                'telephone.regex' => 'Telephone must be 10 digits and start with 0.',
            ]
        );
        $request->merge([
            'avatar' => $request->file('upload') ? base64_encode(file_get_contents($request->file('upload')->path())) : Auth::user()->avatar,
            'password' => $request->password ? bcrypt($request->password) : Auth::user()->password,
            'receive_newsletter' => $request->receive_newsletter == 'on' ? 1 : 0,
            'receive_offers' => $request->receive_offers == 'on' ? 1 : 0,
        ]);
        User::find(Auth::user()->id)->update($request->all());
        return redirect()->route('user.my-account');
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
