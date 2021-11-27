<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Tugas;
use Illuminate\Http\Request;

class TugasController extends Controller
{
    public function index($jadwalId)
    {
        $jadwal = Jadwal::whereId(decrypt($jadwalId))->first();

        return view('frontend.dosen.tugas.index', compact('jadwal'));
    }

    public function create($jadwalId)
    {
        $jadwal = Jadwal::whereId(decrypt($jadwalId))->first();

        return view('frontend.dosen.tugas.create', compact('jadwal'));
    }

    public function store()
    {
        Tugas::create([
            'parent' => request('parent'),
            'judul' => request('judul'),
            'file' => request('file'),
            'link' => request('link'),
            'pertemuan' => request('pertemuan'),
            'deskripsi' => request('deskripsi'),
            'pengumpulan' => request('pengumpulan'),
        ]);
    }
}
