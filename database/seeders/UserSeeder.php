<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'bagian_id' => 4,
                'nip' => 202020202020202020,
                'nama' => 'Admin',
                'nohp' => '0813123123123',
                'email' => 'admin@gmail.com',
                'username' => 'administrator',
                'password' => Hash::make('12345678'),
                'foto' => 'blank.png',
                'level' => 1,
                'status' => 1,
            ],
        ];
        User::insert($data);
    }
}
