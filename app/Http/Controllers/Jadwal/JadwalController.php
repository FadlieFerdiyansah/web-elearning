<?php

namespace App\Http\Controllers\Jadwal;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Jadwal;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class JadwalController extends Controller
{
    public function jadwalKuliah()
    {
        $user = Auth::user()->kelas_id;
        $jadwal = Jadwal::get()->where('kelas_id', $user);

        return view('jadwal.jadwal-kuliah',[
            'jadwal' => $jadwal
        ]);
    }

    public function jadwalPengganti()
    {
        return view('jadwal.jadwal-pengganti');
    }
}
