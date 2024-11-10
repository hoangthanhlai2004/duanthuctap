@php
use Illuminate\Support\Carbon;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Storage;

@endphp


@extends('layouts.client')

@section('content')
           <!-- breadcrumb area start -->
           <div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-wrap">
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                                    <li class="breadcrumb-item active" aria-current="page">my-account</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb area end -->

        <!-- my account wrapper start -->
        <div class="my-account-wrapper section-padding">

            @session('msg')
                <div class="alert alert-success">{{ session('msg') }}</div>
            @endsession

            <div class="container">
                <div class="section-bg-color">
                    @if (session('msg'))
                    <div class="alert alert-success">{{ session('msg') }}</div>
                @endif
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- My Account Page Start -->
                            <div class="myaccount-page-wrapper">
                                <!-- My Account Tab Menu Start -->
                                <div class="row">
                                    <div class="col-lg-3 col-md-4">

                                        <div class="myaccount-tab-menu nav" role="tablist">
                                            <a href="#orders" class="active" data-bs-toggle="tab"><i class="fa fa-dashboard"></i>
                                                Dashboard</a>

                                            {{-- <a href="#download" data-bs-toggle="tab"><i class="fa fa-cloud-download"></i>
                                                Download</a> --}}
                                            {{-- <a href="#payment-method" data-bs-toggle="tab"><i class="fa fa-credit-card"></i>
                                                Payment
                                                Method</a> --}}

                                            <a href="{{ route('clients.my-account') }}">Tài khoản</a>
                                            <a href="{{ route('clients.logout') }}"><i class="fa fa-sign-out"></i> Logout</a>
                                        </div>
                                    </div>

                                    <!-- My Account Tab Menu End -->

                                    <!-- My Account Tab Content Start -->
                                    <div class="col-lg-9 col-md-8">
                                        <div class="tab-content" id="myaccountContent">


                                            <!-- Single Tab Content Start -->
                                            <div class="tab-pane fade  show active" id="orders" role="tabpanel">
                                                <div class="myaccount-content">
                                                    <h5>Orders</h5>
                                                    <div class="myaccount-table table-responsive text-center">
                                                        <table class="table table-bordered">
                                                            <thead class="thead-light">
                                                                <tr>
                                                                    <th>Sản phẩm</th>
                                                                    <th>Giá</th>
                                                                    <th>Số lượng</th>
                                                                    <th>Total</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                @foreach ($orderDetail as $key => $item)


                                                                <tr>
                                                                    <td>{{ $item->product->name }}
                                                                        <img width="90%" src="{{ Storage::url($item->product->hinh_anh) }}" alt="Error">
                                                                    </td>
                                                                    <td>{{ $item->price }}</td>
                                                                    <td>{{ $item->quantity }}</td>
                                                                    <td>
                                                                        @php

                                                                            $total = $item->price * $item->quantity;

                                                                            echo $total;

                                                                        @endphp
                                                                    </td>

                                                                </tr>
                                                                @endforeach

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Single Tab Content End -->

                                        </div>
                                    </div> <!-- My Account Tab Content End -->
                                </div>
                            </div> <!-- My Account Page End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- my account wrapper end -->
    </main>

    <!-- Scroll to top start -->
    <div class="scroll-top not-visible">
        <i class="fa fa-angle-up"></i>
    </div>
    <!-- Scroll to Top End -->

@endsection
