<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\OrderDetail;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Exception;

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
        $users = User::user()->get();
        return view('admin.user.list', compact('users'));
    }
    public function showAdminUsers(){
        $users = User::admin()->get();
        return view('admin.admin_user.list', compact('users'));
    }
    public function showFormCreate(){
        return view('admin.admin_user.create');
    }

    public function updateAdminUser(Request $request, $id){
        $request->validate(
            [
                'first_name' => 'required|string|max:256',
                'last_name' => 'required|string|max:256',
                'avatar_upload' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'email' => 'required|string|email|max:256',
                'new_password' => 'nullable|string|min:8|max:32|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)(?=.*[@$!%*?&])[A-Za-z\\d@$!%*?&]{8,10}$/',
                'telephone' => 'required|string|min:10|max:10|regex:/^0[0-9]{9}$/',
                'apartment_number' => 'required|string|max:256',
                'street' => 'required|string|max:256',
                'ward' => 'required|string|max:256',
                'district' => 'required|string|max:256',
                'city' => 'required|string|max:256',
            ],
            [
                'new_password.regex' => 'Password must be at least 8 and up to 10 characters, one uppercase letter, one lowercase letter, one number and one special character.',
                'telephone.regex' => 'Telephone must be 10 digits and start with 0.',
            ]
        );
        if($request->avatar_upload != null){
            $request->merge([
                'avatar' => base64_encode(file_get_contents($request->file('avatar_upload')->path())),
                'is_admin' => 1
            ]);
        } else {
            $request->merge([
                'avatar' => null,
                'is_admin' => 1
            ]);
        }
        if($request->new_password != null) {
            $request->merge([
                'password' =>  bcrypt($request->new_password)
            ]);
        }
        try{
            User::find($id)->update($request->all());    
        }catch(Exception $e){
            return back()->withError('Can not update admin, please try again.')->withInput();
        }
          
        return redirect()
        ->route('admin.adminUser')
        ->with('success','User created successfully');
    }
    public function updateProfile(Request $request, $id){
        $request->validate(
            [
                'first_name' => 'required|string|max:256',
                'last_name' => 'required|string|max:256',
                'email' => 'required|string|email|max:256',
                'new_password' => 'nullable|string|min:8|max:32|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)(?=.*[@$!%*?&])[A-Za-z\\d@$!%*?&]{8,10}$/',
                'telephone' => 'required|string|min:10|max:10|regex:/^0[0-9]{9}$/',
                'apartment_number' => 'nullable|string|max:256',
                'street' => 'nullable|string|max:256',
                'ward' => 'nullable|string|max:256',
                'district' => 'nullable|string|max:256',
                'city' => 'nullable|string|max:256',
            ],
            [
                'new_password.regex' => 'Password must be at least 8 and up to 10 characters, one uppercase letter, one lowercase letter, one number and one special character.',
                'telephone.regex' => 'Telephone must be 10 digits and start with 0.',
            ]
        );
        if($request->new_password != null) {
            $request->merge([
                'password' =>  bcrypt($request->new_password),
                'is_admin' => 1

            ]);
        }
        try{
            User::find($id)->update($request->all());    
        }catch(Exception $e){
            return back()->withError('Can not update admin, please try again.')->withInput();
        }
          
        return redirect()
        ->route('admin.adminUser.profile')
        ->with('success','Updated successfully');
    }

    public function showAdminProfile(){
        $user = Auth::user();
        return view('admin.admin_user.profile', compact('user'));
    }
    public  function storeAdminUser(Request $request){
        $request->validate(
            [
                'first_name' => 'required|string|max:256',
                'last_name' => 'required|string|max:256',
                'avatar_upload' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'email' => 'required|string|email|max:256|unique:users',
                'password' => 'required|string|min:8|max:32|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)(?=.*[@$!%*?&])[A-Za-z\\d@$!%*?&]{8,10}$/',
                'retype_password' => 'required|string|min:8|max:32|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)(?=.*[@$!%*?&])[A-Za-z\\d@$!%*?&]{8,10}$/|same:password',
                'telephone' => 'required|string|min:10|max:10|unique:users|regex:/^0[0-9]{9}$/',
                'apartment_number' => 'required|string|max:256',
                'street' => 'required|string|max:256',
                'ward' => 'required|string|max:256',
                'district' => 'required|string|max:256',
                'city' => 'required|string|max:256',
            ],
            [
                'password.regex' => 'Password must be at least 8 and up to 10 characters, one uppercase letter, one lowercase letter, one number and one special character.',
                'retyped_password.regex' => 'Password must be at least 8 and up to 10 characters, one uppercase letter, one lowercase letter, one number and one special character.',
                'telephone.regex' => 'Telephone must be 10 digits and start with 0.',
            ]
        );
        if($request->avatar_upload){
            $request->merge([
                'password' => bcrypt($request->password),
                'avatar' => base64_encode(file_get_contents($request->file('avatar_upload')->path())),
                'is_admin' => 1
            ]);
        } else {
            $request->merge([
                'password' => bcrypt($request->password),
                'avatar' => null,
                'is_admin' => 1
            ]);
        }
        try{
            User::create($request->all());
        }catch(Exception $e){
            return back()->withError('Can not create admin, please try again.')->withInput();
        }
        return redirect()
        ->route('admin.adminUser')
        ->with('success','User created successfully');
    }
    public function editAdminUser($id)
    {
        $user = User::find($id);
        return view('admin.admin_user.edit',compact('user'));
    }
    public function showUserDetail($id){
        $user = User::find($id);
        $totalMoney = OrderDetail::where('status', 2)
                    ->where('user_id', $id)
                    ->sum('total');
        $totalPurchased = OrderDetail::where('status', 2)
        ->where('user_id', $id)
        ->count();
        $totalInOrder = OrderDetail::where('status', 1)
        ->where('user_id', $id)
        ->count();
        $orderDetails =OrderDetail::with('User')
        ->where('user_id', $id)
        ->get();
        $orderDetailIds = OrderDetail::where([['user_id' ,$id],['status',2]])->select('id')->get()->toArray();
        $orderItems = OrderItem::with('ProductInventory.Product')
        ->whereIn('order_detail_id',$orderDetailIds)->groupBy('product_inventory_id')->get();
        return view('admin.user.detail',compact('user','totalMoney','totalInOrder','totalPurchased','orderDetails','orderItems'));
    }
}
