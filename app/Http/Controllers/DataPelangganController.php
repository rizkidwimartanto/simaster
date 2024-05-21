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
use App\Models\UnitModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Twilio\Rest\Client;


class DataPelangganController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Peta Pelanggan',
            'data_padam' => DB::table('entri_padam')->select('status', 'section')->get(),
            'data_peta' => DB::table('data_pelanggan')->select('id', 'nama', 'alamat', 'maps', 'latitude', 'longtitude', 'nama_section', 'nohp_stakeholder', 'unitulp')->get(),
            'data_unitulp' => DataPelangganModel::pluck('unitulp')
        ];
        return view('beranda/index', $data);
    }

    public function entri_padam()
    {
        $data_penyulang = SectionModel::pluck('penyulang')->unique();
        $penyulangs = $data_penyulang->mapWithKeys(function ($penyulang) {
            return [$penyulang => SectionModel::where('penyulang', $penyulang)->pluck('id_apkt')];
        });

        DB::table('entri_padam')->update(['status_wa' => 'Sudah Terkirim']);

        $data = [
            'title' => 'Entri Padam',
            'section' => $penyulangs,
            'nama_pelanggan' => DataPelangganModel::pluck('nama'),
            'data_penyulang' => $data_penyulang,
            'data_section' => PenyulangModel::all(),
        ];
        return view('beranda/entripadam', $data);
    }

    public function updating()
    {
        $data = [
            'title' => 'Updating',
            'data_pelanggan' => DataPelangganModel::all(),
            'data_trafo' => TrafoModel::all(),
            'data_unit' => UnitModel::all(),
        ];
        return view('beranda/updating', $data);
    }
    public function tambah_unit(Request $request)
    {
        $message = ['required' => ':attribute harus diisi'];
        $validateData = $request->validate([
            'nama_unit' => 'required',
            'nohp_mulp' => 'required',
            'nohp_tlteknik' => 'required',
        ], $message);

        if ($validateData) {
            UnitModel::create([
                'id_unit' => $request->input('id_unit'),  // Assuming this is required. Normally, this should be auto-incremented.
                'nama_unit' => $request->input('nama_unit'),
                'nohp_mulp' => $request->input('nohp_mulp'),
                'nohp_tlteknik' => $request->input('nohp_tlteknik'),
            ]);

            Session::flash('success_tambah_unit', 'Unit berhasil ditambahkan');
        } else {
            Session::flash('error_tambah_unit', 'Unit gagal ditambahkan');
        }
        return redirect('/updating');
    }

    public function edit_pelanggan(Request $request, $id)
    {
        DataPelangganModel::find($id)->update($request->all());
        Session::flash('success_edit', 'Data berhasil diedit');
        return redirect('/updating');
    }
    public function edit_trafo(Request $request, $id)
    {
        TrafoModel::find($id)->update($request->all());
        Session::flash('success_edit', 'Data berhasil diedit');
        return redirect('/updating');
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
            Session::flash('success_hapus', 'Data berhasil dihapus bro');
        } else {
            Session::flash('error_hapus', 'Data gagal dihapus bro');
        }
        return redirect('/updating');
    }
}
