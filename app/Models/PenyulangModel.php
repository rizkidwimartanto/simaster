<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenyulangModel extends Model
{
    use HasFactory;
    protected $table = 'penyulang';
    protected $primaryKey = 'id_penyulang';
    protected $fillable = ['gi', 'penyulang'];
}
