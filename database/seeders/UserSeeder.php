<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'id'                => 1,
                'nama'              => 'Admin',
                'email'             => 'admin@mail.com',
                'jenis_kelamin'     => 'Laki',
                'kelas'             => '-',
                'kontak'            => '087861540874',
                'password'          => bcrypt('12345'),
                'roles_id'          => 1,
                'id_tabungan'       => 'admin',
            ],
            [
                'id'                => 2,
                'nama'              => 'Wali Kelas',
                'email'             => 'wali_kelas@mail.com',
                'jenis_kelamin'     => 'Laki',
                'kelas'             => '-',
                'kontak'            => '087861540874',
                'password'          => bcrypt('12345'),
                'roles_id'          => 2,
                'id_tabungan'       => 'wkelas',
            ],
        ];

        foreach ($user as $key => $value){
            User::create($value);
        }
    }
}