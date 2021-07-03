<?php

namespace App\Http\Controllers\Jadwal;

use Carbon\Carbon;
use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Jadwal;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\Matkul;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class JadwalController extends Controller
{
    
    public function jadwalKuliah()
    {

        $today = date('l');
        if ($today == 'Sunday') {
            $day = 'Minggu';
        } elseif ($today == 'Monday') {
            $day = 'Senin';
        } elseif ($today == 'Tuesday') {
            $day = 'Selasa';
        } elseif ($today == 'Wednesday') {
            $day = 'Rabu';
        } elseif ($today == 'Thursday') {
            $day = 'Kamis';
        } elseif ($today == 'Friday') {
            $day = 'Jum\'at';
        } else {
            $day = 'Sabtu';
        }

        
        // Get Jadwal Berdasarkan Mahasiswa/Dosen
        {
            if (Auth::guard('mahasiswa')->check()) {
                $user = Auth::user()->kelas_id;
                $jadwals = Jadwal::where('kelas_id', $user) ->get();
            }elseif(Auth::guard('dosen')->check()){
                $jadwals = Jadwal::where('dosen_id', Auth::id()) ->get();
            }elseif(Auth::guard('admin')->check()){
                $jadwals = Jadwal::get()->load(['dosen','matkul','kelas']);
            }
        }

        

        return view('jadwal.jadwal-kuliah', [
            'jadwals' => $jadwals,
            'day' => $day
        ]);
    }

    public function jadwalPengganti()
    {
        $dosens = Dosen::get()->load(['matkuls','kelas']);

        $jadwals = Jadwal::with(['matkul','kelas'])
                    ->where('kelas_id', Auth::user()->kelas_id)->get();


        return view('jadwal.jadwal-pengganti',compact('dosens','jadwals'));
    }

    public function create()
    {
        $kelas = Kelas::get()->load(['dosens']);

        $matkul = Matkul::with('dosens')->get();

        return view('form-control.jadwals.jadwal', [ 
            'kelas' => $kelas ,
            'matkuls' => $matkul
        ]);
    }

    public function getDosenByKelasId(Kelas $kelas)
    {
        return $kelas->dosens;
    }

    public function getMatkulByDosenId(Dosen $dosen)
    {
        return $dosen->matkuls;
    }

}
