<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\DataPelangganExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Imports\DataPelangganImport;
use App\Models\DataPelangganModel;

class DataPelangganController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Peta Pelanggan'
        ];
        return view('beranda/index', $data);
    }
    public function input_pelanggan()
    {
        $data = [
            'title' => 'Input Pelanggan',
            'data_pelanggan' => DataPelangganModel::all()
        ];
        return view('beranda/inputpelanggan', $data);
    }
    public function export_excel()
    {
        return Excel::download(new DataPelangganExport, 'PELANGGAN TM UP3 DEMAK AGT 23.xlsx');
    }
    public function import_excel(Request $request)
    {
        // validasi
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        // menangkap file excel
        $file = $request->file('file');

        if ($file != true) {
            return redirect('/inputpelanggan');
        } else {
            // membuat nama file unik
            $nama_file = rand() . $file->getClientOriginalName();

            // upload ke folder file_siswa di dalam folder public
            $file->move('file_pelanggan', $nama_file);

            // import data
            Excel::import(new DataPelangganImport, public_path('/file_pelanggan/' . $nama_file));

            // alihkan halaman kembali
            return redirect('/inputpelanggan');
        }
    }
}
