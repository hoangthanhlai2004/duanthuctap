<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //

    public function detailsSanPham(string $id){
        return view('clients.sanphams.chitiet');
    }




}
