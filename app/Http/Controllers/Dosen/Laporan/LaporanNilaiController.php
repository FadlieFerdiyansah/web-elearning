<?php

namespace App\Http\Controllers\Dosen\Laporan;

use App\Models\Mahasiswa;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class LaporanNilaiController extends Controller
{
    public function __invoke()
    {
        $kelas = Auth::user()->kelas;
        $mahasiswa = Mahasiswa::with(['tugas', 'tugas.jadwal'])->whereIn('kelas_id', $kelas->pluck('id'))->orderBy('kelas_id', 'asc')->get();
        // return $mahasiswa[0]->tugas[0]->jadwal->matkul_id;
        // return $mahasiswa[0]->tugas[0]->;
        return view('frontend.dosen.laporan.nilai', compact('kelas', 'mahasiswa'));
    }
}
