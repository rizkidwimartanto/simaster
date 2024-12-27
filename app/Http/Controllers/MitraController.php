<?php

namespace App\Http\Controllers;

use App\Imports\ABSWImport;
use App\Imports\KeypointImport;
use App\Imports\RecloserLBSImport;
use App\Imports\RisePoleImport;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MitraModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class MitraController extends Controller
{
    public function keypoint()
    {
        $data = [
            'title' => 'Recloser & LBS',
            'data_keypoint' => DB::table('keypoint')->select('id', 'penyulang', 'jenis_keypoint', 'nomor_tiang', 'status_keypoint', 'kondisi_keypoint', 'merk', 'no_seri', 'setting_ocr', 'setting_gfr', 'setting_grupaktif', 'alamat', 'tanggal_har', 'tanggal_pasang')->get(),
        ];
        return view('beranda_mitra/index', $data);
    }
    public function rise_pole()
    {
        $data = [
            'title' => 'Rise Pole',
            'data_keypoint' => DB::table('keypoint')->select('id', 'penyulang', 'absw', 'jenis_keypoint', 'nomor_tiang', 'status_keypoint', 'kondisi_keypoint', 'merk', 'no_seri', 'setting_ocr', 'setting_gfr', 'setting_grupaktif', 'alamat', 'tanggal_har', 'tanggal_pasang')->get(),
        ];
        return view('beranda_mitra/rise_pole', $data);
    }
    public function info_keypoint($id)
    {
        $data = [
            'title' => 'Keypoint',
            'keypoint' => MitraModel::find($id)
        ];
        return view('beranda_mitra/info_data_mitra', $data);
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

    public function edit_keypoint(Request $request, $id)
    {
        // Temukan data berdasarkan ID
        $datawanotif = MitraModel::find($id);

        if ($datawanotif) {
            // Update data langsung tanpa validasi
            $datawanotif->update([
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
            if ($request->input('jenis_keypoint') === "Rise Pole") {
                Session::flash('success_edit_mitraup3', 'Data berhasil diedit');
                return redirect('/rise_pole');
            }
            // Flash pesan sukses
            Session::flash('success_edit_mitraup3', 'Data berhasil diedit');
        } else {
            // Flash pesan gagal
            if ($request->input('jenis_keypoint') === "Rise Pole") {
                Session::flash('error_edit_mitraup3', 'Data gagal diedit');
                return redirect('/rise_pole');
            }
            Session::flash('error_edit_mitraup3', 'Data gagal diedit');
        }

        // Redirect ke halaman keypoint
        return redirect('/keypoint');
    }

    public function delete_keypoint(Request $request, $id)
    {
        $dataunit = MitraModel::find($id);
        if ($request->input('jenis_keypoint') === "Rise Pole") {
            $dataunit->delete();
            Session::flash('success_delete_mitraup3', 'Data berhasil dihapus');
            return redirect('/keypoint');
        }
        $dataunit->delete();
        Session::flash('error_delete_mitraup3', 'Data gagal dihapus');
        return redirect('/keypoint');
    }
    public function import_excel_recloser_lbs(Request $request)
    {
        $file = $request->file('file_recloser_lbs');
        $nama_file = rand() . $file->getClientOriginalName();
        $file->move(public_path('simaster/file_recloser_lbs/'), $nama_file);
        Excel::import(new RecloserLBSImport, public_path('simaster/file_recloser_lbs/' . $nama_file));

        return redirect('/keypoint');
    }
    public function import_excel_risepole(Request $request)
    {
        $file = $request->file('file_risepole');
        $nama_file = rand() . $file->getClientOriginalName();
        $file->move(public_path('simaster/file_risepole/'), $nama_file);
        Excel::import(new RisePoleImport, public_path('simaster/file_risepole/' . $nama_file));

        return redirect('/rise_pole');
    }
}
