<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MitraModel extends Model
{
      use HasFactory;

      protected $table = 'keypoint';
      protected $primaryKey = 'id';
      protected $fillable = ['penyulang','absw','jenis_keypoint', 'nomor_tiang', 'status_keypoint', 'kondisi_keypoint', 'merk', 'no_seri', 'setting_ocr', 'setting_gfr', 'setting_grupaktif', 'alamat', 'tanggal_har', 'tanggal_pasang'];
}
