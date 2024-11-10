<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index () {

        $user = Auth::user();

        return view('admins.profile.index', compact(['user']));

    }

    public function edit (User $user, Request $request) {

        $request->validate([
            'email' => 'required|email|unique:users,email,'.$user->id,
            'name' => 'required|min:3',
            'phone' => 'required|regex:/^0[0-9]{9}$/',
            'address' => 'required'
        ], [
            'required' => ':attribute bắt buộc phải nhập',
            'min' => ':attribute phải lớn hơn :min',
            'email' => ':attribute không đúng định dạng email',
            'unique' => ':attribute đã được sử dụng',
            'phone.regex' => 'Số điện thoại phải đúng định dạng'
        ], [
            'name' => 'Tên',
            'email' => 'Email',
            'phone' => 'Số điện thoại',
            'address' => 'Địa điểm'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if($request->password){
            $user->password = Hash::make($request->password);
        }

        $user->address = $request->address;

        $user->save();

        return back()->with('msg', 'Lưu thành công');

    }

}
