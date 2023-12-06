<?php

namespace App\Imports;

use App\Models\PenyulangModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class PenyulangImport implements ToModel, WithStartRow, WithMultipleSheets
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
            return new PenyulangModel([
                'id_penyulang' => $row[0],
                'gi' => $row[1],
                'penyulang' => $row[2],
            ]);
        }
    }

    private function isDuplicate(array $data)
    {
        $existingData = PenyulangModel::where('id_penyulang', $data['0'])
            ->where('gi', $data['1'])
            ->first();

        return $existingData !== null;
    }
    public function sheets(): array{
        return[
            'penyulang' => new PenyulangImport()
        ];
    }
    public function startRow(): int
    {
        return 2;
    }
}
