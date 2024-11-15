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
    
    private $endRow = 23; // Batas baris terakhir yang ingin diimpor

    public function sheets(): array
    {
        return [
            'Akhir Bulan' => $this,
        ];
    }

    public function model(array $row)
    {
        if ($this->currentRow() > $this->endRow) {
            return null; // Berhenti memproses setelah baris 24
        }

        ManajemenAset::create($this->getData($row));
        Session::flash('success_import_data_aset', 'file excel data_aset berhasil diimport');
    }

    private function getData(array $row)
    {
        return [
            'ulp' => $row[2] ?? '',
            'kms_jtm' => $row[3] ?? '',
            'kms_jtr' => $row[4] ?? '',
            'jumlah_trafo' => $row[5] ?? '',
            'total_daya_trafo' => $row[6] ?? '',
            'sr' => $row[7] ?? '',
            'jumlah_tiang_tm' => $row[8] ?? '',
            'jumlah_tiang_tr' => $row[9] ?? '',
        ];
    }

    public function startRow(): int
    {
        return 20; // Mulai impor dari baris ke-20
    }
    
    private function currentRow(): int
    {
        return $this->startRow() + count($this->getData([])); // Mendapatkan baris yang sedang diproses
    }
}
