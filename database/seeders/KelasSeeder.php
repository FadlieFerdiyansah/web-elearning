<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kelas::create([
            'kd_kelas' => '17.2A.12'
        ]);
        Kelas::create([
            'kd_kelas' => '18.3A.12'
        ]);
        Kelas::create([
            'kd_kelas' => '10.5A.12'
        ]);
        Kelas::create([
            'kd_kelas' => '51.8A.12'
        ]);
    }
}
