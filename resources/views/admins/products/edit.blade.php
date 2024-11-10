{{-- extends : chỉ định layout được sử dụng --}}
@extends('layouts.admin')


{{-- định nghĩa nội dung của section --}}
@section('content')
    <div class="cart">
        <h2 class="mt-4">Cập nhật sản phẩm</h2>
        <div class="cart-body">
            <form action="{{ route('products.update', $proDuct->id) }}" method="POST" enctype="multipart/form-data">
                @csrf <!-- Laravel CSRF protection -->
                @method('PUT')
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">

                            <div class="mb-3">
                                <label for="" class="form-label">Hình ảnh sản phẩm</label>
                                <input id="hinh_anh" type="file" class="form-control" name="hinh_anh" onchange="showImage(event)">
                                <img id="image_san_pham" src="{{ Storage::url($proDuct->hinh_anh) }}" alt="Hình ảnh sản phẩm"
                                style="width: 350px;">
                            </div>

                            <label for=" " class="form-label">Album hình ảnh:</label>
                            <a id="add-row"><i class="fa fa-plus text-muted fs-18 rounded-2 border ms-3"
                                    style="cursor: pointer;"></i></a>
                            <table class="table align-middle table-nowrap mb-0">
                                <tbody id="image-table-body">
                                    @foreach ($proDuct->ImageProduct as $index => $hinh_anh)
                                        <tr>
                                            <td class="d-flex align-items-center">
                                                <img class="me-3" id="preview_{{ $index }}"
                                                    src="{{ Storage::url($hinh_anh->hinh_anh) }}" alt="Hình ảnh sản phẩm"
                                                    style="width: 50px;">
                                                <input type="file" id="hinh_anh" class="form-control"
                                                    name="list_hinh_anh[{{ $hinh_anh->id }}]"
                                                    onchange="previewImage(this, {{ $index }})">
                                                <input type="hidden" name="list_hinh_anh[{{ $hinh_anh->id }}]"
                                                    value="{{ $hinh_anh->id }}">
                                            </td>
                                            <td>
                                                <i class="fa fa-trash-alt" style="color: red; cursor: pointer;"
                                                    onclick="removeRow(this)"></i>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>


                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="ma_san_pham" class="form-label">Mã sản phẩm:</label>
                                <input type="text" class="form-control @error('ma_san_pham') is-invalid @enderror"
                                    id="ma_san_pham" name="ma_san_pham" value="{{ $proDuct->ma_san_pham }}"
                                    placeholder="Nhập mã sản phẩm">
                                @error('ma_san_pham')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="ten_san_pham" class="form-label">Tên sản phẩm:</label>
                                <input type="text" class="form-control @error('ten_san_pham') is-invalid @enderror"
                                    id="ten_san_pham" name="ten_san_pham" value="{{ $proDuct->ten_san_pham }}"
                                    placeholder="Nhập tên sản phẩm">
                                @error('ten_san_pham')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="so_luong" class="form-label">Số Lượng:</label>
                                <input type="number" id="so_luong"
                                    class="form-control @error('so_luong') is-invalid @enderror" name="so_luong"
                                    min="1" value="{{ $proDuct->so_luong }}" placeholder="Nhập số lượng sản phẩm">
                                @error('so_luong')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="gia_san_pham" class="form-label">Giá:</label>
                                <input type="number" class="form-control @error('gia_san_pham') is-invalid @enderror"
                                    id="gia_san_pham" name="gia_san_pham" min="1"
                                    value="{{ $proDuct->gia_san_pham }}" placeholder="Nhập giá sản phẩm">
                                @error('gia_san_pham')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="ngay_nhap" class="form-label">Ngày nhập:</label>
                                <input type="date" class="form-control @error('ngay_nhap') is-invalid @enderror"
                                    id="ngay_nhap" name="ngay_nhap" value="{{ $proDuct->ngay_nhap }}">
                                @error('ngay_nhap')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="gia_khuyen_mai" class="form-label">Giá Khuyến Mãi:</label>
                                <input type="number" class="form-control @error('gia_khuyen_mai') is-invalid @enderror"
                                    value="{{ $proDuct->gia_khuyen_mai }}" id="gia_khuyen_mai" name="gia_khuyen_mai"
                                    placeholder="Nhập giá khuyến mãi">
                                @error('gia_khuyen_mai')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="categories_id" class="form-label">Danh Mục</label>
                                <select name="categories_id"
                                    class="form-select @error('categories_id') is-invalid @enderror">
                                    <option value="" selected>Chọn Danh Mục</option>
                                    @foreach ($listCategories as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $proDuct->categories_id == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}</option>
                                    @endforeach

                                </select>
                                @error('categories_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="trang_thai" class="form-label mt-1 ">Trạng Thái</label>
                                <div class=" d-flex gap-2">
                                    <div class="form-check col-3">
                                        <input class="form-check-input" type="radio" name="trang_thai" id="gridRadio1"
                                            value="1" {{ $proDuct->trang_thai == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label text-success" for="gridRadio1">
                                            Còn hàng
                                        </label>
                                    </div>
                                    <div class="form-check col-3">
                                        <input class="form-check-input" type="radio" name="trang_thai" id="gridRadio2"
                                            value="0" {{ $proDuct->trang_thai == 0 ? 'checked' : '' }}>
                                        <label class="form-check-label text-danger" for="gridRadio2">
                                            Hết hằng
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <label for="">Tùy chỉnh khác</label>
                        <div class="mb-3 d-flex justify-content-between ps-3">
                            <div class="form-check form-switch mb-3">
                                <input type="checkbox" class="form-check-input" id="is_new" name="is_new"
                                    {{ $proDuct->is_new == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_new">Sản phẩm mới</label>
                            </div>
                            <div class="form-check form-switch mb-3">
                                <input type="checkbox" class="form-check-input" id="is_hot" name="is_hot"
                                    {{ $proDuct->is_hot == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_hot">Sản phẩm nổi bật</label>
                            </div>
                            <div class="form-check form-switch mb-3">
                                <input type="checkbox" class="form-check-input" id="is_hot_deal" name="is_hot_deal"
                                    {{ $proDuct->is_hot_deal == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_hot_deal">Sản phẩm bán chạy</label>
                            </div>
                            <div class="form-check form-switch mb-3">
                                <input type="checkbox" class="form-check-input" id="is_show_home" name="is_show_home"
                                    {{ $proDuct->is_show_home == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_show_homess">Sản phẩm hiển thị</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="mo_ta_ngan" class="form-label">Mô tả ngắn:</label>
                            <textarea class="form-control @error('mo_ta_ngan') is-invalid @enderror" id="mo_ta_ngan" rows="3"
                                name="mo_ta_ngan" placeholder="Nhập mô tả ngắn">{{ old('mo_ta_ngan') ?? $proDuct->mo_ta_ngan }}</textarea>
                            @error('mo_ta_ngan')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="noi_dung" class="form-label @error('noi_dung') is-invalid @enderror">Nội
                                Dung:</label>
                            <textarea class="form-control" id="noi_dung" name="noi_dung" placeholder="Nhập nội dung">{{ old('noi_dung') ?? $proDuct->noi_dung }}</textarea>
                            @error('noi_dung')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror

                        </div>

                    </div>

                    <div class="col-12 mb-3 d-flex justify-content-center">
                        <button type="submit" class="btn btn-success">Thêm mới</button>
                    </div>
                </div>
            </form>


        </div>

    </div>
@endsection

@section('js')
    <script>
        function showImage(event) {
            const image_san_pham = document.getElementById('image_san_pham');

            const file = event.target.files[0];

            const reader = new FileReader();

            reader.onload = function() {
                image_san_pham.src = reader.result;
                image_san_pham.style.display = 'block';
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        }


        document.addEventListener('DOMContentLoaded', function() {
            var rowCount = {{ count($proDuct->ImageProduct) }};


            document.getElementById('add-row').addEventListener('click', function() {
                // alert('ấn rồi'); // Alert message when the button is clicked

                var tableBody = document.getElementById('image-table-body');
                var newRow = document.createElement('tr');

                newRow.innerHTML = `
                    <td class="d-flex align-items-center">
                        <img class="me-3" id="preview_${rowCount}"src="data:image/png;base64,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"
                        alt="Hình ảnh sản phẩm" style="width: 50px;">
                        <input type="file" class="form-control" 
                            name="list_hinh_anh[id_${rowCount}]"
                            onchange="previewImage(this, ${rowCount})">
                    </td>
                    <td>
                        <i class="fa fa-trash-alt" style="color: red; cursor: pointer;" onclick="removeRow(this)"></i>
                    </td>`;

                tableBody.appendChild(newRow);
                rowCount++;
            });
        });

        function previewImage(input, rowIndex) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    document.getElementById(`preview_${rowIndex}`).setAttribute('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeRow(item) {
            var row = item.closest('tr');
            row.remove();
        }
        // console.log($product);
    </script>
@endsection
