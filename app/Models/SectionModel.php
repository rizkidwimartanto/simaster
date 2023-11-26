<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionModel extends Model
{
    use HasFactory;
    protected $table = 'section';
    protected $primaryKey = 'id_section';
    protected $fillable = ['penyulang', 'nama_section', 'id_vsld', 'id_apkt', 'unit'];
}
