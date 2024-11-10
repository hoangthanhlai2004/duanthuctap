<?php

namespace App\Http\Controllers\Admins;

use App\Models\Product;
use App\Models\Categories;
use Illuminate\Http\Request;
use function Laravel\Prompts\alert;
use App\Http\Controllers\Controller;

use App\Http\Requests\ProductRequest;
use App\Models\ImageProduct;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public $proDuct;

    public function __construct()
    {
        $this->proDuct = new Product();
        $bien = 2;
    }
    public function index()
    {
        //
        $listProduct = Product::get();
        return view('admins.products.index', compact('listProduct'));
        // dd($listProduct);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $listCategories = Categories::query()->get();
        return view('admins.products.create', compact('listCategories'));
    }


    public function store(ProductRequest $request)
    {
        // return view('admins.products.listProduct');

        if ($request->isMethod('POST')) {

            $params = $request->except('_token');
            //chuyển đổi checkbox thành boolean
            $params['is_new'] = $request->has('is_new') ? 1 : 0;
            $params['is_hot'] = $request->has('is_hot') ? 1 : 0;
            $params['is_hot_deal'] = $request->has('is_hot_deal') ? 1 : 0;
            $params['is_show_home'] = $request->has('is_show_home') ? 1 : 0;

            //sử lý ảnh đại diện


            if ($request->file('hinh_anh')) {
                $params['hinh_anh'] = $request->file('hinh_anh')->store('uploads/product', 'public');
            } else {
                $params['hinh_anh'] = null;
            }
            //thêm sản phẩm

            $proDuct = Product::query()->create($params);
            //lấy id vừa theem ở album
            $productID = $proDuct->id;

            //sử lí thêm album
            if ($request->hasFile('list_hinh_anh')) {
                foreach ($request->file('list_hinh_anh') as $image) {
                    if ($image) {
                        $path = $image->store('uploads/imageProduct/id_' . $productID, 'public');
                        $proDuct->imageProduct()->create([
                            'product_id' => $productID,
                            'hinh_anh' => $path,
                        ]);
                    }
                }
            }

            // Redirect to the product list with a success message
            return redirect()->route('products.index')->with('success', 'Thêm sản phầm thành công!');
        }
    }




    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //cập nhật thông tin sản phẩm
        $listCategories = Categories::query()->get();

        $proDuct = Product::query()->findOrFail($id);
        return view('admins.products.edit', compact('listCategories', 'proDuct'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // return view('admins.products.listProduct');

        if ($request->isMethod('PUT')) {

            $params = $request->except('_token', '_method');


            //chuyển đổi checkbox thành boolean
            $params['is_new'] = $request->has('is_new') ? 1 : 0;
            $params['is_hot'] = $request->has('is_hot') ? 1 : 0;
            $params['is_hot_deal'] = $request->has('is_hot_deal') ? 1 : 0;
            $params['is_show_home'] = $request->has('is_show_home') ? 1 : 0;

            //xóa hình ảnh cũ
            $proDuct = Product::query()->findOrFail($id);

            //sử lý ảnh đại diện
            if ($request->hasFile('hinh_anh')) {
                if ($proDuct->hinh_anh && Storage::disk('public')->exists($proDuct->hinh_anh)) {
                    Storage::disk('public')->delete($proDuct->hinh_anh);
                }

                $name = $request->file('hinh_anh')->store('uploads/products', 'public');

                $params['hinh_anh'] = $name;
            } else {
                $params['hinh_anh'] = $proDuct->hinh_anh;
            }

            //Xử lý album

            if ($request->hasFile('list_hinh_anh')) {

                $currentImages = $proDuct->ImageProduct->pluck('id')->toArray();
                $arrayCombine = array_combine($currentImages, $currentImages);
                //Trường hợp xóa ảnh
                foreach ($arrayCombine as $key => $value) {

                    //Tìm kiếm id hình ảnh trong mảng mới đẩy lên
                    //Nếu không tồn tại ID tức là  người dùng đã xóa hình ảnh đó
                    if (!array_key_exists($key, $request->list_hinh_anh)) {
                        $ImageProduct = ImageProduct::query()->find($key);
                        //Xóa hình ảnh đó
                        if ($ImageProduct && Storage::disk('public')->exists($ImageProduct->hinh_anh)) {
                            Storage::disk('public')->delete($ImageProduct->hinh_anh);
                            $ImageProduct->delete();
                        }
                    }
                }

                foreach ($request->list_hinh_anh as $key => $image) {
                    if (!array_key_exists($key, $arrayCombine)) {
                        if ($request->hasFile("list_hinh_anh.$key")) {
                            $path = $image->store('uploads/imageProduct/id_' . $id, 'public');
                            $proDuct->ImageProduct()->create([
                                'product_id' => $id,
                                'hinh_anh' => $path,
                            ]);
                        }
                    } else if (is_file($image) && $request->hasFile("list_hinh_anh.$key")) {
                        //Trường hợp thay đổi hình ảnh
                        $ImageProduct = ImageProduct::query()->find($key);
                        if ($ImageProduct && Storage::disk('public')->exists($ImageProduct->hinh_anh)) {
                            Storage::disk('public')->delete($ImageProduct->hinh_anh);
                        }
                        $path = $image->store('uploads/imageProduct/id_' . $id, 'public');
                        $ImageProduct->update([
                            'hinh_anh' => $path,
                        ]);
                    }
                }

            }

            $proDuct->update($params);



            //trường hợp thêm hoặc sửa
            // Redirect to the product list with a success message
            return redirect()->route('products.index')->with('success', 'Cập nhật sản phầm thành công!');
        }
    }


    // public function update(Request $request, string $id)
    // {


    //     $request->validate([
    //         'ma_san_pham' => 'required|string|max:10|unique:products,ma_san_pham,'.$id,
    //         'ten_san_pham' => 'required|string|max:255',
    //         'so_luong' => 'required|integer|min:0',
    //         'gia_san_pham' => 'required|numeric|min:0|max:99999999999.99',
    //         'gia_khuyen_mai' => 'nullable|numeric|min:0|max:99999999999.99|lt:gia_san_pham',
    //         'mo_ta_ngan' => 'nullable| |max:255',
    //         'ngay_nhap' => 'required|date',
    //         'categories_id' => 'required',
    //     ], [
    //         'ma_san_pham.required' => 'Mã sản phẩm là bắt buộc.',
    //         'ma_san_pham.unique' => 'Mã sản phẩm này đã tồn tại. Vui lòng chọn mã khác.',
    //         'ten_san_pham.required' => 'Tên sản phẩm là bắt buộc.',
    //         'hinh_anh.string' => 'Đường dẫn hình ảnh phải là một chuỗi ký tự hợp lệ.',
    //         'so_luong.required' => 'Số lượng sản phẩm là bắt buộc.',
    //         'so_luong.integer' => 'Số lượng sản phẩm phải là một số nguyên.',
    //         'so_luong.min' => 'Số lượng sản phẩm không được nhỏ hơn 0.',
    //         'gia_san_pham.required' => 'Giá sản phẩm là bắt buộc.',
    //         'gia_san_pham.numeric' => 'Giá sản phẩm phải là một số hợp lệ.',
    //         'gia_san_pham.min' => 'Giá sản phẩm không được nhỏ hơn 0.',
    //         'gia_khuyen_mai.numeric' => 'Giá khuyến mại phải là một số hợp lệ.',
    //         'gia_khuyen_mai.min' => 'Giá khuyến mại không được nhỏ hơn 0.',
    //         'gia_khuyen_mai.lt' => 'Giá khuyến mại không được nhỏ hơn giá sản phẩm.',
    //         'mo_ta_ngan.string' => 'Mô tả ngắn phải là một chuỗi ký tự hợp lệ.',
    //         'ngay_nhap.required' => 'Ngày nhập sản phẩm là bắt buộc.',
    //         'ngay_nhap.date' => 'Ngày nhập sản phẩm phải là một ngày hợp lệ.',
    //         'categories_id.required' => 'Danh mục sản phẩm là bắt buộc.',
    //     ]);


    //     $item = Product::find($id);

    //     $item->ma_san_pham = $request->ma_san_pham;
    //     $item->ten_san_pham = $request->ten_san_pham;
    //     $item->so_luong = $request->so_luong;
    //     $item->gia_san_pham = $request->gia_san_pham;
    //     $item->trang_thai = $request->trang_thai;
    //     if($request->mo_ta_ngan){
    //         $item->mo_ta_ngan = $request->mo_ta_ngan;
    //     }else{
    //         $item->mo_ta_ngan = 0;
    //     }
    //     if($request->noi_dung){
    //         $item->noi_dung = $request->noi_dung;
    //     }else{
    //         $item->noi_dung = 0;
    //     }
    //     if($request->gia_khuyen_mai){
    //         $item->gia_khuyen_mai = $request->gia_khuyen_mai;
    //     }else{
    //         $item->gia_khuyen_mai = 0;
    //     }
    //     $item->ngay_nhap = $request->ngay_nhap;
    //     $item->categories_id = $request->categories_id;

    //     $file = $request->file('hinh_anh');

    //     if($file){
    //         $name = rand(11111111, 99999999).'_'.$file->getClientOriginalName();
    //         $file->storeAs('public/uploads/product', $name);
    //         if(Storage::exists('public/uploads/product', $item->hinh_anh)){
    //             Storage::delete('public/uploads/product', $item->hinh_anh);
    //         }
    //         $item->hinh_anh = $name;
    //     }

    //             $currentImages = $item->ImageProduct->pluck('id')->toArray();
    //     $arrayCombine = array_combine($currentImages, $currentImages);

    //     //Trường hợp xóa ảnh
    //     foreach ($arrayCombine as $key => $value) {

    //         //Tìm kiếm id hình ảnh trong mảng mới đẩy lên
    //         //Nếu không tồn tại ID tức là  người dùng đã xóa hình ảnh đó
    //         if (!array_key_exists($key, $request->list_hinh_anh)) {
    //             $ImageProduct = ImageProduct::query()->find($key);
    //             //Xóa hình ảnh đó
    //             if ($ImageProduct && Storage::disk('public')->exists($ImageProduct->hinh_anh)) {
    //                 Storage::disk('public')->delete($$ImageProduct->hinh_anh);
    //                 $ImageProduct->delete();
    //             }
    //         }
    //     }

    //     foreach ($request->list_hinh_anh as $key => $image) {
    //         if (!array_key_exists($key, $arrayCombine)) {
    //             if ($request->hasFile("list_hinh_anh.$key")) {
    //                 $path = $image->store('uploads/imageProduct/id_' . $id, 'public');
    //                 $item->ImageProduct()->create([
    //                     'product_id' => $id,
    //                     'hinh_anh' => $path,
    //                 ]);
    //             }
    //         } else if (is_file($image) && $request->hasFile("list_hinh_anh.$key")) {
    //             //Trường hợp thay đổi hình ảnh
    //             $ImageProduct = ImageProduct::query()->find($key);
    //             if ($ImageProduct && Storage::disk('public')->exists($ImageProduct->hinh_anh)) {
    //                 Storage::disk('public')->delete($$ImageProduct->hinh_anh);
    //             }
    //             $path = $image->store('uploads/imageProduct/id_' . $id, 'public');
    //             $ImageProduct->update([
    //                 'hinh_anh' => $path,
    //             ]);
    //         }
    //     }


    //     $item->save();

    //     return redirect()->route('products.index');


    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $proDuct = Product::query()->findOrFail($id);

        // Xóa hình ảnh đại diện nếu tồn tại
        if ($proDuct->hinh_anh && Storage::disk('public')->exists($proDuct->hinh_anh)) {
            Storage::disk('public')->delete($proDuct->hinh_anh);
        }

        // Xóa hình ảnh sản phẩm liên quan
        $proDuct->ImageProduct()->delete();

        // Xóa thư mục chứa hình ảnh sản phẩm nếu tồn tại
        $path = 'uploads/imageProduct/id_' . $id;
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->deleteDirectory($path);
        }

        // Xóa sản phẩm
        $proDuct->delete();

        return redirect()->route('products.index')->with('success', 'Xóa sản phẩm thành công!');
    }
}
