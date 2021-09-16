<?php

namespace App\Http\Controllers\Elearning;

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
    public function table()
    {
        // $jadwals = Jadwal::get()->load(['dosen','matkul','kelas']);
        if(request()->expectsJson()){
            return JadwalResource::collection(Jadwal::paginate(5));
        }
        return view('backend.datatable.jadwals.table');
    }

    public function jadwalKuliah()
    {
        $today = date('l');
        if ($today == 'Sunday') {
            $day = 'Minggu';
        } elseif ($today == 'Monday') {
            $day = 'Senin';
        } elseif ($today == 'Tuesday') {
            $day = 'Selasa';
        } elseif ($today == 'Wednesday') {
            $day = 'Rabu';
        } elseif ($today == 'Thursday') {
            $day = 'Kamis';
        } elseif ($today == 'Friday') {
            $day = 'Jum\'at';
        } else {
            $day = 'Sabtu';
        }

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
            'day' => $day
        ]);
    }

    public function jadwalPengganti()
    {
        $dosens = Dosen::get()->load(['matkuls','kelas']);

        $jadwals = Jadwal::with(['matkul','kelas'])
                    ->where('kelas_id', Auth::user()->kelas_id)->get();


        return view('frontend.jadwal.jadwal-pengganti',compact('dosens','jadwals'));
    }

    public function create()
    {
        return view('backend.form-control.jadwals.jadwal');
    }

    public function edit(Jadwal $jadwal)
    {
        return $jadwal;
    }

    public function update(Jadwal $jadwal)
    {
        return 'ok';
    }

    //Mendapatkan data dosen berdasarkan kelas
    public function getDosenByKelasId(Kelas $kelas)
    {
        return $kelas->dosens;
    }

    //Mendapatkan data matkul berdasarkan dosen
    public function getMatkulByDosenId(Dosen $dosen)
    {
        return $dosen->matkuls;
    }

    public function store(JadwalRequest $request)
    {
        Jadwal::create($request->all());
        $kelas = Kelas::find($request->kelas_id);
        return response()->json(['message' => 'Berhasil membuat jadwal untuk kelas '. $kelas->kd_kelas]);
    }

}
