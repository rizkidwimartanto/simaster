<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WANotifModel extends Model
{
    use HasFactory;
    protected $table = 'wanotif';
    protected $primaryKey = 'id';
    protected $fillable = ['idserial','idpel', 'idunit'];
}
