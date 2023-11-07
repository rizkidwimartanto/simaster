<?php

namespace App\Http\Controllers;

use App\Models\EntriPadamModel;
use Illuminate\Http\Request;

class EntriPadamController extends Controller
{
    public function index(){
        $data = [
            'title' => 'Peta Padam', 
            'data_padam' => EntriPadamModel::all()
        ];
        return view('beranda/petapadam', $data);
    }
    public function insertEntriPadam(Request $request){
        $entripadam = EntriPadamModel::create([
            'penyulang' => $request->penyulang,
            'section' => $request->section,
            'jam_padam' => $request->jam_padam,
            'penyebab_padam' => $request->penyebab_padam,
            'status' => $request->status,
        ]);

        return redirect('/beranda');
    }
}
