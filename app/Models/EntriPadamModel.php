<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntriPadamModel extends Model
{
    use HasFactory;

    protected $table = 'entri_padam';
    protected $primaryKey = 'id';
    protected $fillable = ['penyulang', 'section', 'penyebab_padam', 'jam_padam' ,'keterangan', 'status'];
    public function nomorTiang()
    {
        return $this->belongsTo(SectionModel::class, 'section', 'id_apkt');
    }
}
