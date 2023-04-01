<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
