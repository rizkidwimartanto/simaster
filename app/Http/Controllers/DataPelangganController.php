<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\DataPelangganExport;
use App\Exports\TrafoExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Imports\DataPelangganImport;
use App\Imports\TrafoImport;
use App\Models\DataPelangganModel;
use App\Models\EntriPadamModel;
use App\Models\PenyulangModel;
use App\Models\SectionModel;
use App\Models\TrafoModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Twilio\Rest\Client;


class DataPelangganController extends Controller
{
    public function index()
    {
        $data_peta = DB::table('data_pelanggan')
            ->select('data_pelanggan.id', 'data_pelanggan.nama', 'data_pelanggan.alamat', 'data_pelanggan.maps', 'data_pelanggan.latitude', 'data_pelanggan.longtitude', 'data_pelanggan.nama_section', 'data_pelanggan.nohp_stakeholder', 'data_pelanggan.unitulp')
            ->get();
        $data_padam = DB::table('entri_padam')
            ->select('entri_padam.status', 'entri_padam.section')
            ->get();
        $data = [
            'title' => 'Peta Pelanggan',
            'data_padam' => $data_padam,
            'data_peta' => $data_peta,
            'data_unitulp' => DataPelangganModel::pluck('unitulp')
        ];
        return view('beranda/index', $data);
    }
    public function entri_padam()
    {
        $data_penyulang = SectionModel::pluck('penyulang');

        $penyulangs = [];
        foreach ($data_penyulang as $penyulang) {
            $penyulangs[$penyulang] = SectionModel::where('penyulang', $penyulang)->pluck('id_apkt');
        }
        $data = [
            'title' => 'Entri Padam',
            'section' => $penyulangs,
            'nama_pelanggan' => DataPelangganModel::pluck('nama'),
            'data_penyulang' => SectionModel::pluck('penyulang'),
            'data_section' => PenyulangModel::all(),
        ];
        return view('beranda/entripadam', $data);
    }
    public function updating()
    {
        $data_pelanggan = DataPelangganModel::all();
        $data_trafo = TrafoModel::all();

        $data = [
            'title' => 'Updating',
            'data_pelanggan' => $data_pelanggan,
            'data_trafo' => $data_trafo,
        ];
        return view('beranda/updating', $data);
    }
    public function edit_pelanggan(Request $request, $id)
    {
        // $message = [
        //     'required' => ':attribute harus diisi',
        // ];
        // $validasiPelanggan = $request->validate([
        //     'nama' => 'required',
        //     'alamat' => 'required',
        //     'nohp_stakeholder' => 'required',
        //     'nohp_piclapangan' => 'required',
        //     'latitude' => 'required',
        //     'longtitude' => 'required',
        //     'tarif' => 'required',
        //     'daya' => 'required',
        //     'kogol' => 'required',
        //     'fakmkwh' => 'required',
        //     'rpbp' => 'required',
        //     'rpujl' => 'required',
        //     'nomor_kwh' => 'required',
        //     'penyulang' => 'required',
        //     'nama_section' => 'required',
        // ], $message);
        // if ($validasiPelanggan) {
            DataPelangganModel::find($id)
            ->update([
                'nama' => $request->input('nama'),
                'alamat' => $request->input('alamat'),
                'nohp_stakeholder' => $request->input('nohp_stakeholder'),
                'nohp_piclapangan' => $request->input('nohp_piclapangan'),
                'latitude' => $request->input('latitude'),
                'longtitude' => $request->input('longtitude'),
                'tarif' => $request->input('tarif'),
                'daya' => $request->input('daya'),
                'kogol' => $request->input('kogol'),
                'fakmkwh' => $request->input('fakmkwh'),
                'rpbp' => $request->input('rpbp'),
                'rpujl' => $request->input('rpujl'),
                'nomor_kwh' => $request->input('nomor_kwh'),
                'penyulang' => $request->input('penyulang'),
                'nama_section' => $request->input('nama_section'),
                // $validasiPelanggan
            ]);
            Session::flash('success_edit', 'Data berhasil diedit');
            return redirect('/updating');
        // } else {
        //     Session::flash('error_edit', 'Pelanggan berhasil gagal');
        //     return redirect('/updating');
        // }
    }
    public function edit_trafo(Request $request, $id)
    {
        // $message = [
        //     'required' => ':attribute harus diisi',
        // ];
        // $validasiPelanggan = $request->validate([
        //     'nama' => 'required',
        //     'alamat' => 'required',
        //     'nohp_stakeholder' => 'required',
        //     'nohp_piclapangan' => 'required',
        //     'latitude' => 'required',
        //     'longtitude' => 'required',
        //     'tarif' => 'required',
        //     'daya' => 'required',
        //     'kogol' => 'required',
        //     'fakmkwh' => 'required',
        //     'rpbp' => 'required',
        //     'rpujl' => 'required',
        //     'nomor_kwh' => 'required',
        //     'penyulang' => 'required',
        //     'nama_section' => 'required',
        // ], $message);
        // if ($validasiPelanggan) {
            TrafoModel::find($id)
            ->update([
                'unit_layanan' => $request->input('unit_layanan'),
                'penyulang' => $request->input('penyulang'),
                'no_tiang' => $request->input('no_tiang'),
                'daya' => $request->input('daya'),
                'merk' => $request->input('merk'),
                'beban_X1' => $request->input('beban_X1'),
                'beban_X2' => $request->input('beban_X2'),
                'beban_Xo' => $request->input('beban_Xo'),
                'lokasi' => $request->input('lokasi'),
                'penyebab' => $request->input('penyebab'),
                'no_pk_apkt' => $request->input('no_pk_apkt'),
                'bebanA' => $request->input('bebanA'),
                // $validasiPelanggan
            ]);
            Session::flash('success_edit', 'Data berhasil diedit');
            return redirect('/updating');
        // } else {
        //     Session::flash('error_edit', 'Pelanggan berhasil gagal');
        //     return redirect('/updating');
        // }
    }
    public function export_excel_pelanggan()
    {
        date_default_timezone_set('Asia/Jakarta');
        return Excel::download(new DataPelangganExport, 'PELANGGAN TM UP3 DEMAK '  . date('d-m-Y') . '.xlsx');
    }
    public function export_excel_trafo()
    {
        date_default_timezone_set('Asia/Jakarta');
        return Excel::download(new TrafoExport, 'Data Trafo '  . date('d-m-Y') . '.xlsx');
    }
    public function import_excel(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);
        $file = $request->file('file');
        $nama_file = rand() . $file->getClientOriginalName();
        $file->move('file_pelanggan', $nama_file);
        Excel::import(new DataPelangganImport, public_path('/file_pelanggan/' . $nama_file));

        return redirect('/updating');
    }
    public function import_excel_trafo(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);
        $file = $request->file('file');
        $nama_file = rand() . $file->getClientOriginalName();
        $file->move('file_trafo', $nama_file);
        Excel::import(new TrafoImport, public_path('/file_trafo/' . $nama_file));

        return redirect('/updating');
    }
    public function hapusPelanggan(Request $request)
    {
        $hapus_items = $request->input('checkPelanggan');
        if ($hapus_items) {
            foreach ($hapus_items as $hapus) {
                $pelanggan = DataPelangganModel::find($hapus);
                $pelanggan->delete();
            }
            Session::flash('success_hapus', 'Data berhasil dihapus');
        } else {
            Session::flash('error_hapus', 'Data gagal dihapus');
        }
        return redirect('/updating');
    }
    public function hapusTrafo(Request $request)
    {
        $hapus_items = $request->input('checkTrafo');
        if ($hapus_items) {
            foreach ($hapus_items as $hapus) {
                $trafo = TrafoModel::find($hapus);
                $trafo->delete();
            }
            Session::flash('success_hapus', 'Data berhasil dihapus');
        } else {
            Session::flash('error_hapus', 'Data gagal dihapus');
        }
        return redirect('/updating');
    }
}
