<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPelangganModel extends Model
{
    use HasFactory;

    protected $table = 'data_pelanggan';
    protected $primaryKey = 'id';
    protected $fillable = ['idpel', 'nama', 'alamat', 'maps', 'latitude', 'longtitude'];
}
