<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductSettingController extends Controller
{
    public function index()
    {
        $array = array(
            'title' => 'Pengaturan / Produk',
        );
        
        return view('Setting/Product/Index',$array);
    }

    public function show_cat()
    {
        $array = array(
            'modal_title' => 'Kategori',
        );

        return view('Setting/Product/Show_cat',$array);
    }
}
