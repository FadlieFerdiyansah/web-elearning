<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Models\Jadwal;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class JadwalController extends Controller
{
    public function jadwalKuliah()
    {
        $jadwals = Jadwal::with('matkul','kelas','dosen')->where('kelas_id', Auth::user()->kelas_id)->get();

        return view('frontend.mahasiswa.jadwal.jadwal_kuliah', [
            'jadwals' => $jadwals,
            'day' => hariIndo()
        ]);
    }

    public function jadwalPengganti()
    {
        $jadwals = Jadwal::with(['matkul', 'kelas'])
            ->where('kelas_id', Auth::user()->kelas_id)->get();


        return view('frontend.mahasiswa.jadwal.jadwal_pengganti', compact('jadwals'));
    }
}
