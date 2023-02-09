<?php

namespace Database\Seeders;

use App\Models\Bagian;
use Illuminate\Database\Seeder;

class BagianSeeder extends Seeder
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
                'id' => 3,
                'nama_bagian' => 'Bagian Umum',
            ],
            [
                'id' => 2,
                'nama_bagian' => 'Bagian Orta',
            ],
        ];
        Bagian::insert($data);
    }
}
