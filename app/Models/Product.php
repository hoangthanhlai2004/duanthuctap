<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'products';

    protected $fillable = [
        'ma_san_pham',
        'ten_san_pham',
        'hinh_anh',
        'so_luong',
        'gia_san_pham',
        'gia_khuyen_mai',
        'mo_ta_ngan',
        'ngay_nhap',
        'categories_id',
        'noi_dung',
        'trang_thai',
        'is_new',
        'is_hot',
        'is_hot_deal',
        'is_show_home',
    ];

    protected $casts = [
        'trang_thai' => 'boolean',
        'is_new' => 'boolean',
        'is_hot' => 'boolean',
        'is_hot_deal' => 'boolean',
        'is_show_home' => 'boolean',
    ];
    public function categories()
    {
        return $this->belongsTo(Categories::class);
    }

      public function details() {
        return $this->hasMany(OrderDetail::class);
    }

    public function ImageProduct()
    {
        return $this->hasMany(ImageProduct::class);
    }
}
