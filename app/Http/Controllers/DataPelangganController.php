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
        $rekap_pelanggan = DB::table('entri_padam')
            ->leftJoin('data_pelanggan', 'entri_padam.section', '=', 'data_pelanggan.nama_section')
            ->select('data_pelanggan.idpel', 'data_pelanggan.nama', 'data_pelanggan.alamat', 'data_pelanggan.nohp_stakeholder', 'entri_padam.penyebab_padam', 'entri_padam.keterangan', 'entri_padam.section', 'entri_padam.penyulang')
            ->groupBy('data_pelanggan.idpel', 'data_pelanggan.nama', 'data_pelanggan.alamat', 'data_pelanggan.nohp_stakeholder', 'entri_padam.penyebab_padam', 'entri_padam.keterangan', 'entri_padam.section', 'entri_padam.penyulang')
            ->where('entri_padam.status', '=', 'Padam')
            ->get();

        $target = '';
        foreach ($rekap_pelanggan as $rekap) {
            if (!empty($rekap->nohp_stakeholder)) {
                $target .= $rekap->nohp_stakeholder . ',';
            }
        }
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => [
                'target' => $target,
                'message' => 'test message',
                'delay' => '2',
                'countryCode' => '62', //optional
            ],
            CURLOPT_HTTPHEADER => [
                'Authorization: Z5oA!jnyvg#y7qcSa3B7', //change TOKEN to your actual token
            ],
        ]);

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;

        $penyulangs = [];
        foreach ($data_penyulang as $penyulang) {
            $penyulangs[$penyulang] = SectionModel::where('penyulang', $penyulang)->pluck('id_apkt');
        }
        $data = [
            'title' => 'Entri Padam',
            'section' => $penyulangs,
            'data_pelanggan' => DataPelangganModel::all(),
            'data_penyulang' => SectionModel::pluck('penyulang'),
            'rekap_pelanggan' => $rekap_pelanggan,
            'data_section' => PenyulangModel::all(),
        ];
        return view('beranda/entripadam', $data);
    }
    public function input_pelanggan()
    {
        $data_pelanggan = DataPelangganModel::all();

        $data = [
            'title' => 'Updating',
            'data_pelanggan' => $data_pelanggan,
        ];
        return view('beranda/inputpelanggan', $data);
    }
    public function export_excel()
    {
        date_default_timezone_set('Asia/Jakarta');
        return Excel::download(new DataPelangganExport, 'PELANGGAN TM UP3 DEMAK '  . date('d-m-Y') . '.xlsx');
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
    public function hapusPelanggan(Request $request)
    {
        $hapus_items = $request->input('checkPelanggan');
        if ($hapus_items) {
            foreach ($hapus_items as $hapus) {
                $pelanggan = DataPelangganModel::find($hapus);
                $pelanggan->delete();
            }
            Session::flash('success_hapus_pelanggan', 'Data berhasil dihapus');
        } else {
            Session::flash('error_hapus_pelanggan', 'Data gagal dihapus');
        }
        return redirect('/inputpelanggan');
    }
}
