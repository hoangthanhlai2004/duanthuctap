@extends('layouts.client')

@section('content')
    <section class="slider-area hero-style-five">
        <div class="hero-slider-active slick-arrow-style slick-arrow-style_hero slick-dot-style">
            <!-- single slider item start -->
            <div class="hero-single-slide hero-overlay">
                <div class="hero-slider-item bg-img" data-bg="{{ asset('assets/clients/img/slider/1.jpg') }}">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="hero-slider-content slide-1">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- single slider item start -->

            <!-- single slider item start -->
            <div class="hero-single-slide hero-overlay">
                <div class="hero-slider-item bg-img" data-bg="{{ asset('assets/clients/img/slider/2.jpg') }}">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="hero-slider-content slide-2 float-md-end float-none">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- single slider item start -->

            <!-- single slider item start -->
            <div class="hero-single-slide hero-overlay">
                <div class="hero-slider-item bg-img" data-bg="{{ asset('assets/clients/img/slider/3.jpg') }}">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="hero-slider-content slide-3">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- single slider item end -->
        </div>
    </section>
    <!-- hero slider area end -->

    <!-- service policy area start -->
    <div class="service-policy">
        <div class="container">
            <div class="policy-block section-padding">
                <div class="row mtn-30">
                    <div class="col-sm-6 col-lg-3">
                        <div class="policy-item">
                            <div class="policy-icon">
                                <i class="pe-7s-plane"></i>
                            </div>
                            <div class="policy-content">
                                <h6>Free Shipping</h6>
                                <p>Free shipping all order</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="policy-item">
                            <div class="policy-icon">
                                <i class="pe-7s-help2"></i>
                            </div>
                            <div class="policy-content">
                                <h6>Support 24/7</h6>
                                <p>Support 24 hours a day</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="policy-item">
                            <div class="policy-icon">
                                <i class="pe-7s-back"></i>
                            </div>
                            <div class="policy-content">
                                <h6>Money Return</h6>
                                <p>30 days for free return</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="policy-item">
                            <div class="policy-icon">
                                <i class="pe-7s-credit"></i>
                            </div>
                            <div class="policy-content">
                                <h6>100% Payment Secure</h6>
                                <p>We ensure secure payment</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- service policy area end -->

    <!-- product area start -->
    <section class="product-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- section title start -->
                    <div class="section-title text-center">
                        <h2 class="title">Sản phẩm @if (!empty($_GET['search']))
                            theo tìm kiếm
                        @endif</h2>
                        <p class="sub-title">Add our products to weekly lineup</p>
                    </div>
                    <!-- section title start -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-container">
                        <!-- product tab menu start -->
                        <div class="product-tab-menu">
                            <ul class="nav justify-content-center">
                                <li><a href="#tab1" class="active" data-bs-toggle="tab">Entertainment</a></li>
                                <li><a href="#tab2" data-bs-toggle="tab">Storage</a></li>
                                <li><a href="#tab3" data-bs-toggle="tab">Lying</a></li>
                                <li><a href="#tab4" data-bs-toggle="tab">Tables</a></li>
                            </ul>
                        </div>
                        <!-- product tab menu end -->

                        <!-- product tab content start -->
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab1">
                                <div class="product-carousel-4 slick-row-10 slick-arrow-style">
                                    <!-- product item start -->
                                    @foreach ($listProduct as $item)
                                        <div class="product-item">
                                            <figure class="product-thumb">
                                                <a href="product-details.html">
                                                    <img class="pri-img" height="200px" src="{{ Storage::url($item->hinh_anh) }}"
                                                        alt="product">
                                                    <img class="sec-img"height="200px"  src="{{ Storage::url($item->hinh_anh) }}"
                                                        alt="product">
                                                </a>
                                                <div class="product-badge">
                                                    <div class="product-label new">
                                                        <span>new</span>
                                                    </div>
                                                    <div class="product-label discount">
                                                        <span>10%</span>
                                                    </div>
                                                </div>
                                                <div class="button-group">
                                                    <a href="wishlist.html" data-bs-toggle="tooltip"
                                                        data-bs-placement="left" title="Add to wishlist"><i
                                                            class="pe-7s-like"></i></a>
                                                    <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left"
                                                        title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#quick_view"><span data-bs-toggle="tooltip"
                                                            data-bs-placement="left" title="Quick View"><i
                                                                class="pe-7s-search"></i></span></a>
                                                </div>

                                            </figure>
                                            <div class="product-caption">
                                                <div class="product-identity">
                                                    <p class="manufacturer-name"><a href="product-details.html">Gold</a>
                                                    </p>
                                                </div>
                                                <h6 class="product-name">
                                                    <a href="{{ route('clients.product.detail', ['id' => $item->id]) }}">{{ $item->ten_san_pham }}</a>
                                                </h6>
                                                <div class="price-box">
                                                    <span class="price-regular">{{ $item->gia_khuyen_mai }}</span>
                                                    <span class="price-old"><del>{{ $item->gia_san_pham }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach


                        </div>
                        <!-- product tab content end -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product area end -->

    <!-- hot deals area start -->
    <section class="hot-deals section-padding pt-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- section title start -->
                    <div class="section-title text-center">
                        <h2 class="title">Hot Theo lượt xem</h2>
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
                                        <img height="200px"  src="{{ Storage::url($item->hinh_anh) }}" alt="product">
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
