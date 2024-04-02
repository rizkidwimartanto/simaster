<?php

namespace App\Imports;

use App\Models\TrafoModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithStartRow;

class TrafoImport implements ToModel, WithStartRow, WithMultipleSheets
{
    use Importable;

    public function model(array $row)
    {
        // $existingData = TrafoModel::where('penyulang', $row[3])->first();

        // if ($existingData) {
        //     $existingData->update($this->getData($row));
        //     Session::flash('success_import', 'File Excel Berhasil Diimport (Data diperbarui)');
        // } else {
            TrafoModel::create($this->getData($row));
            Session::flash('success_import', 'File Excel Berhasil Diimport');
        // }

        return null;
    }

    private function getData(array $row)
    {
        return [
            'kategori' => $row[0],
            'gi' => $row[1],
            'unit_layanan' => $row[2],
            'penyulang' => $row[3],
            'no_tiang' => $row[4],
            'no_gardu_distribusi' => $row[5],
            'tipe_belitan_trafo' => $row[6],
            'jam_padam' => $row[7],
            'jam_nyala' => $row[8],
            'latitude' => $row[9],
            'longtitude' => $row[10],
            'lama_padam' => $row[11],
            'daya' => $row[12],
            'merk' => $row[13],
            'no_seri' => $row[14],
            'tahun_pasang' => $row[15],
            'beban_X1' => $row[16],
            'beban_X2' => $row[17],
            'beban_Xo' => $row[18],
            'lokasi' => $row[19],
            'penyebab' => $row[20],
            'no_pk_apkt' => $row[21],
            'kali_trip' => $row[22],
            'kva_aset' => $row[23],
            'waktu_ukur' => $row[24],
            'jumlah_jurusan' => $row[25],
            'fasa' => $row[26],
            'beban_jurusan_X1' => $row[27],
            'beban_jurusan_N' => $row[28],
            'perhitungan_beban' => $row[29],
            'klasifikasi_beban' => $row[30],
            'beban_ampere' => $row[31],
            'kesesuaian' => $row[32],
        ];
    }
    // private function isDuplicate(array $data)
    // {
    //     return TrafoModel::where('penyulang', $data['3'])->exists();
    // }

    public function sheets(): array
    {
        return [
            'Data Trafo' => new TrafoImport()
        ];
    }

    public function startRow(): int
    {
        return 2;
    }
}
