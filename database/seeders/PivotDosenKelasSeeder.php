<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Matkul;
use Illuminate\Database\Seeder;

class PivotDosenKelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kelas = Kelas::all();
        $matkuls = Matkul::all();

        Dosen::all()->each(function ($dosen) use ($kelas) {
            $dosen->kelas()->attach(
                $kelas->random(rand(1, $kelas->count()))->pluck('id')->toArray()
            );
        });
        Dosen::all()->each(function ($dosen) use ($kelas, $matkuls) {
            $kelas->each(function ($kls) use ($dosen, $matkuls) {
                $dosen->kelas()->updateExistingPivot(['kelas_id' => $kls->id], ['matkul_id' => $dosen->matkuls->random()->id]);
            });
        });
    }
}
