<?php

namespace App\Imports;

use App\Models\PelangganAPPModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Facades\Session;

class DataPelangganAPPImport implements ToModel, WithStartRow, WithMultipleSheets
{
    use Importable;

    protected $unit_ulp;

    public function __construct($unit_ulp)
    {
        $this->unit_ulp = $unit_ulp;
    }
    public function model(array $row)
    {
        if (empty($row[3])) { // Asumsi kolom ID pelanggan berada di index 3
            return null; // Lewati baris
        }
        $existingData = PelangganAPPModel::where('id_pelanggan', $row[3])->first(); // Ubah index sesuai urutan yang benar

        if ($existingData) {
            $existingData->update($this->getData($row));
            Session::flash('error_import_pelangganAPP', 'Data pelangganAPP sudah ada dan telah diperbarui.');
        } else {
            if ($this->isDuplicate($row)) {
                Session::flash('error_import_pelangganAPP', 'Data sudah ada. Tidak ada perubahan yang dilakukan.');
            } else {
                PelangganAPPModel::create($this->getData($row));
                Session::flash('success_import_pelangganAPP', 'Data pelangganAPP berhasil diimport.');
            }
        }

        return null;
    }

    /**
     * Ambil data dari baris excel untuk disimpan ke model.
     */
    private function getData(array $row)
    {
        return [
            'id_pelanggan' => $row[3],
            'nama_pelanggan' => $row[4],
            'alamat' => $row[5],
            'tarif_daya' => $row[6],
            'nomor_meter' => $row[7],
            'ukuran_mcb' => $row[8],
            'no_segel' => $row[10],
            'unit_ulp'  => $this->unit_ulp,
        ];
    }

    /**
     * Periksa apakah data sudah ada di dalam database.
     */
    private function isDuplicate(array $row)
    {
        return PelangganAPPModel::where('id_pelanggan', $row[3])->exists(); // Gunakan index 3 sesuai dengan urutan excel
    }

    public function sheets(): array
    {
        return [
            'MCB ON' => $this
        ];
    }

    /**
     * Tentukan baris awal untuk membaca data dari excel (skip header).
     */
    public function startRow(): int
    {
        return 3; // Asumsi header ada di baris pertama, mulai membaca dari baris kedua
    }
}
