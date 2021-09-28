<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Absen;
use App\Models\Kelas;
use Illuminate\Support\Facades\Auth;

class AbsenController extends Controller
{
    public function table()
    {
        $absensiHariIni = Absen::where('dosen_id', Auth::guard('dosen')->Id())
                            ->where('parent', 0)
                            ->whereDate('created_at', now())
                            ->get();

        return view('frontend.dosen.absensi.table',compact('absensiHariIni'));
    }

    public function create()
    {
        $kelasActive = Auth::guard('dosen')->user()->jadwals()->where('hari',hariIndo())->get();
            
        return view('frontend.dosen.absensi.create',compact('kelasActive'));
    }
    
    public function store()
    {
        request()->validate([
            'kelas' => 'required'
        ]);
        
        
        Auth::guard('dosen')->user()->absen()->create(request()->all());
        return back();
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
