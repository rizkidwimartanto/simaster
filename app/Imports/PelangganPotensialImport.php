<?php

namespace App\Imports;

use App\Models\PelangganPotensialModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class PelangganPotensialImport implements ToModel, WithStartRow, WithMultipleSheets
{
    use Importable;

    private $startRow = 5; // Baris awal untuk impor
    private $endRow = 17; // Batas baris terakhir yang ingin diimpor

    public function sheets(): array
    {
        return [
            'Rekap' => $this,
        ];
    }

    public function model(array $row)
    {
        // Hitung baris yang sedang diproses berdasarkan baris awal
        static $currentRow = 0;
        $currentRow++;

        // Abaikan baris di luar rentang yang diinginkan
        if (($this->startRow + $currentRow - 1) > $this->endRow) {
            return null;
        }

        // Proses dan simpan data
        return new PelangganPotensialModel([
            'unit_ulp' => $row[0] ?? null,
            'od_id' => $row[1] ?? null,
            'count_unitulp' => $row[2] ?? null,
            'sum_daya' => $row[3] ?? null,
        ]);
    }

    public function startRow(): int
    {
        return $this->startRow; // Mulai impor dari baris ke-20
    }
}
