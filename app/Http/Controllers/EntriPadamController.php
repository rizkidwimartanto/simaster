<?php

namespace App\Http\Controllers;

use App\Models\EntriPadamModel;
use App\Models\DataPelangganModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Section;
use Illuminate\Support\Facades\DB;

class EntriPadamController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Transaksi Padam',
            'data_padam' => EntriPadamModel::all(),
            'jumlah_KDS21' => EntriPadamModel::where('penyulang', 'KDS21')->count() ,
            'jumlah_SYG14' => EntriPadamModel::where('penyulang', 'SYG14')->count() ,
            'id' => DB::table('entri_padam')->select('id')->get()
        ];
        return view('beranda/transaksipadam', $data);
    }
    public function insertEntriPadam(Request $request)
    {
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
                ]);
            }
            Session::flash('success_tambah', 'Data berhasil ditambah');
            return redirect('/transaksipadam');
        }else{
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
        $update_status = request('check');
        if ($update_status) {
            foreach ($update_status as $status) {
                $status_update = EntriPadamModel::where('id', $status);
                $status_update->update([
                    'status' => $request->status,
                    'jam_nyala' => $request->jam_nyala
                ]);
            }
            Session::flash('success_nyala', 'Section berhasil dinyalakan');
            return redirect('/transaksipadam');
        } else {
            Session::flash('error_nyala', 'Section gagal dinyalakan');
            return redirect('/transaksipadam');
        }
    }
    public function petapadam(){
        $data = [
            'title' => 'Peta Padam',
            'data_padam' => EntriPadamModel::all(),
            'data_pelanggan' => DataPelangganModel::all(),
            'jumlah_KDS21' => EntriPadamModel::where('penyulang', 'KDS21')->count() ,
            'jumlah_SYG14' => EntriPadamModel::where('penyulang', 'SYG14')->count() ,
            'id' => DB::table('entri_padam')->select('id')->get(),
        ];
        return view('beranda/petapadam', $data);
    }
}
