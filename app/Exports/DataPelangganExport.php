<?php

namespace App\Exports;

use App\Models\DataPelangganModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataPelangganExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DataPelangganModel::all();
    }
    public function headings(): array
    {
        return [
            'No',
            'ID Pelanggan',
            'Nama',
            'Alamat',
            'Maps',
            'Latitude',
            'Longtitude',
            'Unit ULP',
            'Tarif',
            'Daya',
            'Kogol',
            'Fakmkwh',
            'RPBP',
            'RPUJL',
            'Nomor KWH',
            'Penyulang',
            'Nama Section',
            'Tipe Kubikel',
        ];
    }
}
