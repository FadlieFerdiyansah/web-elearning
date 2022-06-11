<?php

namespace App\Http\Controllers\Dosen;

use App\Models\Nilai;
use App\Models\Tugas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Dosen\NilaiRequest;
use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Mahasiswa;

class NilaiController extends Controller
{
    public function index()
    {
        $nilai = Nilai::where('dosen_id', Auth::user()->id)->get();
        $kelas = Auth::user()->kelas;
        // return implode('', explode('.', $kelas[0]->kd_kelas));
        $mahasiswa = Mahasiswa::whereIn('kelas_id', $kelas->pluck('id'))->orderBy('kelas_id', 'asc')->get();
        // return Auth::user()->kelas;
        // return $mahasiswa;
        // return Mahasiswa::whereKelasId($kelas->wtih)
        return view('frontend.dosen.nilai.index', compact('kelas', 'mahasiswa'));
    }
    public function create(Tugas $tugas)
    {
        $tugasParent = Tugas::where('id', $tugas->parent)->first();
        return view('frontend.dosen.tugas.nilai.create', compact('tugas', 'tugasParent'));
    }

    public function store(NilaiRequest $request, Tugas $tugas)
    {   
        $tugasParent = Tugas::whereParent($tugas->parent)->firstOrFail();
        Auth::user()->nilais()->updateOrCreate([
            'tugas_id' => $tugas->id,
        ], [
            'nilai' => $request->nilai,
            'komentar_dosen' => $request->komentar_dosen,
        ]);

        session()->flash('success', 'Nilai tugas berhasil ditambahkan');
        return redirect()->route('tugas.show', $tugasParent->parent);
    }
}
