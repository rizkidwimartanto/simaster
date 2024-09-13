<?php

namespace App\Imports;

use App\Models\DataPelangganModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DataPelangganImport implements ToModel, WithStartRow
{
    use Importable;

    public function model(array $row)
    {
        $existingData = DataPelangganModel::where('idpel', $row[0])->first();

        if ($existingData) {
            $existingData->update($this->getData($row));
            Session::flash('error_import_pelanggan', 'data pelanggan sudah ada');
        } else {
            if ($this->isDuplicate($row)) {
                Session::flash('error_import_pelanggan', 'Data sudah ada. Namun jika ada data tambahan lainnya, maka dapat dicek');
            } else {
                DataPelangganModel::create($this->getData($row));
                Session::flash('success_import_pelanggan', 'file excel pelanggan berhasil diimport');
            }
        }

        return null;
    }

    private function getData(array $row)
    {
        return [
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
        ];
    }
    private function isDuplicate(array $data)
    {
        return DataPelangganModel::where('idpel', $data['0'])->exists();
    }

    public function startRow(): int
    {
        return 2;
    }
}
