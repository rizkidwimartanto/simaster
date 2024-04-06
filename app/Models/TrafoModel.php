<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrafoModel extends Model

{
    use HasFactory;

    protected $table = 'data_trafo';
    protected $primaryKey = 'id';
    protected $fillable = ['kategori', 'gi', 'unit_layanan', 'penyulang', 'no_tiang', 'no_gardu_distribusi', 'tipe_belitan_trafo', 'jam_padam', 'jam_nyala', 'latitude', 'longtitude', 'lama_padam', 'daya','merk','no_seri','tahun_pasang','beban_X1', 'beban_X2', 'beban_Xo', 'lokasi', 'penyebab', 'no_pk_apkt', 'bebanA', 'kva_aset', 'waktu_ukur', 'jumlah_jurusan', 'fasa', 'beban_jurusan_X1', 'beban_jurusan_N', 'perhitungan_beban', 'klasifikasi_beban', 'beban_ampere', 'kesesuaian'];
}
