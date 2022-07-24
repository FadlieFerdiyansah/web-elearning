<?php

namespace Database\Factories;

use App\Models\Dosen;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Matkul;
use Illuminate\Database\Eloquent\Factories\Factory;

class JadwalFactory extends Factory
{
    protected $model = Jadwal::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'kelas_id' => rand(1,Kelas::count()),
            'dosen_id' => rand(1,Dosen::count()),
            'matkul_id' => rand(1,Matkul::count()),
            'hari' => $this->faker->randomElement(['Senin','Selasa','Rabu','Kamis','Jum\'at','Sabtu']),
            'jam_masuk' => $this->faker->time('H:i'),
            'jam_keluar' => $this->faker->time('H:i'),
        ];
    }
}
