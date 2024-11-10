{{-- @component('mail::massage') --}}
    #Xác nhận đơn hàng

    Xin chào {{$order->name}},

    Cảm ơn bạn đã đặt hàng từ cửa hàng của chúng tôi đây là thông tin đơn hàng của bạn

    ***Mã Đơn Hàng : ** {{$order->code}}

    ***Sản Phẩm Đã Đặt : **

    <table class="table table-bordered">

        <tr>
            <th>Tên sản phẩm</th>
            <th>Thành tiền</th>
        </tr>

    @foreach ($order->details as $item)
        <tr>
            <td>{{$item->product->ten_san_pham}} |{{$item->price}}  x {{$item->quantity}}|</td>
            <td>{{ number_format($item->price * $item->quantity) }} VNĐ</td>
        </tr>
    @endforeach

</table>


    ***Tổng tiền : ** {{ number_format($order->gia) }} VNĐ

    Chúng tôi sẽ liên hệ với bạn sớm nhất để xác nhận thông tin giao hàng.

    Cản ơn bạn đã đặt hàng của chúng tôi!

    Trân Trọng.
{{-- @endcomponent --}}
