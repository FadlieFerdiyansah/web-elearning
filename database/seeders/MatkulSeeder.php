<?php

namespace Database\Seeders;

use App\Models\Matkul;
use Illuminate\Database\Seeder;

class MatkulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Matkul::create([
            'fakultas_id' => 1,
            'kd_matkul' => 'MTK',
            'nm_matkul' => 'Matematika',
            'sks' => 18,
        ]);

        Matkul::create([
            'fakultas_id' => 2,
            'kd_matkul' => 'PBO',
            'nm_matkul' => 'Pemrograman Berorentasi Objek',
            'sks' => 22,
        ]);

        Matkul::create([
            'fakultas_id' => 3,
            'kd_matkul' => 'AK',
            'nm_matkul' => 'Arsitektur Komputer',
            'sks' => 10,
        ]);
    }
}
