<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataTiangTMModel extends Model
{
    use HasFactory;
    protected $table = 'data_tiang_tm';
    protected $primaryKey = 'id';
    protected $fillable = [
        'global_id',
        'asset_group',
        'asset_type',
        'description',
        'penyulang',
        'parent_lokasi',
        'formatted_address',
        'street_address',
        'city',
        'latitude',
        'longitude',
        'kode_konstruksi_1',
        'kode_konstruksi_2',
        'kode_konstruksi_3',
        'kode_konstruksi_4',
        'type_pondasi',
        'jenis_tiang',
        'ukuran_tiang',
    ];
}
