<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Coupon;
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
