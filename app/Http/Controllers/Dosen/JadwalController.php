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
        // return Jadwal::paginate(6);
         

        // Get Jadwal Berdasarkan Mahasiswa/Dosen
        {
            if (Auth::guard('mahasiswa')->check()) {
                $user = Auth::user()->kelas_id;
                $jadwals = Jadwal::where('kelas_id', $user)->get();
            }elseif(Auth::guard('dosen')->check()){
                $jadwals = Jadwal::where('dosen_id', Auth::id())->get();
            }elseif(Auth::guard('admin')->check()){
                // $jadwals = Jadwal::orderByDesc('id')->paginate(6);
                // $jadwals = Jadwal::addSelect([
                //     'kd_kelas' => Kelas::select('kd_kelas')->whereColumn('id','jadwals.kelas_id')->limit(1),
                //     'nm_matkul' => Matkul::select('nm_matkul')->whereColumn('id','jadwals.matkul_id')->limit(1),
                //     'sks' => Matkul::select('sks')->whereColumn('id','jadwals.matkul_id')->limit(1),
                //     'hari' => Jadwal::select('hari')->whereColumn('id','id')->limit(1)
                // ])->get();
                $jadwals = Jadwal::paginate(6);
            }
        }

        // return $jadwals;

        

        return view('frontend.jadwal.jadwal-kuliah', [
            'jadwals' => $jadwals,
            'day' => hariIndo()
        ]);
    }

    public function jadwalMengajarPengganti()
    {
        $dosens = Dosen::get()->load(['matkuls','kelas']);

        $jadwals = Jadwal::with(['matkul','kelas'])
                    ->where('kelas_id', Auth::user()->kelas_id)->get();


        return view('frontend.jadwal.jadwal-pengganti',compact('dosens','jadwals'));
    }

}
