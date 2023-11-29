<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\DataPelangganExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Imports\DataPelangganImport;
use App\Models\DataPelangganModel;
use App\Models\EntriPadamModel;
use App\Models\PenyulangModel;
use App\Models\SectionModel;
use Illuminate\Support\Facades\Session;


class DataPelangganController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Peta Pelanggan', 
            'data_pelanggan' => DataPelangganModel::all(),
            'data_padam' => EntriPadamModel::all()
        ];
        return view('beranda/index', $data);
    }
    public function entri_padam(){
        $data_penyulang = SectionModel::pluck('penyulang');
        $penyulangs = [];
        foreach($data_penyulang as $penyulang){
            $penyulangs[$penyulang] = SectionModel::where('penyulang', $penyulang)->pluck('id_apkt');
        }
        $data = [
            'title' => 'Entri Padam', 
            'section' => $penyulangs,
            'data_pelanggan' => DataPelangganModel::all(),
            'data_penyulang' => SectionModel::pluck('penyulang'),
            'data_section' => PenyulangModel::all(),
        ];
        return view('beranda/entripadam', $data);
    }
    public function input_pelanggan()
    {
        $data = [
            'title' => 'Input Pelanggan',
            'data_pelanggan' => DataPelangganModel::all(),
        ];
        return view('beranda/inputpelanggan', $data);
    }
    public function export_excel()
    {
        return Excel::download(new DataPelangganExport, 'PELANGGAN TM UP3 DEMAK AGT 23.xlsx');
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

        return redirect('/inputpelanggan');
    }
    public function hapusPelanggan(){
        $hapus_items = request('check');
        if($hapus_items){
            foreach($hapus_items as $hapus){
                $pelanggan = DataPelangganModel::find($hapus);
                $pelanggan->delete();
            }
            Session::flash('success_hapus', 'Data berhasil dihapus');
            return redirect('/inputpelanggan');
        }else{
            Session::flash('error_hapus', 'Data gagal dihapus');
            return redirect('/inputpelanggan');
        }
    }
}
