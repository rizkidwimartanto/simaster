<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RekapKaliPadamModel extends Model
{
    use HasFactory;
    protected $table = 'entri_padam';
    public function getRekapSection()
    {
        return $this->leftJoin('section', 'entri_padam.section', '=', 'section.id_apkt')
            ->select('entri_padam.section', 'section.nama_section', DB::raw('COUNT(*) as jumlah_entri'))
            ->groupBy('section.nama_section', 'entri_padam.section')
            ->get();
    }
}
