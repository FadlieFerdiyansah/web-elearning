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
        $kelas = collect([
            '17.1A.12',
            '17.2A.22',
            '17.3A.32',
            '17.4A.42',
            '17.2A.52',
            '18.1B.12',
            '18.2B.22',
            '18.3B.32',
        ]);

        $kelas->each(function($item){
            Kelas::create(['kd_kelas' => $item]);   
        });



    }
}
