<?php

namespace App\Http\Controllers;

use App\Models\EntriPadamModel;
use Illuminate\Support\Facades\Session;
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
        Session::flash('success_tambah', 'Data berhasil ditambah');
        return redirect('/petapadam');
    }
    public function hapusEntriPadam(){
        $hapus_entri = request('check');
        if($hapus_entri){
            foreach ($hapus_entri as $hapus) {
                $padam = EntriPadamModel::find($hapus);
                $padam->delete();
            }
            Session::flash('success_hapus', 'Data berhasil dihapus');
            return redirect('/petapadam');
        }else{
            Session::flash('success_hapus', 'Data berhasil dihapus');
            return redirect('/petapadam');
        }
    }
}
