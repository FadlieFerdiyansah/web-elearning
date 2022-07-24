<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Mahasiswa::create([
            'fakultas_id' => 1,
            'kelas_id' => 2,
            'nim' => 17200812,
            'nama' => 'Fadlie Ferdiyansah',
            'email' => 'mahasiswa@gmail.com',
            'password' => bcrypt('password'),
            'foto' => 'default.png'
        ]);

        $randMahasiswa = Mahasiswa::all();
        $randMahasiswa->each(function ($mhs) {
            $mhs->assignRole('mahasiswa');
        });
    }
}
