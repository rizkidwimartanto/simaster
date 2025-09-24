<?php

namespace App\Imports;

use App\Models\DataTiangTMModel;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class DataTiangTMImport implements 
    ToModel, 
    WithStartRow, 
    WithMultipleSheets, 
    WithBatchInserts, 
    WithChunkReading
{
    use Importable;

    private $importedCount = 0;
    private $updatedCount = 0;

    /**
     * Tentukan sheet yang akan di-import
     */
    public function sheets(): array
    {
        return [
            'Sheet1' => $this,
        ];
    }

    /**
     * Mapping row ke database
     */
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

        return $existingData;
    }

    /**
     * Ambil data sesuai kolom Excel
     */
    private function getData(array $row): array
    {
        return [
            'global_id'         => $row[1] ?? null,
            'asset_group'       => $row[2] ?? null,
            'asset_type'        => $row[3] ?? null,
            'description'       => $row[4] ?? null,
            'penyulang'         => $row[5] ?? null,
            'parent_lokasi'     => $row[6] ?? null,
            'formatted_address' => $row[7] ?? null,
            'street_address'    => $row[8] ?? null,
            'city'              => $row[9] ?? null,
            'latitude'          => $row[10] ?? null,
            'longitude'         => $row[11] ?? null,
            'kode_konstruksi_1' => $row[12] ?? null,
            'kode_konstruksi_2' => $row[13] ?? null,
            'kode_konstruksi_3' => $row[14] ?? null,
            'kode_konstruksi_4' => $row[15] ?? null,
            'type_pondasi'      => $row[16] ?? null,
            'jenis_tiang'       => $row[17] ?? null,
            'ukuran_tiang'      => $row[18] ?? null,
        ];
    }

    /**
     * Mulai dari row ke-2 (skip header)
     */
    public function startRow(): int
    {
        return 2;
    }

    /**
     * Optimasi insert
     */
    public function batchSize(): int
    {
        return 500; // insert 500 data sekaligus
    }

    public function chunkSize(): int
    {
        return 500; // baca excel 500 baris per chunk
    }

    /**
     * Setelah import selesai
     */
    public function getSummaryMessage(): string
    {
        return "{$this->importedCount} data baru ditambahkan, {$this->updatedCount} data diperbarui.";
    }
}
