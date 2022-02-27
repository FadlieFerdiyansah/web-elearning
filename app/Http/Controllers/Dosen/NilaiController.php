<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Tugas;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function create(Tugas $tugas)
    {
        $tugasParent = Tugas::where('id', $tugas->parent)->first();
        return view('frontend.dosen.tugas.nilai.create', compact('tugas', 'tugasParent'));
    }
}
