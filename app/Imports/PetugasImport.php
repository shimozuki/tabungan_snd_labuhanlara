<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class PetugasImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'nama' => $row['1'],
            'email' => $row['2'],
            'jenis_kelamin' => $row['3'],
            'id_tabungan' => $row['4'],
            'password' => Hash::make($row['5']),
            'kontak' => $row['6'],
            'roles_id' => 2 ,
        ]);
    }
}
