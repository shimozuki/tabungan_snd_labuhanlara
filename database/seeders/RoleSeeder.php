<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'id' => 1,
                'nama' => 'Admin'
            ],
            [
                'id' => 2,
                'nama' => 'Petugas'
            ],
            [
                'id' => 3,
                'nama' => 'User'
            ]
        ];
        foreach ($roles as $key => $role){
            Role::create($role);
        }
    }
}
