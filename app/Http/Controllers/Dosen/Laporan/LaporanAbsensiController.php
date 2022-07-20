<?php

namespace App\Http\Controllers\Dosen\Laporan;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LaporanAbsensiController extends Controller
{
    public function __invoke(Request $request)
    {
        $kelas = Auth::user()->kelas;
        $mahasiswa = Mahasiswa::with(['absens', 'absens.jadwal'])->whereIn('kelas_id', $kelas->pluck('id'))->orderBy('kelas_id', 'asc')->get();
        return view('frontend.dosen.laporan.absensi', compact('kelas', 'mahasiswa'));
    }
}
