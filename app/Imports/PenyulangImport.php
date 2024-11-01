<?php

namespace App\Imports;

use App\Models\PenyulangModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class PenyulangImport implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    use Importable;

    public function model(array $row)
    {
        $existingData = PenyulangModel::where('penyulang', $row[2])
        ->where('gi', $row[1])
        ->first();

        if ($existingData) {
            $existingData->update([
                'penyulang' => $row[2],
            ]);

            Session::flash('error_import_penyulang', 'data penyulang sudah ada');
        } else {
            if ($this->isDuplicate($row)) {
                Session::flash('error_import_penyulang', 'Data sudah ada. Namun jika ada data tambahan lainnya, maka dapat dicek');
            } else {
                Session::flash('success_import_penyulang', 'file excel penyulang berhasil diimport');
                return new PenyulangModel([
                    'id_penyulang' => $row[0] ?? '',
                    'gi' => $row[1] ?? '',
                    'penyulang' => $row[2] ?? '',
                ]);
            }
        }

        return null;
    }

    private function isDuplicate(array $data)
    {
        $existingData = PenyulangModel::where('penyulang', $data[2])
            ->where('gi', $data[1])
            ->first();

        return $existingData !== null;
    }
    public function startRow(): int
    {
        return 2;
    }
}