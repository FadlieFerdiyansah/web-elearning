<?php

namespace App\Http\Controllers\Dosen\Exports;

use App\Models\Kelas;
use App\Models\Tugas;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Exports\Report\Nilai;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ExportNilaiController extends Controller
{
    public function __invoke(Kelas $kelas)
    {
        $mahasiswa = Mahasiswa::with(['tugas' => function($query) {
            $query->whereIn('parent', Auth::user()->tugas->pluck('id'))->select('id','matkul_id','mahasiswa_id','pertemuan');
        }, 'tugas.matkul:id,nm_matkul', 'tugas.nilai:tugas_id,nilai', 'kelas'])->where('kelas_id', $kelas->id)->get(['id', 'kelas_id', 'nim', 'nama']);
        
        foreach($mahasiswa as $i => $mhs){
            $formatMhs[$i] = [
                'kelas' => $mhs->kelas->nm_kelas,
                'nim' => $mhs->nim,
                'nama' => $mhs->nama,
                'matkul' => $mhs->tugas[$i]->matkul->nm_matkul ?? '-',
            ];

             foreach ($mhs->tugas as $k => $value) {
                $formatMhs[$i]["P$k"] = $value->nilai->nilai ?? '-';
             }
        }

        // return $formatMhs;
        return Excel::download(new Nilai(collect($formatMhs)), 'nilai.xlsx');
    }
}