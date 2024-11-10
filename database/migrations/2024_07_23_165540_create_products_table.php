<?php

use App\Models\Categories;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Tự động tăng ID
            $table->string('ma_san_pham', 10)->unique(); // Mã sản phẩm duy nhất
            $table->string('ten_san_pham', 255); // Tên sản phẩm
            $table->string('hinh_anh')->nullable(); // Đường dẫn đến hình ảnh sản phẩm, có thể null
            $table->unsignedInteger('so_luong'); // Số lượng sản phẩm
            $table->double('gia_san_pham', 12, 2); // Giá sản phẩm
            $table->double('gia_khuyen_mai', 12, 2)->nullable(); // Giá khuyến mại, có thể null
            $table->string('mo_ta_ngan', 255); // Mô tả ngắn gọn, có thể null
            $table->date('ngay_nhap'); // Ngày nhập sản phẩm
            $table->foreignIdFor(Categories::class)->constrained(); // Liên kết với bảng categories
            $table->text('noi_dung')->nullable(); // Nội dung chi tiết, có thể null
            $table->boolean('trang_thai')->default(true); // Trạng thái sản phẩm
            $table->boolean('is_new')->default(true); // Gợi ý sản phẩm mới
            $table->boolean('is_hot')->default(true); // Gợi ý sản phẩm hot
            $table->boolean('is_hot_deal')->default(true); // Gợi ý sản phẩm giảm giá
            $table->boolean('is_show_home')->default(true); // Hiển thị sản phẩm trên trang chủ
            $table->softDeletes();
            $table->timestamps(); // Thêm cột created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
