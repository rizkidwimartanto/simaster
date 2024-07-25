<?php

namespace App\Exports;

use App\Models\PelangganAPPModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class APPExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        return PelangganAPPModel::whereBetween('created_at', [$this->startDate, $this->endDate])->get();
    }

    public function headings(): array
    {
        return [
            'Tanggal Dibuat',
            'ID Pelanggan',
            'Nama Pelanggan',
            'Tarif',
            'Daya',
            'Alamat',
            'Latitude',
            'Longitude',
            'Jenis Meter',
            'Merk Meter',
            'Tahun Meter',
            'Merk MCB',
            'Ukuran MCB',
            'No Segel',
            'No Gardu',
            'SR Deret',
            'Catatan',
        ];
    }
    public function map($pelanggan): array
    {
        return [
            $pelanggan->created_at->format('d-m-Y'), // Format tanggal dibuat
            $pelanggan->id_pelanggan,
            $pelanggan->nama_pelanggan,
            $pelanggan->tarif,
            $pelanggan->daya,
            $pelanggan->alamat,
            $pelanggan->latitude,
            $pelanggan->longitude,
            $pelanggan->jenis_meter,
            $pelanggan->merk_meter,
            $pelanggan->tahun_meter,
            $pelanggan->merk_mcb,
            $pelanggan->ukuran_mcb,
            $pelanggan->no_segel,
            $pelanggan->no_gardu,
            $pelanggan->sr_deret,
            $pelanggan->catatan,
        ];
    }
}
