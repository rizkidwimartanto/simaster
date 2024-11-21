<?php

namespace App\Imports;

use App\Models\ManajemenAset;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ManajemenAsetImport implements ToModel, WithStartRow, WithMultipleSheets
{
    use Importable;

    private $startRow = 20; // Baris awal untuk impor
    private $endRow = 23; // Batas baris terakhir yang ingin diimpor

    public function sheets(): array
    {
        return [
            'Akhir Bulan' => $this,
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
        return new ManajemenAset([
            'ulp' => $row[2] ?? null,
            'kms_jtm' => $row[3] ?? null,
            'kms_jtr' => $row[4] ?? null,
            'jumlah_trafo' => $row[5] ?? null,
            'total_daya_trafo' => $row[6] ?? null,
            'sr' => $row[7] ?? null,
            'jumlah_tiang_tm' => $row[8] ?? null,
            'jumlah_tiang_tr' => $row[9] ?? null,
        ]);
    }

    public function startRow(): int
    {
        return $this->startRow; // Mulai impor dari baris ke-20
    }
}
