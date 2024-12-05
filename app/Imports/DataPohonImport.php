<?php

namespace App\Imports;

use App\Models\DataPohonModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DataPohonImport implements ToModel, WithStartRow, WithMultipleSheets
{
    use Importable;
    public function sheets(): array
    {
        return [
            'UP3' => $this,
        ];
    }

    public function model(array $row)
    {
        $existingData = DataPohonModel::where('tiang_section', $row[3])->first();

        if ($existingData) {
            $existingData->update($this->getData($row));
            Session::flash('error_import_data_pohon', 'data sudah ada');
        } else {
            if ($this->isDuplicate($row)) {
                Session::flash('error_import_data_pohon', 'Data sudah ada. Namun jika ada data tambahan lainnya, maka dapat dicek');
            } else {
                DataPohonModel::create($this->getData($row));
                Session::flash('success_import_data_pohon', 'file excel berhasil diimport');
            }
        }

        return null;
    }

    private function getData(array $row)
    {
        return [
            'tiang_section' => $row[3] ?? '',
            'latitude' => $row[4] ?? '',
            'longitude' => $row[5] ?? '',
            'rayon' => $row[6] ?? '',
            'perlu_rabas' => $row[7] ?? '',
        ];
    }
    private function isDuplicate(array $data)
    {
        return DataPohonModel::where('tiang_section', $data['3'])->exists();
    }

    public function startRow(): int
    {
        return 2;
    }
}
