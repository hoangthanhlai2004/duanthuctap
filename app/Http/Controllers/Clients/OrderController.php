<?php

namespace App\Http\Controllers\Clients;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\OrderRequest;
use App\Http\Controllers\Controller;
use App\Mail\OrderConfirm;
use App\Models\Categories;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {


        $listCat = Categories::all();

        $cart = session()->get('cart',[]);
        if (!empty($cart)) {

            $total = 0;
            $subTotal = 0;

            foreach ($cart as $item ) {
                $subTotal +=  $item['gia'] * $item['so_luong'];
            }

            $shipping = 30000;
            $total = $subTotal + $shipping;


            return view('clients.order.create',compact('cart','total','subTotal','shipping','total', 'listCat'));
        }
        return redirect()->route('clients.my-account');

    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(OrderRequest $request)
    // {


    //     // dd($request->all());
    //     if ($request->method('POST')) {
    //         DB::beginTransaction();
    //         try {
    //             $params = $request->except('_token');
    //             $params['code'] = $this->generateUniqueOrderCode();
    //             $order = Order::query()->create($params);
    //             $orderID = $order->id;

    //             $carts = session()->get('cart',[]);

    //             foreach ($carts as $key => $item ) {
    //                 $thanhTien = $item['gia'] * $item['so_luong'];

    //                 $order->details()->create([
    //                     'order_id'=> $orderID,
    //                     'product_id' =>$key,
    //                     'price'      =>$item['gia'],
    //                     'quantity'   =>$item['so_luong'],
    //                     'thanh_tien' =>$thanhTien,
    //                 ]);
    //             }
    //             DB::commit();

    //             dd($params);
    //             //khi thêm thành công thì sẽ thực hiện công việc đưới
    //             //Trừ đi số lượng sản phẩm

    //             //Gửi mail đặt hàng thành công
    //             Mail::to($order->email)->queue(new OrderConfirm($order));
    //             session()->put('cart',[]);
    //             return redirect()->route('clients.order.index')->with('success', 'Đơn hàng đã được tạo thành công!');


    //         } catch (\Exception $th) {
    //             DB::rollBack();
    //             return redirect()->route('clients.cart.list')->with('error', 'Có lỗi khi tạo đơn hàng. Vui lòng thử lại sau');
    //         }
    //     }
    // }


  public function store(OrderRequest $request){


    $order = new Order();

    $order->user_id = Auth::user()->id;
    $order->code = rand(10000000, 90000000);
    $order->name = $request->name;
    $order->email = $request->email;
    $order->phone = $request->phone;
    $order->address = $request->address;
    if($request->ordernote){
        $order->description = $request->ordernote;
    }else{
        $order->description = 'Đơn hàng mới';
    }

    $order->save();

    $carts = session()->get('cart');



   foreach ($carts as $key => $value) {

        $item = new OrderDetail();

        $item->order_id = $order->id;
        $item->product_id = $key;
        $item->price = $value['gia'];
        $item->quantity = $value['so_luong'];

        $item->save();



    }


    Mail::to($request->email)->send(new OrderConfirm($order));
    session()->put('cart',[]);
    return redirect()->route('clients.my-account')->with('success', 'Đơn hàng đã được tạo thành công!');

  }


    // public function generateUniqueOrderCode(){
    //     do {
    //         $orderCode = 'ORD-' . Auth::id() . '-' . now()->timestamp;
    //     } while (Order::where('code' , $orderCode)->exit());

    //     return $orderCode;
    // }
}
