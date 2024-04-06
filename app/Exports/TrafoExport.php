<?php

namespace App\Exports;

use App\Models\TrafoModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TrafoExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return TrafoModel::all();
    }
    public function headings(): array
    {
        return [
            'No',
            'Kategori',
            'GI',
            'Unit Layanan',
            'Penyulang',
            'No Tiang',
            'No Gardu Distribusi',
            'Tipe Belitan Trafo',
            'Jam Padam',
            'Penyebab',
            'No APKT',
            'Beban (A)',
        ];
    }
}
