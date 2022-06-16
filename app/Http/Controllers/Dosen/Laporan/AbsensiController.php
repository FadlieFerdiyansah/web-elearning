<?php

namespace App\Http\Controllers\Dosen\Laporan;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    public function __invoke(Request $request)
    {
        info(request('matkul'));
        $kelas = Auth::user()->kelas;
        $mahasiswa = Mahasiswa::with(['absens', 'absens.jadwal' => function($query) use ($kelas) {
            $query->whereIn('matkul_id', $kelas->pluck('pivot.matkul_id'));
        }])->whereIn('kelas_id', $kelas->pluck('id'))->orderBy('kelas_id', 'asc')->get();
        // return $kelas->pluck('pivot.matkul_id');
        return $mahasiswa;

        // $mahasiswa = Mahasiswa::with(['absens' => function($query) {
        //     $query->with(['jadwal' => function($query) {
        //         $query->with('matkul_id', );
        //     }]);
        // }])->whereIn('kelas_id', $kelas->pluck('id'))->orderBy('kelas_id', 'asc')->get();
        // return $mahasiswa;
        return view('frontend.dosen.laporan.absensi', compact('kelas', 'mahasiswa'));
    }
}
