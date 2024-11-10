@php
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

@endphp

@extends('layouts.admin')

@section('content')
<h1 class="mt-4">Tài khoản</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Tài khoản</li>
</ol>

<div class="card mb-4">
    <div class="card-header">
        Sửa Tài khoản
    </div>
    @if (session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
      @endif

      <form method="post">

        @csrf

        <div class="mb-3">
            <label class="mb-2">Tên</label>
            <input type="text" class="form-control" name="name" value={{ old('name') ?? $item->name }}>
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>


        <div class="mb-3">
            <label class="mb-2">Email</label>
            <input type="text" class="form-control" name="email" value={{ old('email') ?? $item->email }}>
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>


        <div class="mb-3">
            <label class="mb-2">Mật khẩu</label>
            <input type="text" class="form-control" name="password">
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>


        <div class="mb-3">
            <label class="mb-2">Quyền</label>
            <select name="permission" class="form-control">
                <option @checked(old('permission') ? old('permission') == true : $item->permission == true) value={{ true }}>Quản trị</option>
                <option @checked(old('permission') ? old('permission') == false : $item->permission == false) value={{ false }}>Người dùng</option>
            </select>
            @error('permission')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3 text-end">
            <button type="submit" class="btn btn-primary">Sửa</button>
        </div>


      </form>

</div>
@endsection
