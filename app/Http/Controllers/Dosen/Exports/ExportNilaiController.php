<?php

namespace App\Http\Controllers\Dosen\Exports;

use App\Models\Kelas;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tugas;
use Illuminate\Support\Facades\Auth;

class ExportNilaiController extends Controller
{
    public function __invoke(Kelas $kelas)
    {
        // $mahasiswa = Mahasiswa::with(['tugas:id,jadwal_id,mahasiswa_id,pertemuan', 'tugas.jadwal:id,kelas_id,dosen_id,matkul_id', 'tugas.nilai:id,tugas_id,dosen_id'])
        //                 ->where('kelas_id', $kelas->id)
        //                 ->get(['id', 'kelas_id', 'nama', 'nim']);
        // return Auth::user()->kelas->find($kelas->id);\
        $mahasiswa = Mahasiswa::with(['tugas' => function($query) {
            $query->whereIn('parent', Auth::user()->tugas->pluck('id'));
        }])->where('kelas_id', $kelas->id)->get();
            // return Auth::user()->tugas->pluck('id');
        return $mahasiswa;
        return 'hello export nilai';
    }
}
