<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsulanRKAPModel extends Model
{
    use HasFactory;
    protected $table = 'data_usulan_rkap';
    protected $primaryKey = 'id';
    protected $fillable = ['nama_petugas','nomor_hp', 'foto', 'latitude', 'longitude', 'keterangan', 'rencana_usulan'];
    public $timestamps = true;
}
