@extends('layouts.admin')

@section('content')
<h1 class="mt-4">Xin chào {{ $user->name }}</h1>

@if (session('msg'))
    <div class="alert alert-success">{{ session('msg') }}</div>
@endif

<form method="post" action="{{ route('profile.edit', ['user'=>$user]) }}">

    @csrf

    <div class="form-group mb-3">
        <label>Họ và tên</label>
        <input type="text" name="name" class="form-control" value="{{ $user->name }}">
        @error('name')
            <span class="text-danger">{{ $message }}</span>
        @enderror
      </div>
    <div class="form-group mb-3">
      <label>Email</label>
      <input type="text" name="email" class="form-control" value="{{ $user->email }}">
      @error('email')
            <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>
    <div class="form-group mb-3">
        <label>Số điện thoại</label>
        <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
        @error('phone')
              <span class="text-danger">{{ $message }}</span>
        @enderror
      </div>
      <div class="form-group mb-3">
        <label>Mật khẩu (chỉ điền mật khẩu khi muốn sửa mật khẩu)</label>
        <input type="password" name="password" class="form-control" value="">
        @error('password')
              <span class="text-danger">{{ $message }}</span>
        @enderror
      </div>
    <div class="form-group mb-3">
        <label>Địa điểm</label>
        <input type="text" name="address" class="form-control" value="{{ $user->address }}">
        @error('address')
              <span class="text-danger">{{ $message }}</span>
        @enderror
      </div>
    <button type="submit" class="btn btn-primary">Lưu</button>

</form>

@endsection
