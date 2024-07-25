<?php

namespace App\Http\Controllers;

use App\Exports\APPExport;
use App\Models\DataPelangganModel;
use App\Models\PelangganAPPModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class InputPelangganAPPController extends Controller
{
    public function user(){
        $data = [
            'title' => 'Peta Pelanggan',
            // 'data_padam' => DB::table('entri_padam')->select('status', 'section')->get(),
            'data_pelanggan_app' => DB::table('entri_pelanggan_app')->select('id','id_pelanggan', 'nama_pelanggan', 'tarif', 'daya', 'alamat', 'latitude', 'longitude', 'jenis_meter', 'merk_meter')->get(),
            // 'data_unitulp' => PelangganAPPModel::pluck('unitulp')
        ];
        return view('beranda_user/index', $data);
    }
    public function entridata_user(){
        $data = [
            'title' => 'Entri Data',
        ];
        return view('beranda_user/entridata_user', $data);
    }

    public function proses_input_pelangganapp(Request $request)
    {
        $message = ['required' => ':attribute harus diisi'];
        $validateData = $request->validate([
            'id_pelanggan' => 'required',
            'nama_pelanggan' => 'required',
            'tarif' => 'required',
            'daya' => 'required',
            'alamat' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'jenis_meter' => 'required',
            'merk_meter' => 'required',
            'tahun_meter' => 'required',
            'merk_mcb' => 'required',
            'ukuran_mcb' => 'required',
            'no_segel' => 'required',
            'no_gardu' => 'required',
            'sr_deret' => 'required',
        ], $message);
    
        if ($validateData) {
            PelangganAPPModel::create([
                'id_pelanggan' => $request->input('id_pelanggan'),
                'nama_pelanggan' => $request->input('nama_pelanggan'),
                'tarif' => $request->input('tarif'),
                'daya' => $request->input('daya'),
                'alamat' => $request->input('alamat'),
                'latitude' => $request->input('latitude'),
                'longitude' => $request->input('longitude'),
                'jenis_meter' => $request->input('jenis_meter'),
                'merk_meter' => $request->input('merk_meter'),
                'tahun_meter' => $request->input('tahun_meter'),
                'merk_mcb' => $request->input('merk_mcb'),
                'ukuran_mcb' => $request->input('ukuran_mcb'),
                'no_segel' => $request->input('no_segel'),
                'no_gardu' => $request->input('no_gardu'),
                'sr_deret' => $request->input('sr_deret'),
                'catatan' => $request->input('catatan'),
            ]);
    
            Session::flash('success_tambah_wanotif', 'wanotif berhasil ditambahkan');
        } else {
            Session::flash('error_tambah_wanotif', 'wanotif gagal ditambahkan');
        }
        return redirect('/user');
    }
    public function koordinator(){
        $data = [
            'title' => 'Koordinator',
            'data_pelanggan_app' => DB::table('entri_pelanggan_app')->get(),
        ];
        return view('beranda_koordinator.index', $data);
    }
    public function export_excel_app(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
    
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');
    
        return Excel::download(new APPExport($startDate, $endDate), 'APP ' . date('d-m-Y') . '.xlsx');
    }
}
