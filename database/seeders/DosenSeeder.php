<?php

namespace Database\Seeders;

use App\Models\Dosen;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dosen = Dosen::create([
            'nip' => 100912812,
            'nama' => 'Fadlie Dosen',
            'email' => 'fadlie@gmail.com',
            'password' => bcrypt('admin123'),
            'foto' => 'default.png'
        ]);

        $dosen->assignRole('dosen');
    }
}
