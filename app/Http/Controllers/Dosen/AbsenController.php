<?php

namespace App\Http\Controllers\Dosen;

use App\Models\Absen;
use App\Models\Kelas;
use App\Models\Jadwal;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class AbsenController extends Controller
{
    // public function table()
    // {
    //     $absensiHariIni = Absen::where('dosen_id', Auth::guard('dosen')->Id())
    //                         ->where('parent', 0)
    //                         ->whereDate('created_at', now())
    //                         ->get();

    //     return view('frontend.dosen.absensi.table',compact('absensiHariIni'));
    // }

    public function create($jadwal_id)
    {
        $jadwal = Jadwal::find(Crypt::decryptString($jadwal_id));
        
        $kelasActive = Auth::guard('dosen')->user()->jadwals()->where('hari',hariIndo())->get();
        // return $kelasActive;
        return view('frontend.dosen.absensi.create',compact('kelasActive','jadwal'));
    }
    
    public function store()
    {
        $jadwal_id = Crypt::decryptString(request('jadwal'));
        request()->validate([
            'kelas' => 'required'
        ]);
        
        Auth::user()->absens()->create([
            'jadwal_id' => $jadwal_id,
            'kelas_id' => request('kelas'),
            'matkul_id' => request('matkul'),
            'pertemuan' => request('pertemuan')
        ]);
        
        // Auth::guard('dosen')->user()->absen()->create();
        return redirect(route('kelas.masuk',request('jadwal')));
    }

    public function kelas()
    {
        $jadwalsActive = Auth::guard('dosen')->user()->jadwals()->where('hari',hariIndo())->get();
        // return $jadwalsActive;
        return view('frontend.dosen.absensi.mahasiswa',compact('jadwalsActive'));
    }

    public function detail(Kelas $kelas)
    {
        return view('frontend.dosen.absensi.detail',compact('kelas'));
    }
}
