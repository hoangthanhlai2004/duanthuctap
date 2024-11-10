<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'ma_san_pham' => 'required|string|max:10|unique:products,ma_san_pham'.$this->route('id'),
            'ten_san_pham' => 'required|string|max:255',
            'so_luong' => 'required|integer|min:0',
            'gia_san_pham' => 'required|numeric|min:0|max:99999999999.99',
            'gia_khuyen_mai' => 'nullable|numeric|min:0|max:99999999999.99|lt:gia_san_pham',
            'mo_ta_ngan' => 'nullable| |max:255',
            'ngay_nhap' => 'required|date',
            'categories_id' => 'required|exists:categories,id',
        ];
    }
    public function messages(): array
    {
        return [
            'ma_san_pham.required' => 'Mã sản phẩm là bắt buộc.',
            'ma_san_pham.unique' => 'Mã sản phẩm này đã tồn tại. Vui lòng chọn mã khác.',
            'ten_san_pham.required' => 'Tên sản phẩm là bắt buộc.',
            'so_luong.required' => 'Số lượng sản phẩm là bắt buộc.',
            'so_luong.integer' => 'Số lượng sản phẩm phải là một số nguyên.',
            'so_luong.min' => 'Số lượng sản phẩm không được nhỏ hơn 0.',
            'gia_san_pham.required' => 'Giá sản phẩm là bắt buộc.',
            'gia_san_pham.numeric' => 'Giá sản phẩm phải là một số hợp lệ.',
            'gia_san_pham.min' => 'Giá sản phẩm không được nhỏ hơn 0.',
            'gia_khuyen_mai.numeric' => 'Giá khuyến mại phải là một số hợp lệ.',
            'gia_khuyen_mai.min' => 'Giá khuyến mại không được nhỏ hơn 0.',
            'gia_khuyen_mai.lt' => 'Giá khuyến mại không được nhỏ hơn giá sản phẩm.',
            'mo_ta_ngan.string' => 'Mô tả ngắn phải là một chuỗi ký tự hợp lệ.',
            'ngay_nhap.required' => 'Ngày nhập sản phẩm là bắt buộc.',
            'ngay_nhap.date' => 'Ngày nhập sản phẩm phải là một ngày hợp lệ.',
            'categories_id.required' => 'Danh mục sản phẩm là bắt buộc.',
            'categories_id.exists' => 'Danh mục sản phẩm không tồn tại.',
        ];
    }
}
