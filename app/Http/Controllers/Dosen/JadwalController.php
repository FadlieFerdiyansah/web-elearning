<?php

namespace App\Http\Controllers\Dosen;

use App\Models\{Dosen, Jadwal};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    public function jadwalMengajar()
    {
        $jadwals = Jadwal::where('dosen_id', Auth::Id())->get();

        return view('frontend.dosen.jadwal.jadwal_mengajar', [
            'jadwals' => $jadwals,
            'day' => hariIndo()
        ]);
    }

    public function jadwalMengajarPengganti()
    {
        $dosens = Dosen::get()->load(['matkuls', 'kelas']);

        $jadwals = Jadwal::with(['matkul', 'kelas'])
            ->where('kelas_id', Auth::user()->kelas_id)->get();


        return view('frontend.dosen.jadwal.jadwal_pengganti', compact('dosens', 'jadwals'));
    }
}
