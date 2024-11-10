<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    const TRANG_THAI_DON_HANG = [
        'cho_xac_nhan' => 'Chờ xác nhận',
        'da_xac_nhan' => 'Đã xác nhận',
        'dang_chuan_bi' => 'Đang chuẩn bị',
        'dang_van_chuyen' => 'Đang vận chuyển',
        'da_giao_hang' => 'Đã giao hàng',
        'huy_don_hang' => 'Hủy đơn hàng',
    ];

    // const TRANG_THAI_THANH_TOAN = [
    //     'chua_thanh_toan' => 'Chưa thanh toán',
    //     'da_thanh_toan' => 'Đã thanh toán',

    // ];

    const CHO_XAC_NHAN = 'cho_xac_nhan';
    const DA_XAC_NHAN = 'da_xac_nhan';
    const DANG_CHUAN_BI = 'dang_chuan_bi';
    const DANG_VAN_CHUYEN = 'dang_van_chuyen';
    const DA_GIAO_HANG = 'da_giao_hang';
    const HUY_DON_HANG = 'huy_don_hang';
    // const CHUA_THANH_TOAN = 'chua_thanh_toan';
    // const DA_THANH_TOAN = 'da_thanh_toan';
    protected $appends = ['totalPrice'];

    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'code',
        'name',
        'email',
        'phone',
        'address',
        'description',
        'status',

    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function details() {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }

    public function getTotalPriceAttribute() {
        $t = 0;

        foreach($this->details as $item) {
            $t += $item->price * $item->quantity;
        }

        return $t;
    }
}
