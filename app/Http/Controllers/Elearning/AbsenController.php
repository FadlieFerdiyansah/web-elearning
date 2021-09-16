<?php

namespace App\Http\Controllers\Elearning;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Absen;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class AbsenController extends Controller
{
    public function absen()
    {
        $jadwal_id = Crypt::decryptString(request('id'));
        $jadwal = Jadwal::findOrFail($jadwal_id);
        $jam_masuk = $jadwal->jam_masuk;
        $jam_keluar = $jadwal->jam_keluar;
        // $waktuAbsen = (bool) $this->waktuSekarang() >= $jam_masuk && $this->waktuSekarang() <= $jam_keluar;
        // if ($test) {
        //     header("Refresh:0");
        // }else{
        //     return 'ga bisa absen';
        // }
        Auth::user()->absens()->create([
            'jadwal_id' => $jadwal_id,
            'status' => true,
        ]);
        return back();
    }

    // public function index()
    // {
    //     return view('')
    // }
}
