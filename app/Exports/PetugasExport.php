<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class BooksExport implements FromArray, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::all();
    }

    public function array(): array
    {
        return Book::getDataPetugas();
    }

    public function headings(): array
    {
        return[
            'No',
            'Username',
            'Nama',
            'Jenis Kelamin',
            'Email',
            'Kontak',
            'Password',
        ];
    }
}
