<?php

namespace App\Http\Controllers;

use App\Models\EntriPadamModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Section;
use Illuminate\Support\Facades\DB;

class EntriPadamController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Peta Padam',
            'data_padam' => EntriPadamModel::all(),
            'jumlah_KDS21' => EntriPadamModel::where('penyulang', 'KDS21')->count() ,
            'jumlah_SYG14' => EntriPadamModel::where('penyulang', 'SYG14')->count() ,
            'id' => DB::table('entri_padam')->select('id')->get()
        ];
        return view('beranda/petapadam', $data);
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
                    'jam_padam' => $request->jam_padam,
                    'keterangan' => $request->keterangan,
                    'status' => $request->status,
                ]);
            }
            Session::flash('success_tambah', 'Data berhasil ditambah');
            return redirect('/petapadam');
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
            return redirect('/petapadam');
        } else {
            Session::flash('success_hapus', 'Data berhasil dihapus');
            return redirect('/petapadam');
        }
    }
    public function editStatusPadam(Request $request)
    {
        $update_status = request('check');
        if ($update_status) {
            foreach ($update_status as $status) {
                $status_update = EntriPadamModel::where('id', $status);
                $status_update->update([
                    'status' => $request->status
                ]);
            }
            Session::flash('success_nyala', 'Section berhasil dinyalakan');
            return redirect('/petapadam');
        } else {
            Session::flash('error_nyala', 'Section gagal dinyalakan');
            return redirect('/petapadam');
        }
    }
}
