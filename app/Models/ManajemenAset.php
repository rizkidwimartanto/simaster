<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManajemenAset extends Model
{
    use HasFactory;
    protected $table = 'data_aset';
    protected $primaryKey = 'id';
    protected $fillable = ['ulp', 'kms_jtm', 'kms_jtr', 'jumlah_trafo', 'total_daya_trafo', 'sr', 'jumlah_tiang_tm', 'jumlah_tiang_tr'];
}
