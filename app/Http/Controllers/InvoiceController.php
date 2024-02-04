<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $array = array(
            'title' => 'Tagihan Pembelian',
        );
        
        return view('Invoice/Index',$array);
    }
}
