<?php

namespace App\Http\Controllers\Admins;

use App\Models\User;
use App\Models\Product;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comments;
use App\Models\Order;

class ThongKeController extends Controller
{
    //
    public function index()
    {
        $category_count = Categories::count();
        $product_count = Product::count();
        $user_count = User::count();
        $comment_count = Comments::count();
        $order = Order::where('status',0)->get();

        if (request()->date_from && request()->date_to) {
            # code...
            $order = Order::where('status',0)
            ->whereBetween('created_at',[request()->date_from,request()->date_to])->get();
        }
        return view('admins.thongke.index',compact('product_count','category_count','user_count','comment_count','order'));
    }
}
