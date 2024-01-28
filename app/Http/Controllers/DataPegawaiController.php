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
            DataPegawaiModel::create([
                'nama_pegawai' => $request->input('nama_pegawai'),
                'jabatan_pegawai' => $request->input('jabatan_pegawai'),
                'unit_pegawai' => $request->input('unit_pegawai'),
                'nomortelepon_pegawai' => $request->input('nomortelepon_pegawai'),
                $validateData
            ]);
            Session::flash('success_tambah_pegawai', 'Pegawai berhasil ditambahkan');
            return redirect('/transaksiaktif');
        } else {
            Session::flash('error_tambah_pegawai', 'Pegawai gagal ditambahkan');
            return redirect('/transaksiaktif');
        }
    }
    public function edit_pegawai(Request $request, $id)
    {
        $message = ['required' => ':attribute harus diisi'];
        $validateData = $request->validate([
            'nama_pegawai' => 'required',
            'jabatan_pegawai' => 'required',
            'unit_pegawai' => 'required',
            'nomortelepon_pegawai' => 'required',
        ], $message);
        if ($validateData) {
            $datapegawai = DataPegawaiModel::find($id);
            $datapegawai->update([
                'nama_pegawai' => $request->input('nama_pegawai'),
                'jabatan_pegawai' => $request->input('jabatan_pegawai'),
                'unit_pegawai' => $request->input('unit_pegawai'),
                'nomortelepon_pegawai' => $request->input('nomortelepon_pegawai'),
                $validateData
            ]);
            Session::flash('success_edit_pegawai', 'Pegawai berhasil diedit');
            return redirect('/transaksiaktif');
        } else {
            Session::flash('error_edit_pegawai', 'Pegawai gagal diedit');
            return redirect('/transaksiaktif');
        }
    }
    public function hapus_pegawai(Request $request)
    {
        $checklist = $request->input('checkPegawai');
        if ($checklist) {
            foreach ($checklist as $check) {
                $hapuspegawai = DataPegawaiModel::find($check);
                $hapuspegawai->delete();
            }
            Session::flash('success_delete_pegawai', 'Pegawai berhasil dihapus');
            return redirect('/transaksiaktif');
        }else{
            Session::flash('error_delete_pegawai', 'Pilih minimal satu yang akan dihapus');
            return redirect('/transaksiaktif');
        }
    }
}
