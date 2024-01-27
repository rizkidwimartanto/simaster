<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPegawaiModel extends Model
{
    use HasFactory;
    protected $table = 'data_pegawai';
    protected $primaryKey = 'id';
    protected $fillable = ['id_pegawai', 'nama_pegawai', 'jabatan_pegawai', 'unit_pegawai', 'nomortelepon_pegawai'];
}
