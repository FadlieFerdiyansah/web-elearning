<?php

namespace App\Http\Controllers\Admin;

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
    public function index()
    {
        // $jadwals = Jadwal::get()->load(['dosen','matkul','kelas']);
        if (request()->expectsJson()) {
            return JadwalResource::collection(Jadwal::paginate(7));
        }
        return view('backend.jadwal.index');
    }

    public function create()
    {
        return view('backend.jadwal.create');
    }

    public function store(JadwalRequest $request)
    {
        Jadwal::create($request->all());
        $kelas = Kelas::find($request->kelas_id);
        return response()->json(['message' => 'Berhasil membuat jadwal untuk kelas ' . $kelas->kd_kelas]);
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

}
