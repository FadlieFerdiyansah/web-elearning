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
        // Matkul::create([
        //     'kd_matkul' => 'MTK',
        //     'nm_matkul' => 'Matematika',
        //     'sks' => 18,
        // ]);

        // Matkul::create([
        //     'kd_matkul' => 'PBO',
        //     'nm_matkul' => 'Pemrograman Berorentasi Objek',
        //     'sks' => 22,
        // ]);

        // Matkul::create([
        //     'kd_matkul' => 'AK',
        //     'nm_matkul' => 'Arsitektur Komputer',
        //     'sks' => 10,
        // ]);
        $matkuls = collect(['arsiteksur komputer',
                        'pemrograman berorientasi objek',
                        'matematika diskrit',
                        'bahasa inggris',
                        'struktur data',
                        'character building',
                        'pemrograman web',
                        'pemrograman android',
                        'machine learning',
                        'pemrograman dasar',
                        'algoritma',
                        ]);
        $matkuls->each(function($matkul){
            $arr = explode(' ', $matkul);
            $singkatan = '';

            foreach($arr as $kata)
            {
                $singkatan .= substr($kata, 0, 1);
            }

            Matkul::create([
                'kd_matkul' => $singkatan,
                'nm_matkul' => $matkul,
                'sks' => rand(1,10)
            ]);
        });

        



    }
}
