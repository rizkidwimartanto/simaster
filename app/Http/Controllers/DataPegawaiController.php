<?php

namespace App\Http\Controllers;

use App\Models\DataPegawaiModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class DataPegawaiController extends Controller
{
    public function tambah_pegawai(Request $request)
    {
        $message = ['required' => ':attribute harus diisi'];
        $validateData = $request->validate([
            'nama_pegawai' => 'required',
            'jabatan_pegawai' => 'required',
            'unit_pegawai' => 'required',
            'nomortelepon_pegawai' => 'required',
        ], $message);
        if ($validateData) {
            DataPegawaiModel::created([
                'nama_pegawai' => $request->input('nama_pegawai'),
                'jabatan_pegawai' => $request->input('jabatan_pegawai'),
                'unit_pegawai' => $request->input('unit_pegawai'),
                'nomortelepon_pegawai' => $request->input('nomortelepon_pegawai'),
                $validateData
            ]);
            Session::flash('success_tambah_pegawai', 'Pegawai berhasil ditambahkan');
            return redirect('/transaksiaktif');
        }else{
            Session::flash('error_tambah_pegawai', 'Pegawai gagal ditambahkan');
            return redirect('/transaksiaktif');
        }
    }
}
