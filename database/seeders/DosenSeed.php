<?php

namespace Database\Seeders;

use App\Models\Dosen;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DosenSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dosen = Dosen::create([
            'kelas_id' => 1,
            'matkul_id' => 4,
            'nip' => 100912812,
            'nama' => 'Dosen',
            'email' => 'dosen@gmail.com',
            'password' => bcrypt('dosen123'),
            'foto' => 'default.png'
        ]);

        Role::create([
            'name' => 'dosen',
            'guard_name' => 'dosen'
        ]);

        $dosen->assignRole('dosen');
    }
}
