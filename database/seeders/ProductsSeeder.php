<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Carbon;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        // DB::table('products')->insert([
        //     'ma_san_pham' => 'SP001',
        //     'ten_san_pham' => 'Gậy Bóng Chày',
        //     'hinh_anh' => null,
        //     // 'slug' => 'gay-bong-chay',
        //     'so_luong' => 10,
        //     'gia_san_pham' => 130000,
        //     'mo_ta_ngan' => 'Mô tả gắn gậy bóng chày',
        //     'noi_dung' => 'Gậy bóng chày',
        //     // 'danh_muc_id' => null,
        //     'ngay_nhap' => '2024-07-22',
        // ]);
    }
}
