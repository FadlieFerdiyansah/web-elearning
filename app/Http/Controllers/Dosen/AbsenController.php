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

    public function create($jadwal_id)
    {
        $jadwal = Jadwal::find(Crypt::decryptString($jadwal_id));
        
        $kelasActive = Auth::guard('dosen')->user()->jadwals()->where('hari',hariIndo())->get();

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

}
