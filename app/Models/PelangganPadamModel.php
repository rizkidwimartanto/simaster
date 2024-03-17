<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PelangganPadamModel extends Model
{
    use HasFactory;
    protected $table = 'entri_padam';
    public function getPelangganModel()
    {
        return $this->leftJoin('data_pelanggan', 'entri_padam.section', '=', 'data_pelanggan.nama_section')
            ->select('data_pelanggan.nohp_stakeholder', 'data_pelanggan.nama', 'entri_padam.penyebab_padam', 'entri_padam.keterangan', 'entri_padam.pesan_whatsapp')
            ->groupBy('data_pelanggan.nohp_stakeholder', 'data_pelanggan.nama', 'entri_padam.penyebab_padam', 'entri_padam.keterangan', 'entri_padam.pesan_whatsapp')
            ->get();
    }
    public function getPelangganPadam()
    {
        return $this->leftJoin('data_pelanggan', 'entri_padam.section', '=', 'data_pelanggan.nama_section')
            ->select('data_pelanggan.nohp_stakeholder', 'data_pelanggan.nama', 'entri_padam.penyebab_padam', 'entri_padam.keterangan', 'entri_padam.pesan_whatsapp')
            ->groupBy('data_pelanggan.nohp_stakeholder', 'data_pelanggan.nama', 'entri_padam.penyebab_padam', 'entri_padam.keterangan', 'entri_padam.pesan_whatsapp')
            ->where('entri_padam.status', '=', 'Padam')
            ->get();
    }
}
