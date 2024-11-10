<?php

namespace App\Http\Controllers\Clients;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MyaccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $user = Auth::user();

        $orders = Order::where('user_id', $user->id)->get();

        $listCat = Categories::all();
        $user = Auth::user();
        return view('clients.my-account', compact(['user', 'listCat', 'orders'])) ;
    }

    public function edit (User $user, Request $request) {
        if ($request->isMethod('POST')) {
            // Xác thực dữ liệu đầu vào
            $request->validate([
                'name' => 'required|min:3',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'phone' => 'required|numeric|digits_between:10,15', // Xác thực số điện thoại
                'old_password' => 'required_with:password', // Chỉ yêu cầu nếu trường password có giá trị
                'password' => [
                    'nullable', // Cho phép password trống
                    'string',
                    'min:6', // Độ dài tối thiểu 6 ký tự
                ],
                'confirm_password' => 'same:password', // Không yêu cầu nhưng nếu có thì phải khớp với password
            ], [
                'required' => ':attribute bắt buộc phải nhập',
                'min' => ':attribute phải lớn hơn :min ký tự',
                'email' => ':attribute không đúng định dạng email',
                'unique' => ':attribute đã được sử dụng',
                'numeric' => ':attribute phải là số',
                'digits_between' => ':attribute phải có độ dài từ :min đến :max ký tự',
                'confirm_password.same' => 'Xác nhận mật khẩu không khớp',
                'required_with' => ':attribute bắt buộc khi có thay đổi mật khẩu mới',
            ], [
                'name' => 'Tên',
                'email' => 'Email',
                'phone' => 'Số điện thoại',
                'old_password' => 'Mật khẩu hiện tại',
                'password' => 'Mật khẩu mới',
                'confirm_password' => 'Xác nhận mật khẩu',
            ]);

            // Kiểm tra mật khẩu hiện tại nếu có yêu cầu thay đổi mật khẩu
            if ($request->filled('password') && !Hash::check($request->old_password, $user->password)) {
                return back()->withErrors(['old_password' => 'Mật khẩu hiện tại không đúng']);
            }

            // Lưu các thay đổi
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->address = $request->address;

            // Mã hóa mật khẩu mới nếu có
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            return back()->with('msg', 'Lưu thành công');
        }
    }


    public function logout()
    {


        Auth::logout();
        return redirect()->route('clients.login');
    }


    public function order_detail (Order $item) {

        $orderDetail = OrderDetail::where('order_id', $item->id)->get();
        $listCat = Categories::all();

        // dd($orderDetail);

        return view('clients.my-account-order', compact(['orderDetail', 'listCat']));


    }

}
