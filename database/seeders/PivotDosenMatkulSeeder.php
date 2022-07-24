<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\Matkul;
use Illuminate\Database\Seeder;

class PivotDosenMatkulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $matkuls = Matkul::all();

        Dosen::all()->each(function ($dosen) use ($matkuls) { 
            $dosen->matkuls()->attach(
                $matkuls->random(rand(1, $matkuls->count()))->pluck('id')->toArray()
            ); 
        });
    }
}
