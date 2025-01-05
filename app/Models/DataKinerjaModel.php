<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKinerjaModel extends Model
{
    use HasFactory;
    protected $table = 'data_kinerja';
    protected $primaryKey = 'id';
    protected $fillable = ['gi', 'trafo', 'daya_terpasang', 'daya_terpakai', 'daya_terpasang_terpakai_persen', 'daya_tersisa', 'daya_tersisa_persen', 'bulan'];
    public function data_gi()
    {
        return $this->hasMany(DataKinerjaModel::class, 'gi', 'gi');
    }
}
