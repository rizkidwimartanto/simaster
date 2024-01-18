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
    use Importable;

    public function model(array $row)
    {
        $existingData = DataPelangganModel::where('idpel', $row[0])
            ->where('nama', $row[1])
            ->first();

        if ($existingData) {
            $existingData->update([
                'nama_stakeholder' => $row[2],
                'jenis_stakeholder' => $row[3],
                'nohp_stakeholder' => $row[4],
                'namapic_lapangan' => $row[5],
                'nohp_piclapangan' => $row[6],
                'alamat' => $row[7],
                'maps' => $row[8],
                'latitude' => $row[9],
                'longtitude' => $row[10],
                'unitulp' => $row[11],
                'tarif' => $row[12],
                'daya' => $row[13],
                'kogol' => $row[14],
                'fakmkwh' => $row[15], 
                'rpbp' => $row[16], 
                'rpujl' => $row[17], 
                'nomor_kwh' => $row[18],  
                'penyulang' => $row[19], 
                'nama_section' => $row[20],
                'tipe_kubikel' => $row[21],
            ]);

            Session::flash('success_import', 'File Excel Berhasil Diimport (Data diperbarui)');
        } else {
            if ($this->isDuplicate($row)) {
                Session::flash('error_import', 'Data sudah ada. Namun jika ada data tambahan lainnya, maka dapat dicek');
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
                    'unitulp' => $row[11],
                    'tarif' => $row[12],
                    'daya' => $row[13],
                    'kogol' => $row[14],
                    'fakmkwh' => $row[15], 
                    'rpbp' => $row[16], 
                    'rpujl' => $row[17], 
                    'nomor_kwh' => $row[18],  
                    'penyulang' => $row[19], 
                    'nama_section' => $row[20],
                    'tipe_kubikel' => $row[21],
                ]);
            }
        }

        return null;
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
            'Data Pelanggan TM' => new DataPelangganImport()
        ];
    }

    public function startRow(): int
    {
        return 2;
    }
}
