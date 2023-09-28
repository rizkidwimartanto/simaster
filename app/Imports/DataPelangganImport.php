<?php

namespace App\Imports;

use App\Models\DataPelangganModel;
use Maatwebsite\Excel\Concerns\ToModel;

class DataPelangganImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new DataPelangganModel([
            'idpel' => $row[0],
            'nama' => $row[1],
            'alamat' => $row[2], 
            'unitup1' => $row[3], 
            'unitap' => $row[4], 
            'unitup' => $row[5], 
            'tarif' => $row[6], 
            'daya' => $row[7], 
            'kogol' => $row[8], 
            'fakmkwh' => $row[9], 
            'rpbp' => $row[10], 
            'rpujl' => $row[11], 
            'pemda' => $row[12], 
            'nomorkwh' => $row[13], 
            'statusplg' => $row[14], 
            'kdpembmeter' => $row[15], 
            'penyulang' => $row[16], 
            'nama_section' => $row[17], 
        ]);
    }
}
