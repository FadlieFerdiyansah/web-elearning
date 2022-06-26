<?php

namespace App\Http\Controllers\Dosen\Exports;

use Illuminate\Support\Str;
use App\Exports\Report\Nilai;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\{Kelas, Matkul, Mahasiswa};

class ExportNilaiController extends Controller
{
    public function __invoke(Kelas $kelas, Matkul $matkul)
    {
        $mahasiswa = Mahasiswa::with(['tugas' => function($query) {
            $query->whereIn('parent', Auth::user()->tugas->pluck('id'))->select('id','matkul_id','mahasiswa_id','pertemuan');
        }, 'tugas.matkul:id,nm_matkul', 'tugas.nilai:tugas_id,nilai', 'kelas'])->where('kelas_id', $kelas->id)->get(['id', 'kelas_id', 'nim', 'nama']);
        $lastPertemuan = Auth::user()->tugas->where('matkul_id', $matkul->id)->max('pertemuan');
        foreach($mahasiswa as $i => $mhs){
            $formatMhs[$i] = [
                'kelas' => $mhs->kelas->kd_kelas,
                'nim' => $mhs->nim,
                'nama' => $mhs->nama,
                'matkul' => Str::lower($matkul->nm_matkul),
            ];

            for($j = 1; $j <= $lastPertemuan; $j++){
                $formatMhs[$i]["p$j"] = '-';
                if($mhs->tugas->where('pertemuan', $j)->count() > 0){
                    $formatMhs[$i]["p$j"] = $mhs->tugas->where('pertemuan', $j)->first()->nilai->nilai ?? '-';
                }
            }
        }

        return Excel::download(new Nilai(collect($formatMhs)), 'nilai.xlsx');
    }
}