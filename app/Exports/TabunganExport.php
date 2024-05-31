<?php

namespace App\Exports;

use App\Models\Tabungan;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TabunganExport implements FromArray, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Tabungan::all();
    // }

    public function array(): array{
        return Tabungan::getDataTabungans();
    }

    public function headings(): array{
        return [
            'No',
            'Kode',
            'Nama',
            'Kelas',
            'Saldo Awal',
            'Saldo Akhir',
            'Stor',
            'Tarik',
            'Biaya',
            'Sisa',
            'Dibuat'
        ];
    }
}
