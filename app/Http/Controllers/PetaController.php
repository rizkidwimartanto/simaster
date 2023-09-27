<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PetaController extends Controller
{
    public function index(){
        $data = [
            'title' => 'Peta Pelanggan'
        ];
        return view('beranda/index', $data);
    }
    public function input_pelanggan(){
        $data = [
            'title' => 'Input Pelanggan'
        ];
        return view('beranda/inputpelanggan', $data);
    }
}
