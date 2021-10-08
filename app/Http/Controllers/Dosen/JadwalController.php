<?php

namespace App\Http\Controllers\Dosen;

use Carbon\Carbon;
use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Jadwal;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\JadwalRequest;
use App\Http\Resources\JadwalResource;
use App\Models\Matkul;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class JadwalController extends Controller
{
    public function jadwalMengajar()
    {
        $jadwals = Jadwal::where('dosen_id', Auth::id())->get();

        return view('frontend.dosen.jadwal.jadwal-mengajar', [
            'jadwals' => $jadwals,
            'day' => hariIndo()
        ]);
    }

    public function jadwalMengajarPengganti()
    {
        $dosens = Dosen::get()->load(['matkuls', 'kelas']);

        $jadwals = Jadwal::with(['matkul', 'kelas'])
            ->where('kelas_id', Auth::user()->kelas_id)->get();


        return view('frontend.dosen.jadwal.jadwal-pengganti', compact('dosens', 'jadwals'));
    }
}
