<?php

namespace App\Http\Controllers\Dosen;
use App\Models\Mahasiswa;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;


class LaporanNilaiController extends Controller
{
    public function __invoke(Request $request)
    {
        $kelas = Auth::user()->kelas;
        $mahasiswa = Mahasiswa::with('tugas')->whereIn('kelas_id', $kelas->pluck('id'))->orderBy('kelas_id', 'asc')->get();
        return view('frontend.dosen.laporan.nilai', compact('kelas', 'mahasiswa'));
    }
}
