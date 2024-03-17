<?php

namespace App\Exports;

use App\Models\PelangganPadamModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PelangganPadamExport implements FromCollection, WithHeadings
{
    protected $pelangganPadamModel;

    public function __construct()
    {   
        // Membuat instance dari model PelangganPadamModel
        $model = new PelangganPadamModel();
        
        // Memanggil method getPelangganPadam dari objek model
        $this->pelangganPadamModel = $model->getPelangganPadam();
    }

    public function collection()
    {
        return $this->pelangganPadamModel;
    }

    public function headings(): array
    {
        return [
            'Nomor Telepon',
            'Nama Pelanggan', 
            'Penyebab Padam', 
            'Keterangan',
            'Pesan Whatsapp'
        ];
    }
}
