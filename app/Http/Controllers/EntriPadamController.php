<?php

namespace App\Http\Controllers;

use Twilio\Rest\Client;
use App\Exports\PelangganPadamExport;
use App\Exports\SectionExport;
use App\Models\EntriPadamModel;
use App\Models\DataPelangganModel;
use Illuminate\Support\Facades\Session;
use App\Imports\DataPelangganImport;
use App\Imports\PenyulangImport;
use App\Imports\SectionImport;
use App\Models\PelangganPadamModel;
use App\Models\RekapKaliPadamModel;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Section;
use EntriPadam;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;


class EntriPadamController extends Controller
{
    public function index()
    {
        $data_padam = EntriPadamModel::all();
        $rekap_section = DB::table('entri_padam')
            ->leftJoin('section', 'entri_padam.section', '=', 'section.id_apkt')
            ->select('section.nama_section', 'entri_padam.section', DB::raw('COUNT(*) as jumlah_entri'))
            ->groupBy('section.nama_section', 'entri_padam.section')
            ->get();
        foreach ($rekap_section as $item_section) {
            DB::table('entri_padam')
                ->where('section', $item_section->section)
                ->update(['kalipadam' => $item_section->jumlah_entri]);
        }
        foreach ($data_padam as $data) {
            $waktuPadam = strtotime($data->jam_padam);
            $waktuNyala = strtotime($data->jam_nyala);
            $durasiDetik = $waktuNyala - $waktuPadam;

            $durasiJam = floor($durasiDetik / (60 * 60));
            $durasiMenit = floor(($durasiDetik % (60 * 60)) / 60);
            $durasiPadam = $durasiJam . ' jam ' . $durasiMenit . ' menit';
            EntriPadamModel::where('id', $data->id)->update(['durasi_padam' => $durasiPadam]);
        }

        $data = [
            'title' => 'Transaksi Padam',
            'data_padam' => $data_padam,
            'rekap_section' => $rekap_section,
        ];

        return view('beranda/transaksipadam', $data);
        // return response()->json($data);
    }
    public function transaksiaktif()
    {
        $data_padam = EntriPadamModel::all();
        // ->where(function ($query) {
        //     $query->where('entri_padam.status', '=', 'Menyala')
        //         ->orWhere('entri_padam.status', '=', 'Padam');
        // })
        $rekap_pelanggan = DB::table('entri_padam')
            ->leftJoin('data_pelanggan', 'entri_padam.section', '=', 'data_pelanggan.nama_section')
            ->select('data_pelanggan.idpel', 'data_pelanggan.nama', 'data_pelanggan.alamat', 'data_pelanggan.nohp_stakeholder', 'entri_padam.penyebab_padam', 'entri_padam.keterangan', 'entri_padam.section')
            ->groupBy('data_pelanggan.idpel', 'data_pelanggan.nama', 'data_pelanggan.alamat', 'data_pelanggan.nohp_stakeholder', 'entri_padam.penyebab_padam', 'entri_padam.keterangan', 'entri_padam.section')
            ->where('entri_padam.status', '=', 'Padam')
            ->get();
        $data = [
            'title' => 'Transaksi Aktif',
            'data_padam' => $data_padam,
            'rekap_pelanggan' => $rekap_pelanggan
        ];
        return view('beranda/transaksiaktif', $data);
    }
    public function insertEntriPadam(Request $request)
    {
        // $sid    = "AC2012d29d75db2ed14b5e2c86524bff0a";
        // $token  = "9bd3947099e72f5b9f78a420174e837a";
        // $twilio = new Client($sid, $token);
        $message = [
            'required' => ':attribute harus diisi',
            'max' => ':attribute maximal 255 kata',
            'min' => ':attribute minimal 2 kata',
            'email' => ':attribute tidak valid',
        ];
        $validateData = $request->validate([
            'penyulang' => 'required',
            'section' => 'required',
            'penyebab_padam' => 'required',
            'jam_padam' => 'required',
            'keterangan' => 'required',
        ], $message);
        if ($request->has('section')) {
            $sections = $request->input('section');
            foreach ($sections as $section) {
                EntriPadamModel::create([
                    'section' => $section,
                    'penyulang' => $request->penyulang,
                    'penyebab_padam' => $request->penyebab_padam,
                    'jam_padam' => date("d-m-Y H:i", strtotime(str_replace('T', ' ', $request->jam_padam))),
                    'keterangan' => $request->keterangan,
                    'status' => $request->status,
                    $validateData
                ]);
            }
            // $twilio->messages
            // ->create("whatsapp:+6289531584234", // to
            //   array(
            //     "from" => "whatsapp:+14155238886",
            //     "body" => 'Hello World'
            //   )
            // );
            Session::flash('success_tambah', 'Data berhasil ditambah');
            return redirect('/entripadam');
        } else {
            Session::flash('error_tambah', 'Data berhasil ditambah');
            return redirect('/entripadam');
        }
    }
    public function hapusEntriPadam()
    {
        $hapus_entri = request('check');
        if ($hapus_entri) {
            foreach ($hapus_entri as $hapus) {
                $padam = EntriPadamModel::find($hapus);
                $padam->delete();
            }
            Session::flash('success_hapus', 'Data berhasil dihapus');
            return redirect('/transaksipadam');
        } else {
            Session::flash('success_hapus', 'Data berhasil dihapus');
            return redirect('/transaksipadam');
        }
    }
    public function editStatusPadam(Request $request)
    {
        $message = [
            'required' => ':attribute harus diisi',
            'max' => ':attribute maximal 255 kata',
            'min' => ':attribute minimal 2 kata',
            'email' => ':attribute tidak valid',
        ];
        $request->validate([
            'jam_nyala' => 'required',
            'penyebab_fix' => 'required',
        ], $message);
        $update_status = request('check');
        $penyebab_fix = $request->input('penyebab_fix');
        $jam_nyala = date("d-m-Y H:i", strtotime(str_replace('T', ' ', $request->input('jam_nyala'))));
        if ($update_status) {
            foreach ($update_status as $status) {
                $status_update = EntriPadamModel::where('id', $status);
                $status_update->update([
                    'status' => $request->status,
                    'jam_nyala' => $jam_nyala,
                    'penyebab_fix' => $penyebab_fix,
                ]);
            }
            Session::flash('success_nyala', 'Section berhasil dinyalakan');
            return redirect('/transaksipadam');
        } else {
            Session::flash('error_nyala', 'Section gagal dinyalakan');
            return redirect('/transaksiaktif');
        }
    }
    public function petapadam()
    {
        $padam = DB::table('data_pelanggan')
        ->leftJoin('entri_padam', 'data_pelanggan.nama_section' , '=', 'entri_padam.section')
        ->select('data_pelanggan.nama', 'data_pelanggan.id', 'data_pelanggan.alamat', 'data_pelanggan.maps', 'data_pelanggan.latitude', 'data_pelanggan.longtitude', 'entri_padam.section')
        ->where('entri_padam.status', '=', 'Padam')
        ->get();

        $data = [
            'title' => 'Peta Padam',
            'padam' => $padam,
        ];
        return view('beranda/petapadam', $data);
    }
    public function import_excel_penyulangsection(Request $request)
    {
        $this->validate($request, [
            'file_penyulang' => 'required|mimes:csv,xls,xlsx',
            'file_section' => 'required|mimes:csv,xls,xlsx'
        ]);
        $file_penyulang = $request->file('file_penyulang');
        $file_section = $request->file('file_section');
        $nama_file_penyulang = rand() . $file_penyulang->getClientOriginalName();
        $nama_file_section = rand() . $file_section->getClientOriginalName();
        $file_penyulang->move('file_penyulang', $nama_file_penyulang);
        $file_section->move('file_section', $nama_file_section);
        Excel::import(new PenyulangImport, public_path('/file_penyulang/' . $nama_file_penyulang));
        Excel::import(new SectionImport, public_path('/file_section/' . $nama_file_section));

        return redirect('/entripadam');
    }
    public function export_kali_padam()
    {
        $rekapKaliPadamModel = new RekapKaliPadamModel();
        $rekapkaliPadam = $rekapKaliPadamModel->getRekapSection();
        date_default_timezone_set('Asia/Jakarta');
        return Excel::download(new SectionExport($rekapkaliPadam), 'Section_Jumlah_Padam '  . date('d-m-Y') . '.xlsx');
    }
    public function export_pelanggan_padam()
    {
        $pelangganPadamModel = new PelangganPadamModel();
        $pelangganPadam = $pelangganPadamModel->getPelangganModel();
        date_default_timezone_set('Asia/Jakarta');
        return Excel::download(new PelangganPadamExport($pelangganPadam), 'Pelanggan_Padam ' . date('d-m-Y') . '.xlsx');
    }
    public function export_pelanggan_padam_csv()
    {
        $pelangganPadamModel = new PelangganPadamModel();
        $pelangganPadam = $pelangganPadamModel->getPelangganModel();
        date_default_timezone_set('Asia/Jakarta');
        return Excel::download(new PelangganPadamExport($pelangganPadam), 'Pelanggan_Padam ' . date('d-m-Y') . '.csv');
    }
}
