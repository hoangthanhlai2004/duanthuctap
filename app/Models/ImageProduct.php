<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageProduct extends Model
{
    protected $table = 'product_images';
    protected $fillable = [
        'san_pham_id',
        'hinh_anh'
    ];
    public function Products()
    {
        return $this->belongsTo(Product::class);
    }
}
