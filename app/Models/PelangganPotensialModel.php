<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelangganPotensialModel extends Model
{
    use HasFactory;
    protected $table = 'data_pelanggan_potensial';
    protected $primaryKey = 'id';
    protected $fillable = ['unit_ulp','od_id', 'count_unitulp', 'sum_daya'];
    public $timestamps = true;
}
