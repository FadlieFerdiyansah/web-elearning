<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\Jadwal;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kelas = DB::table('dosen_kelas')->get();
        $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu'];

        foreach ($kelas as $key => $kls) {
            $hour = rand(00, 23);
            $minute = rand(00, 59);
            $jam_keluar_hour = $hour + 2 > 23 ? $hour + 2 - 24 : $hour + 2;
            $jam_keluar_minute = $minute;
            if ($hour < 10) {
                $hour = '0' . $hour;
            }
            if ($minute < 10) {
                $minute = '0' . $minute;
            }
            if ($jam_keluar_hour < 10) {
                $jam_keluar_hour = '0' . $jam_keluar_hour;
            }
            if ($jam_keluar_minute < 10) {
                $jam_keluar_minute = '0' . $jam_keluar_minute;
            }
            Jadwal::create([
                'kelas_id' => $kls->kelas_id,
                'dosen_id' => $kls->dosen_id,
                'matkul_id' => $kls->matkul_id,
                'hari' => $hari[array_rand($hari)],
                'jam_masuk' => "$hour:$minute",
                'jam_keluar' => "$jam_keluar_hour:$jam_keluar_minute",
            ]);
        }
    }
}
