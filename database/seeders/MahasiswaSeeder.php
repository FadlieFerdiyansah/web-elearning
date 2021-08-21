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
        $mhs = Mahasiswa::create([
            'fakultas_id' => 1,
            'kelas_id' => 2,
            'nim' => 17200812,
            'nama' => 'Fadlie Ferdiyansah',
            'email' => 'fadlie@gmail.com',
            'password' => bcrypt('mhs123'),
            'foto' => 'default.png'
        ]);

        Role::create([
            'name' => 'mahasiswa',
            'guard_name' => 'mahasiswa'
        ]);

        $mhs->assignRole('mahasiswa');
    }
}
