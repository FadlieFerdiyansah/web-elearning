<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Absen;
use App\Models\Kelas;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\RateLimiter;

class AbsenController extends Controller
{
    public function table()
    {
        
        $dateNow = date('Y-m-d');
        $absensiHariIni = Absen::where('dosen_id',Auth::guard('dosen')->Id())->where('parent',0)->where('created_at',$dateNow)->get(); 
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
