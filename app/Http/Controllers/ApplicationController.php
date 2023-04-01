<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function home()
    {
        return view('web.home');
    }

    public function products()
    {
        return view('web.products');
    }

    public function orderTracking()
    {
        return view('web.order_tracking');
    }

    public function aboutUs()
    {
        return view('web.about_us');
    }

    public function contact()
    {
        return view('web.contact');
    }
}
