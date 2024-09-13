<?php

namespace App\Imports;

use App\Models\PelangganAPPModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Facades\Session;

class DataPelangganAPPImport implements ToModel, WithStartRow
{
    use Importable;

    public function model(array $row)
    {
        $existingData = PelangganAPPModel::where('id_pelanggan', $row[0])->first();

        if ($existingData) {
            $existingData->update($this->getData($row));
            Session::flash('error_import_pelangganAPP', 'data pelangganAPP sudah ada');
        } else {
            if ($this->isDuplicate($row)) {
                Session::flash('error_import_pelangganAPP', 'Data sudah ada. Namun jika ada data tambahan lainnya, maka dapat dicek');
            } else {
                PelangganAPPModel::create($this->getData($row));
                Session::flash('success_import_pelangganAPP', 'file excel trafo berhasil diimport');
            }
        }

        return null;
    }

    private function getData(array $row)
    {
        return [
            'id_pelanggan' => $row[0],
            'nama_pelanggan' => $row[1],
            'tarif_daya' => $row[2],
            'alamat' => $row[3],
            'latitude' => $row[4],
            'longtitude' => $row[5],
            'jenis_meter' => $row[6],
            'merk_meter' => $row[7],
            'tahun_meter' => $row[8],
            'nomor_meter' => $row[9],
            'merk_mcb' => $row[10],
            'ukuran_mcb' => $row[11],
            'no_segel' => $row[12],
            'no_gardu' => $row[13],
            'sr_deret' => $row[14],
            'unit_ulp' => $row[15],
        ];
    }
    private function isDuplicate(array $data)
    {
        return PelangganAPPModel::where('id_pelanggan', $data['0'])->exists();
    }

    public function startRow(): int
    {
        return 2;
    }
}
