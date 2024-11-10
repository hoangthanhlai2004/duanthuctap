@php
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
    
@endphp

@extends('layouts.admin')

@section('content')
<h1 class="mt-4">Products</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Product</li>
</ol>

<div class="card mb-4">
    <div class="card-header">

        Danh Sách Sản Phẩm
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
                <th style="width: 20%">Hình ảnh</th>
                <th style="width: 10%">Tên Sản Phẩm</th>
                <th style="width: 8%">Danh mục</th>
                <th style="width: 8%">Số Lượng</th>
                <th style="width: 10%">Giá Sản Phẩm</th>
                <th style="width: 11%">Giá Khuyến Mãi</th>
                <th style="width: 9%">Trạng Thái</th>
                <th style="width: 9%">Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listProduct as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td><img src="{{ asset('storage/'.$item->hinh_anh) }}" width="150px" alt=""></td>
                <td>{{ $item->ten_san_pham }}</td>
                <td>{{ $item->categories->name }}</td>
                <td>{{ $item->so_luong }}</td>
                <td>{{ $item->gia_san_pham }}$</td>
                <td>{{ $item->gia_khuyen_mai }}$</td>
                <td class="{{ $item->trang_thai == true ? 'text-success' : 'text-danger'}}">
                    {{ $item->trang_thai == true ? 'Còn hàng' : 'Hết hàng'}}
                </td>
                <td>
                    
                    <a href="{{ route('products.edit', $item->id) }}" class="btn btn-warning"><i class="fa fa-pencil-alt"></i></a>
                        <form action="{{ route('products.destroy', $item->id) }}" class="d-inline" method="POST"
                            onsubmit="return confirm('Bạn có đồng ý xóa hay không?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        </form>
                    
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
</div>
@endsection
