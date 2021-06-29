<?php

namespace App\Http\Controllers\Jadwal;

use Carbon\Carbon;
use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class JadwalController extends Controller
{
    public function jadwalKuliah()
    {

        $days = Carbon::getDays('Asia/Jakarta');

        foreach ($days as $i => $value) {
            if ($i == 0) {
                $day = 'Minggu';
                break;
            } elseif ($i == 1) {
                $day = 'Senin';
                break;
            } elseif ($i == 2) {
                $day = 'Selasa';
                break;
            } elseif ($i == 3) {
                $day = 'Rabu';
                break;
            } elseif ($i == 4) {
                $day = 'Kamis';
                break;
            } elseif ($i == 5) {
                $day = 'Jum\'at';
                break;
            } else {
                $day = 'Sabtu';
                break;
            }
        }
        
        if (Auth::guard('mahasiswa')->check()) {
            $user = Auth::user()->kelas_id;
            $jadwals = Jadwal::where('kelas_id', $user)
                ->get();
        }elseif(Auth::guard('dosen')->check()){
            $jadwals = Jadwal::where('dosen_id', Auth::id())
                ->get();
        }elseif(Auth::guard('admin')->check()){
            return 'admin user';
        }

        

        return view('jadwal.jadwal-kuliah', [
            'jadwals' => $jadwals
        ]);
    }

    public function jadwalPengganti()
    {
        return view('jadwal.jadwal-pengganti');
    }
}
