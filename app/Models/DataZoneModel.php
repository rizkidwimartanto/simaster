<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataZoneModel extends Model
{
    use HasFactory;
    protected $table = 'data_zone';
    protected $primaryKey = 'id';
    protected $fillable = ['feeder','keypoint', 'jarak', 'latitude', 'longitude', 'google_maps'];
}
