<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPelangganModel extends Model
{
    use HasFactory;

    protected $table = 'data_pelanggan';
    protected $fillable = ['idpel','nama', 'alamat', 'unitup1', 'unitap', 'unitup', 'tarif', 'daya', 'kogol', 'fakmkwh', 'rpbp', 'rpujl', 'pemda', 'nomorkwh', 'statusplg', 'kdpembmeter', 'penyulang', 'nama_section'];
}
