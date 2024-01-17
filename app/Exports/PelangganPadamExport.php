<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PelangganPadamExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $pelangganPadamModel;
    public function __construct($pelangganPadamModel)
    {   
        $this->pelangganPadamModel = $pelangganPadamModel;
    }
    public function collection()
    {
        return $this->pelangganPadamModel;
    }
    public function headings(): array{
        return [
            'Nomor Telepon',
            'Nama Pelanggan', 
            'Penyebab Padam', 
            'Keterangan'
        ];
    }
}
