@php
    use App\Models\User;
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Carbon;

    use App\Models\Product;

    $pro = Product::find($id);

    $pro->luot_xem = $pro->luot_xem + 1;

    $pro->save();


@endphp

@extends('layouts.client')

@section('content')

    <!-- page main wrapper start -->
    <div class="shop-main-wrapper section-padding pb-0">
        <div class="container">


            @session('msg')
                <div class="alert alert-warning">{{ session('msg') }}</div>
            @endsession

            @error('noi_dung')
                <div class="alert alert-warning">{{ $message }}</div>
            @enderror


            <div class="row">
                <!-- product details wrapper start -->
                <div class="col-lg-12 order-1 order-lg-2">
                    <!-- product details inner end -->
                    <div class="product-details-inner">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="product-large-slider">


                                        <div class="pro-large-img img-zoom">
                                            <img src="{{ Storage::url($item->hinh_anh) }}" alt="product-details" />
                                        </div>
                                </div>

                            </div>
                            <div class="col-lg-7">
                                <div class="product-details-des">

                                    <h3 class="product-name">{{ $item->ten_san_pham }}</h3>

                                    <div class="price-box">

                                        @if (!empty($item->gia_khuyen_mai))
                                            <span class="price-regular">{{ $item->gia_khuyen_mai }} VNĐ</span>
                                            <span class="price-old"><del>{{ $item->gia_san_pham }} VNĐ</del></span>
                                        @else
                                            <span class="price-regular">{{ $item->gia_san_pham }} VNĐ</span>
                                        @endif

                                    </div>

                                    <p class="pro-desc">{{ $item->mo_ta_ngan }}</p>

                                    <form action="{{ route('clients.cart.add') }}" method="POST">
                                        @csrf
                                        <div class="quantity-cart-box d-flex align-items-center">
                                            <h6 class="option-title">qty:</h6>
                                            <div class="quantity">
                                                <div class="pro-qty"><input type="text" name="quantity" value="1"
                                                        id="quantityInput"></div>
                                                <input type="hidden" name="product_id" value="{{ $item->id }}">
                                            </div>
                                            <div class="action_link">
                                                <button type="submit" class="btn btn-cart2">Add to cart</button>

                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- product details inner end -->

                    <!-- product details reviews start -->
                    <div class="product-details-reviews section-padding pb-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="product-review-info">
                                    <ul class="nav review-tab">
                                        <li>
                                            <a class="active" data-bs-toggle="tab" href="#tab_one">description</a>
                                        </li>
                                        {{-- <li>
                                            <a data-bs-toggle="tab" href="#tab_two">information</a>
                                        </li> --}}
                                        <li>
                                            <a data-bs-toggle="tab" href="#tab_three">reviews ({{ $countComments }})</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content reviews-tab">
                                        <div class="tab-pane fade show active" id="tab_one">
                                            <div class="tab-one">
                                                <p>{{ $item->noi_dung }}</p>
                                            </div>
                                        </div>
                                        {{-- <div class="tab-pane fade" id="tab_two">
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td>color</td>
                                                        <td>black, blue, red</td>
                                                    </tr>
                                                    <tr>
                                                        <td>size</td>
                                                        <td>L, M, S</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div> --}}
                                        <div class="tab-pane fade" id="tab_three">
                                            <form method="POST"
                                                action="{{ route('clients.product.comment', ['id' => $id]) }}"
                                                class="review-form">

                                                @csrf

                                                <h5>Có {{ $countComments }} đánh giá ( {{ $item->ten_san_pham }} )</h5>
                                                @foreach ($comments as $com)
                                                    @php
                                                        $user = User::find($com->user_id);
                                                    @endphp

                                                    <div class="total-reviews">
                                                        <div class="rev-avatar">
                                                            <img src="assets/img/about/avatar.jpg" alt="">
                                                        </div>
                                                        <div class="review-box">
                                                            <div class="post-author">
                                                                <p>
                                                                    {{-- <span>{{ $user->name }} -</span>  --}}
                                                                    {{ Carbon::parse($com->thoi_gian)->format('Y/m/d') }}
                                                                </p>
                                                            </div>
                                                            <p>{{ $com->noi_dung }}</p>
                                                        </div>
                                                    </div>
                                                @endforeach

                                                <div class="form-group row">
                                                    <div class="col">
                                                        <label class="col-form-label"><span class="text-danger">*</span>
                                                            Bình luận của bạn</label>
                                                        <textarea class="form-control" name="noi_dung"></textarea>
                                                    </div>
                                                </div>

                                                <div class="buttons">
                                                    <button class="btn btn-sqr" type="submit">Gửi</button>
                                                </div>
                                            </form> <!-- end of review-form -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- product details reviews end -->
                </div>
                <!-- product details wrapper end -->
            </div>
        </div>
    </div>
    <!-- page main wrapper end -->

    <!-- related products area start -->
    <section class="related-products section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- section title start -->
                    <div class="section-title text-center">
                        <h2 class="title">Sản phẩm liên quan</h2>
                    </div>
                    <!-- section title start -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-carousel-4 slick-row-10 slick-arrow-style">

                        @foreach ($products as $pro)
                            <!-- product item start -->
                            <div class="product-item">
                                <figure class="product-thumb">
                                    <a href="{{ route('clients.product.detail', ['id' => $item->id]) }}">
                                        <img class="pri-img" src="{{ Storage::url($pro->hinh_anh) }}" alt="product">
                                    </a>
                                    <form action="{{ route('clients.cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="quantity" value="1">
                                        <input type="hidden" name="product_id" value="{{ $pro->id }}">
                                    </form>
                                </figure>
                                <div class="product-caption text-center">

                                    <h6 class="product-name">
                                        <a href="{{ route('clients.product.detail', ['id' => $item->id]) }}">{{ $pro->ten_san_pham }}</a>
                                    </h6>
                                    <div class="price-box">
                                        @if (!empty($pro->gia_khuyen_mai))
                                            <span class="price-regular">{{ $pro->gia_khuyen_mai }} VNĐ</span>
                                            <span class="price-old"><del>{{ $pro->gia_san_pham }} VNĐ</del></span>
                                        @else
                                            <span class="price-regular">{{ $pro->gia_san_pham }} VNĐ</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- product item end -->
                        @endforeach




                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('js')
    <script>
        $('.pro-qty').prepend('<span class="dec qtybtn">-</span>');
        $('.pro-qty').append('<span class="inc qtybtn">+</span>');
        $('.qtybtn').on('click', function() {
            var $button = $(this);
            var $input = $button.parent().find('input');
            var oldValue = parseFloat($input.val());

            if ($button.hasClass('inc')) {
                var newVal = oldValue + 1;
            } else {
                if (oldValue > 1) {
                    var newVal = oldValue - 1;
                } else {
                    var newVal = 1;

                }
            }
            $input.val(newVal);

        });

        //xử lý người dùng nhập số âm
        $('#quantityInput').on('change', function() {
            var value = parseInt($(this).val(), 10);

            if (isNaN(value) || value < 1) {
                alert('Số lượng phải lớn hơn bằng 1.')
                $(this).val(1)
            }
        });
    </script>
@endsection
