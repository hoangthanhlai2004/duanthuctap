<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Comments;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BaoController extends Controller
{

    public function detail ($id) {
        $item = Product::find($id);

        $listCat = Categories::all();


        $comments = Comments::where('product_id', $id)->get();

        $countComments = Comments::where('product_id', $id)->count();

        $products = Product::where('categories_id', $item->categories_id)->get();

        return view('clients.products.detail', compact('item', 'comments', 'countComments', 'products', 'id', 'listCat'));

    }


    public function category ($id) {

        $listCat = Categories::all();

        $category = Categories::find($id);

        $product = Product::where('categories_id', $id)->get();

        return view('clients.products.categories', compact('listCat', 'category', 'product'));

    }


    public function comment (Request $request, $id) {

        if(!Auth::user()){
            return back()->with('msg', 'Vui lòng đăng nhập để đánh giá');
        }

        $request->validate([
            'noi_dung' => 'required',
        ], [
            'required' => 'Vui lòng nhập nội dung'
        ]);

        $item = new Comments();

        $item->user_id = Auth::user()->id;
        $item->product_id = $id;
        $item->noi_dung = $request->noi_dung;
        $item->thoi_gian = Carbon::now();

        $item->save();

        return back()->with('msg', 'Bình luận thành công');


    }


}
