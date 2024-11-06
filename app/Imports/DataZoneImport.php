<?php

namespace App\Imports;

use App\Models\DataZoneModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DataZoneImport implements ToModel, WithStartRow, WithMultipleSheets
{
    use Importable;
    public function sheets(): array
    {
        return [
            'ZONE 8kms' => $this,
        ];
    }

    public function model(array $row)
    {
        $existingData = DataZoneModel::where('keypoint', $row[5])->first();

        if ($existingData) {
            $existingData->update($this->getData($row));
            Session::flash('error_import_keypoint', 'data keypoint sudah ada');
        } else {
            if ($this->isDuplicate($row)) {
                Session::flash('error_import_keypoint', 'Data sudah ada. Namun jika ada data tambahan lainnya, maka dapat dicek');
            } else {
                DataZoneModel::create($this->getData($row));
                Session::flash('success_import_keypoint', 'file excel keypoint berhasil diimport');
            }
        }

        return null;
    }

    private function getData(array $row)
    {
        return [
            'keypoint' => $row[5] ?? '',
            'jarak' => $row[6] ?? '',
            'latitude' => $row[8] ?? '',
            'longitude' => $row[9] ?? '',
            'google_maps' => $row[10] ?? '',
        ];
    }
    private function isDuplicate(array $data)
    {
        return DataZoneModel::where('keypoint', $data['5'])->exists();
    }

    public function startRow(): int
    {
        return 3;
    }
}
