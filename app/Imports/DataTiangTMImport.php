<?php

namespace App\Imports;

use App\Models\DataTiangTMModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DataTiangTMImport implements ToModel, WithStartRow, WithMultipleSheets
{
    use Importable;
    private $importedCount = 0;
    private $updatedCount = 0;
    public function sheets(): array
    {
        return [
            'Sheet1' => $this,
        ];
    }

    public function model(array $row)
    {
        $data = $this->getData($row);
        $existingData = DataTiangTMModel::updateOrCreate(
            ['global_id' => $data['global_id']],
            $data
        );

        if ($existingData->wasRecentlyCreated) {
            $this->importedCount++;
        } else {
            $this->updatedCount++;
        }

        return null;
    }

    private function getData(array $row)
    {
        return [
            'global_id' => $row[1] ?? '',
            'asset_group' => $row[2] ?? '',
            'asset_type' => $row[3] ?? '',
            'description' => $row[4] ?? '',
            'penyulang' => $row[5] ?? '',
            'parent_lokasi' => $row[6] ?? '',
            'formatted_address' => $row[7] ?? '',
            'street_address' => $row[8] ?? '',
            'city' => $row[9] ?? '',
            'latitude' => $row[10] ?? '',
            'longitude' => $row[11] ?? '',
            'kode_konstruksi_1' => $row[12] ?? '',
            'kode_konstruksi_2' => $row[13] ?? '',
            'kode_konstruksi_3' => $row[14] ?? '',
            'kode_konstruksi_4' => $row[15] ?? '',
            'type_pondasi' => $row[16] ?? '',
            'jenis_tiang' => $row[17] ?? '',
            'ukuran_tiang' => $row[18] ?? '',
        ];
    }

    public function startRow(): int
    {
        return 2;
    }
    public function __destruct()
    {
        Session::flash('success_import_data_tiang_tm', "{$this->importedCount} data baru ditambahkan");
    }
}
