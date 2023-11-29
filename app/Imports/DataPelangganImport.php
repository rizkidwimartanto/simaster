<?php

namespace App\Imports;

use App\Models\DataPelangganModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DataPelangganImport implements ToModel, WithStartRow, WithMultipleSheets
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    use Importable;

    public function model(array $row)
    {
        if ($this->isDuplicate($row)) {
            Session::flash('error_import', 'Data sudah ada. Namun jika ada data tambahan lainnya, maka dapat dicek');
            return null;
        } else {
            Session::flash('success_import', 'File Excel Berhasil Diimport');
            return new DataPelangganModel([
                'idpel' => $row[0],
                'nama' => $row[1],
                'nama_stakeholder' => $row[2],
                'jenis_stakeholder' => $row[3],
                'nohp_stakeholder' => $row[4],
                'namapic_lapangan' => $row[5],
                'nohp_piclapangan' => $row[6],
                'alamat' => $row[7],
                'maps' => $row[8],
                'latitude' => $row[9],
                'longtitude' => $row[10],
                'no_telepon' => $row[11],
                'unitulp' => $row[12],
                'tarif' => $row[13],
                'daya' => $row[14],
                'kogol' => $row[15],
                'fakmkwh' => $row[16], 
                'rpbp' => $row[17], 
                'rpujl' => $row[18], 
                'nomor_kwh' => $row[19],  
                'penyulang' => $row[20], 
                'nama_section' => $row[21],
                'tipe_kubikel' => $row[22],
            ]);
        }
    }

    private function isDuplicate(array $data)
    {
        $existingData = DataPelangganModel::where('idpel', $data['0'])
            ->where('nama', $data['1'])
            ->first();

        return $existingData !== null;
    }
    public function sheets(): array{
        return[
            'Agustus 2023' => new DataPelangganImport()
        ];
    }
    public function startRow(): int
    {
        return 2;
    }
}
