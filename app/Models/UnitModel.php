<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitModel extends Model
{
    use HasFactory;
    protected $table = 'unit';
    protected $primaryKey = 'id';
    protected $fillable = ['id_unit','nama_unit', 'nohp_mulp', 'nohp_tlteknik'];
}
