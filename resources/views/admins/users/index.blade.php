@php
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

@endphp

@extends('layouts.admin')

@section('content')
<h1 class="mt-4">Tài khoản</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Tài khoản</li>
</ol>

<div class="card mb-4">
    <div class="card-header">
        Danh Sách Tài khoản
    </div>
    @if (session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
      @endif
      <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th style="width: 5%">STT</th>
                <th style="">Tên</th>
                <th style="">Email</th>
                <th style="">Quyền</th>
                <th style="">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td>@if ($item->permission)
                    <span class="text-danger">quản trị</span>
                @else
                    <span class="text-primary">người dùng</span>
                @endif</td>
                <td>
                    <a href="{{ route('users.edit', ['item' => $item]) }}" class="btn btn-warning">Sửa</a>
                    @if (Auth::user()->id != $item->id)
                    |
                    <a href="{{ route('users.delete', ['item' => $item]) }}" class="btn btn-danger">Xóa</a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
