@extends('layouts.client')

@section('content')


    <!-- hot deals area start -->
    <section class="hot-deals section-padding pt-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- section title start -->
                    <div class="section-title text-center">
                        <h2 class="title">Danh mục {{ $category->name }}</h2>
                        <p class="sub-title">Add featured products to weekly lineup</p>
                    </div>
                    <!-- section title start -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="deals-carousel-active--two slick-row-10 slick-arrow-style">
                        <!-- hot deals item start -->
                        @foreach ($product as $item)
                            <div class="hot-deals-item product-item">
                                <figure class="product-thumb">
                                    <a href="product-details.html">
                                        <img height="200px" src="{{ Storage::url($item->hinh_anh) }}" alt="product">
                                    </a>
                                    <div class="product-badge">
                                        <div class="product-label new">
                                            <span>sale</span>
                                        </div>
                                        <div class="product-label discount">
                                            <span>new</span>
                                        </div>
                                    </div>
                                    <div class="button-group">
                                        <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left"
                                            title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                        <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left"
                                            title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span
                                                data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i
                                                    class="pe-7s-search"></i></span></a>
                                    </div>

                                </figure>
                                <div class="product-caption">
                                    <div class="product-identity">
                                        <p class="manufacturer-name"><a href="product-details.html">Gold</a></p>
                                    </div>
                                    <h6 class="product-name">
                                        <a href="{{ route('clients.product.detail', ['id' => $item->id]) }}">{{ $item->ten_san_pham }}</a>
                                    </h6>
                                    <div class="price-box">
                                        <span class="price-regular">{{ $item->gia_san_pham }}</span>
                                        <span class="price-old"><del>{{ $item->gia_san_pham }}</del></span>
                                    </div>
                                    <div class="product-countdown product-countdown--style-two"
                                        data-countdown="2022/11/25">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!-- hot deals item end -->

@endsection
