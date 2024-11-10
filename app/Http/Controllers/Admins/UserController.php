<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index () {

        $users = User::all();

        return view('admins.users.index', compact(['users']));


    }


    public function records () {

        $users = User::onlyTrashed()->get();

        return view('admins.users.records', compact(['users']));


    }



        public function add () {

            return view('admins.users.add');


    }


    public function store (Request $request) {



        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ], [
            'required' => ':attribute bắt buộc phải nhập',
            'email' => ':attribute bắt buộc phải là email',
            'unique' => ':attribute đã có tài khoản sử dụng',
        ], [
            'name' => 'Tên',
            'email' => 'Email',
            'password' => 'Mật khẩu'
        ]);


        $item = new User();

        $item->name = $request->name;
        $item->email = $request->email;
        $item->password = Hash::make($request->password);
        $item->permission = $request->permission;

        $item->save();

        return redirect()->route('users.index')->with('success', 'Thêm người dùng thành công.');

    }


    public function edit (User $item, Request $request) {


        return view('admins.users.edit', compact(['item']));


    }



    public function update (User $item, Request $request) {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$item->id,
        ], [
            'required' => ':attribute bắt buộc phải nhập',
            'email' => ':attribute bắt buộc phải là email',
            'unique' => ':attribute đã có tài khoản sử dụng',
        ], [
            'name' => 'Tên',
            'email' => 'Email',
            'password' => 'Mật khẩu'
        ]);


        $item->name = $request->name;
        $item->email = $request->email;
        if($request->password){
            $item->password = Hash::make($request->password);
        }
        $item->permission = $request->permission;

        $item->save();

        return redirect()->route('users.index')->with('success', 'Sửa người dùng thành công.');

    }


    public function delete (User $item) {

        $record = User::find($item->id);
        $record->delete();

        return redirect()->route('users.index')->with('success', 'Xóa người dùng thành công.');

    }

    public function again ($id) {

        $record = User::withTrashed()->find($id);
        $record->delete();

        return redirect()->route('users.index')->with('success', 'Khôi phục người dùng thành công.');

    }

    public function record ($id) {

        $record = User::withTrashed()->find($id);
        $record->delete();

        return redirect()->route('users.index')->with('success', 'Xóa người dùng thành công.');

    }


}
