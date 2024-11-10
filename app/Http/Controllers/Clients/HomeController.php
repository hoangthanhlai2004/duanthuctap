<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
    public function index(Request $request)
    {
        $search = $request->input('search');
        $listCat = Categories::where('active',1)->orderBy('name','ASC')->get();

        if($search){
            // DB::enableQueryLog();
            $listProduct = Product::where('ten_san_pham', 'like', '%'.$search.'%')->get();
            // dd(DB::getQueryLog());
        }else{
            $listProduct = Product::all();
        }

        $product = Product::orderBy('luot_xem', 'desc')->get();
        return view('clients.index',compact('listCat','listProduct','product'));
    }
}
