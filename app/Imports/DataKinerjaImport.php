<?php

namespace App\Imports;

use App\Models\DataGIModel;
use App\Models\DataKinerjaModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas; // Untuk menangani rumus Excel

class DataKinerjaImport implements ToModel, WithStartRow, WithMultipleSheets, WithCalculatedFormulas
{
    use Importable;

    private $startRow = 22; // Baris awal untuk impor
    private $endRow = 41; // Batas baris terakhir yang ingin diimpor

    public function sheets(): array
    {
        return [
            'Peak Trafo GI' => $this,
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

        // Mengambil nilai yang telah dihitung di Excel menggunakan rumus
        $dayaTerpasang = $row[11] ?? null;
        $dayaTerpakai = $row[12] ?? null;

        // Misalnya, Anda ingin menghitung daya terpasang dan terpakai persentase secara manual:
        $dayaTerpasangTerpakaiPersen = $dayaTerpasang && $dayaTerpakai
            ? ($dayaTerpakai / $dayaTerpasang) * 100
            : null;

        return new DataKinerjaModel([
            'gi' => $row[10] ?? null,
            'daya_terpasang' => $dayaTerpasang,
            'daya_terpakai' => $dayaTerpakai,
            'daya_terpasang_terpakai_persen' => $dayaTerpasangTerpakaiPersen,
        ]);
    }

    public function startRow(): int
    {
        return $this->startRow; // Mulai impor dari baris ke-20
    }
}
