@extends('layouts.admin')

@section('content')
  
        <div class="row">
            <div class="col-md-6">
                <h3>Thông tin khách hàng</h3>
                <table class="table">
                    <thead>
                       
                        <tr>
                            <th>Họ tên: </th>
                            <td>{{ $order->name }}</td>
                        </tr>
                        <tr>
                            <th>Phone: </th>
                            <td>{{ $order->phone }}</td>
                        </tr>
                        <tr>
                            <th>Địa chỉ: </th>
                            <td>{{ $order->address }}</td>
                        </tr>
                      
                    </thead>
                </table>
            </div>
            <div class="col-md-6">
                <h3>Thông tin giao hàng</h3>
                <table class="table">
                    <thead>
                        
                        <tr>
                            <th>Họ tên: </th>
                            <td>{{ $order->name }}</td>
                        </tr>
                        <tr>
                            <th>Phone: </th>
                            <td>{{ $order->phone }}</td>
                        </tr>
                        <tr>
                            <th>Địa chỉ: </th>
                            <td>{{ $order->address }}</td>
                        </tr>
                       
                    </thead>
                </table>
            </div>
        </div>
        <h3>Thông tin sản phẩm</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã sản phẩm</th>
                    <th>Ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Tổng</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->details as $index => $item)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $item->product->ma_san_pham }}</td>
                        <td><img src="{{ Storage::url($item->product->hinh_anh) }}" width="150"></td>
                        <td>{{ $item->product->ten_san_pham }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->price) }}</td>
                        <td>{{ number_format($item->price * $item->quantity) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
@endsection
