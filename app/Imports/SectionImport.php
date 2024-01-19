<?php

namespace App\Imports;

use App\Models\SectionModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class SectionImport implements ToModel, WithStartRow, WithMultipleSheets
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    use Importable;

    public function model(array $row)
    {
        $existingData = SectionModel::where('id_section', $row[0])
        ->where('penyulang', $row[1])
        ->first();
        if ($existingData) {
            $existingData->update([
                'nama_section' => $row[2],
                'id_vsld' => $row[3],
                'id_apkt' => $row[4],
                'unit' => $row[5],
            ]);
            Session::flash('success_import', 'File Excel Berhasil Diimport (Data diperbarui)');
        }else{
            if($this->isDuplicate($row)){
                Session::flash('error_import', 'Data sudah ada. Namun jika ada data tambahan lainnya, maka dapat dicek');
            }else{
                Session::flash('success_import', 'File Excel Berhasil Diimport');
                return new SectionModel([
                    'id_section' => $row[0],
                    'penyulang' => $row[1],
                    'nama_section' => $row[2],
                    'id_vsld' => $row[3],
                    'id_apkt' => $row[4],
                    'unit' => $row[5],
                ]);
            }
        }
        return null;
    }

    private function isDuplicate(array $data)
    {
        $existingData = SectionModel::where('id_section', $data['0'])
            ->where('penyulang', $data['1'])
            ->first();

        return $existingData !== null;
    }
    public function sheets(): array{
        return[
            'section' => new SectionImport()
        ];
    }
    public function startRow(): int
    {
        return 2;
    }
}
