<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MitraModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class MitraController extends Controller 
{
      public function keypoint()
      {
          $data = [
              'title' => 'Keypoint',
              'data_keypoint' => DB::table('mitra')->select('id', 'jenis_keypoint', 'nomor_tiang', 'status_keypoint', 'kondisi_keypoint', 'merk', 'no_seri', 'setting_ocr', 'setting_gfr', 'setting_grupaktif', 'alamat', 'tanggal_har', 'tanggal_pasang')->get(),
          ];
          return view('beranda_mitra/index', $data);
      }
      public function informasi_keypoint($id){
        $data = [
            'title' => 'Keypoint',
            'keypoint' => MitraModel::find($id)
        ];
        return view('beranda_mitra/informasi_data_mitra', $data);
    }
      public function proses_tambah_keypoint(Request $request)
      {
          $message = ['required' => ':attribute harus diisi'];
          $validateData = $request->validate([
              'jenis_keypoint' => 'required',
              'nomor_tiang' => 'required',
              'status_keypoint' => 'required',
              'kondisi_keypoint' => 'required',
              'merk' => 'required',
              'no_seri' => 'required',
              'setting_ocr' => 'required',
              'setting_gfr' => 'required',
              'setting_grupaktif' => 'required',
              'alamat' => 'required',
              'tanggal_har' => 'required',
              'tanggal_pasang' => 'required',
          ], $message);
      
          if ($validateData) {
              MitraModel::create([
                  'jenis_keypoint' => $request->input('jenis_keypoint'),
                  'nomor_tiang' => $request->input('nomor_tiang'),
                  'status_keypoint' => $request->input('status_keypoint'),
                  'kondisi_keypoint' => $request->input('kondisi_keypoint'),
                  'merk' => $request->input('merk'),
                  'no_seri' => $request->input('no_seri'),
                  'setting_ocr' => $request->input('setting_ocr'),
                  'setting_gfr' => $request->input('setting_gfr'),
                  'setting_grupaktif' => $request->input('setting_grupaktif'),
                  'alamat' => $request->input('alamat'),
                  'tanggal_har' => $request->input('tanggal_har'),
                  'tanggal_pasang' => $request->input('tanggal_pasang'),
              ]);
      
              Session::flash('success_tambah_keypoint', 'keypoint berhasil ditambahkan');
          } else {
              Session::flash('error_tambah_keypoint', 'keypoint gagal ditambahkan');
          }
          return redirect('/keypoint');
      }
}
