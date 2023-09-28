<?php

namespace App\Exports;

use App\Models\DataPelangganModel;
use Maatwebsite\Excel\Concerns\FromCollection;

class DataPelangganExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DataPelangganModel::all();
    }
}
