<?php

namespace App\Imports;

use App\Models\DataPelangganModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Facades\Session;

class DataPelangganImport implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    use Importable;

    public function model(array $row)
    {
        // $existingData = DataPelangganModel::where('idpel', $row[0])->where('nama', $row[1])->first();
        if ($this->isDuplicate($row)) {
            // Data sudah ada, tambahkan pesan kesalahan ke dalam session
            Session::flash('error', 'Data sudah ada. Namun jika ada data tambahan lainnya, maka dapat dicek');
            return null;
        }
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

    private function isDuplicate(array $data)
    {
        // Contoh validasi: Cek apakah data sudah ada dalam database berdasarkan beberapa kolom
        $existingData = DataPelangganModel::where('idpel', $data['0'])
            ->where('nama', $data['1'])
            ->first();

        return $existingData !== null;
    }
    public function startRow(): int
    {
        return 2;
    }
}
