<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ApplicationController extends Controller
{
    private const PERPAGE = 12;
    public function home()
    {
        $newArrivalProducts = Product::active()->orderBy('created_at', 'desc')->take(4)->get();
        $saleProducts = Product::active()->where('discount_percent', '>', 0)->orderBy('discount_percent', 'desc')->take(4)->get();
        return view('web.home')->with([
            'newArrivalProducts' => $newArrivalProducts,
            'saleProducts' => $saleProducts,
        ]);
    }

    public function products(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string',
            'filter' => 'nullable|in:all,newArrival,onSale,pant,shirt',
            'sort' => 'nullable|in:newest,priceLow,priceHigh',
            'page' => 'nullable|integer|min:1',
        ]);
        $request->filter = $request->filter ?? 'all';
        $request->sort = $request->sort ?? 'newest';
        $request->page = $request->page ?? 1;
        $products = Product::active();
        $products = ($request->name && $request != '') ? $products->whereRaw("lower(name) like '%". strtolower($request->name) ."%'") : $products;
        switch($request->filter){
            case 'newArrival':
                $products = $products->orderBy('created_at', 'desc');
                break;
            case 'onSale':
                $products = $products->where('discount_percent', '>', 0)->orderBy('discount_percent', 'desc');
                break;
            case 'pant':
                $productCategory = ProductCategory::where('name', 'Pant')->first();
                $products = $products->where('product_category_id', $productCategory->id);
                break;
            case 'shirt':
                $productCategory = ProductCategory::where('name', 'Shirt')->first();
                $products = $products->where('product_category_id', $productCategory->id);
                break;
        }
        $price = DB::raw('sell_price * (1 - discount_percent / 100.0)');
        switch($request->sort){
            case 'priceLow':
                $products = $products->orderBy($price, 'desc');
                break;
            case 'priceHigh':
                $products = $products->orderBy($price, 'asc');
                break;
            default:
                $products = $products->orderBy('created_at', 'desc');
        }
        $products = $products->skip(($request->page - 1) * $this::PERPAGE)->take($this::PERPAGE)->get();
        $totalPage = ceil($products->count() / $this::PERPAGE);
        return view('web.products')->with([
            'products' => $products,
            'filter' => $request->filter,
            'sort' => $request->sort,
            'page' => $request->page,
            'totalPage' => $totalPage,
        ]);
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
