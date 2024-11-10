@extends('layouts.client')

@section('content')
    <main>
        <!-- breadcrumb area start -->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-wrap">
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Order </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb area end -->

        <!-- checkout main wrapper start -->
        <div class="checkout-page-wrapper section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- Checkout Login Coupon Accordion Start -->

                        <!-- Checkout Login Coupon Accordion End -->
                    </div>
                </div>
                @if (session('error'))
                <div class="alert alert-danger">
                  {{ session('error') }}
                </div>
            @endif
                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <!-- Checkout Billing Details -->
                        <div class="col-lg-6">
                            <div class="checkout-billing-details-wrap">
                                <h5 class="checkout-title">Billing Details</h5>
                                <div class="billing-form-wrap">
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                                    <div class="single-input-item">
                                        <label for="name" class="required">Tên người nhận</label>
                                        <input type="text"  name="name"
                                            placeholder="Nhập tên người nhận" value="{{ Auth::user()->name }}" />
                                        @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="single-input-item">
                                        <label for="email">Email</label>
                                        <input type="text"  name="email" placeholder="Email người nhận"
                                            value="{{ Auth::user()->email }}" />
                                        @error('email')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="single-input-item">
                                        <label for="phone">Số điện thoại</label>
                                        <input type="text" name="phone"
                                            placeholder="Số diện thoại người nhận" value="{{ Auth::user()->phone }}" />
                                        @error('phone')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="single-input-item">
                                        <label for="address">Địa chỉ</label>
                                        <input type="text" id="email" name="address" placeholder="Địa chỉ người nhận"
                                            value="{{ Auth::user()->address }}" />
                                        @error('address')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="single-input-item">
                                        <label for="ordernote">Nhập ghi chú</label>
                                        <textarea name="ordernote" id="ordernote" cols="30" rows="3"
                                            placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Order Summary Details -->
                        <div class="col-lg-6">
                            <div class="order-summary-details">
                                <h5 class="checkout-title">Đơn hàng của bạn</h5>
                                <div class="order-summary-content">
                                    <!-- Order Summary Table -->
                                    <div class="order-summary-table table-responsive text-center">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Sản Phẩm</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($cart as $key => $item)
                                                    <tr>
                                                        <td>
                                                            <a href="{{ route('clients.product.detail', $key) }}">
                                                                {{ $item['ten_san_pham'] }}
                                                                <strong> × {{ $item['so_luong'] }} </strong>
                                                            </a>
                                                        </td>
                                                        <td> {{ number_format($item['gia'] * $item['so_luong'], 0, '', '.') }}
                                                            VND</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td>Sub Total</td>
                                                    <td>
                                                        <strong>{{ number_format($subTotal, 0, '', '.') }} VND</strong>
                                                        <input type="hidden" name="gia" value="{{ $subTotal }}">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Shipping</td>
                                                    <td>
                                                        <strong>{{ number_format($shipping, 0, '', '.') }} VND</strong>
                                                        <input type="hidden" name="gia" value="{{ $shipping }}">
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>Total Amount</td>
                                                    <td><b class="text-danger">{{ number_format($total, 0, '', '.') }}
                                                            VND</b>
                                                        <input type="hidden" name="gia" value="{{ $total }}">

                                                    </td>

                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <!-- Order Payment Method -->
                                    <div class="order-payment-method">
                                        <div class="single-payment-method show">
                                            <div class="payment-method-name">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="cashon"value="cash"
                                                        class="custom-control-input" checked />
                                                    <label class="custom-control-label" for="cashon">Thanh toán khi giao
                                                        hàng</label>
                                                </div>
                                            </div>
                                            <div class="summary-footer-area">
                                                <div class="custom-control custom-checkbox mb-20">
                                                    <p>Thanh toán bằng tiền mặt khi giao hàng.</p></label>
                                                </div>
                                                <button type="submit" class="btn btn-sqr">Đặt hàng</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- checkout main wrapper end -->
    </main>
@endsection

@section('js')
    <script></script>
@endsection
