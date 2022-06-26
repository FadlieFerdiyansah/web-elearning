<?php

namespace App\Http\Controllers\Dosen;

use App\Models\Tugas;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Dosen\NilaiRequest;

class NilaiController extends Controller
{
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
