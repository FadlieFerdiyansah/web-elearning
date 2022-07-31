<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\JadwalRequest;
use App\Models\{Jadwal, Kelas, Dosen};
use App\Http\Resources\JadwalResource;

class JadwalController extends Controller
{
    public function index()
    {
        if (request()->expectsJson()) {
            if (request('filter')) {
                $kelas = Kelas::where('kd_kelas', 'like', '%'.request('filter') .'%')->first();
                return JadwalResource::collection($kelas->jadwals);
            }
            return JadwalResource::collection(Jadwal::paginate(10));
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
        $dosen = Dosen::where('id', $request->dosen_id)->first();
        $dosen->kelas()->updateExistingPivot(['kelas_id' => $request->kelas_id], ['matkul_id' => $request->matkul_id]);
        $kelas = Kelas::find($request->kelas_id);
        return response()->json(['message' => 'Berhasil membuat jadwal untuk kelas ' . $kelas->kd_kelas]);
    }

    public function edit(Jadwal $jadwal)
    {
        return view('backend.jadwal.edit', compact('jadwal'));
    }

    public function update(Jadwal $jadwal)
    {
        // return request()->all();
        // update jadwal
        $jadwal->update(request()->all());
        // update dosen
        $dosen = Dosen::where('id', request()->dosen_id)->first();
        $dosen->kelas()->updateExistingPivot(['kelas_id' => $jadwal->kelas_id], ['matkul_id' => $jadwal->matkul_id]);
        // update kelas
        $kelas = Kelas::find($jadwal->kelas_id);
        return response()->json(['message' => 'Berhasil memperbarui jadwal untuk kelas ' . $kelas->kd_kelas]);
    }

    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();
        return response()->json(['message' => 'Berhasil menghapus jadwal']);
    }

    //Mendapatkan data dosen berdasarkan kelas
    public function getDosenByKelasId(Kelas $kelas)
    {
        return $kelas->dosens()->orderBy('nama')->get();
    }

    //Mendapatkan data matkul berdasarkan dosen
    public function getMatkulByDosenId(Dosen $dosen)
    {
        return $dosen->matkuls()->orderBy('nm_matkul')->get();
    }
}
