<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SectionExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $rekapSection;

    public function __construct($rekapSection)
    {
        $this->rekapSection = $rekapSection;
    }

    public function collection()
    {
        return $this->rekapSection;
    }
    public function headings(): array
    {
        return [
            'Section',
            'Nomor Tiang',
            'Kali Padam',
        ];
    }
}
