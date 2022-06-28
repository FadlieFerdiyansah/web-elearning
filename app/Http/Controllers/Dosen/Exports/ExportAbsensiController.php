<?php

namespace App\Http\Controllers\Dosen\Exports;

use App\Exports\Report\Absensi;
use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\Matkul;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ExportAbsensiController extends Controller
{
    public function __invoke(Kelas $kelas, Matkul $matkul)
    {
        $mahasiswa = Mahasiswa::with(['absens' => function($query) {
            $query->whereIn('parent', Auth::user()->absens->pluck('id'))->select('id','mahasiswa_id','pertemuan', 'status');
        }, 'kelas'])->where('kelas_id', $kelas->id)->get(['id', 'kelas_id', 'nim', 'nama']);

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
                if($mhs->absens->where('pertemuan', $j)->count() > 0){
                    $formatMhs[$i]["p$j"] = $mhs->absens->where('pertemuan', $j)->first()->status ? '✓' : '-';
                }
            }
        }

        // return $mahasiswa;
        return Excel::download(new Absensi(collect($formatMhs)), "Laporan_Absensi_Kelas_{$formatMhs[0]['kelas']}.xlsx");
    }
}
