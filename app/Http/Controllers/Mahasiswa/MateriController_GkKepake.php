<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Matkul;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\MateriRequest;
use Illuminate\Support\Facades\Auth;

class MateriController extends Controller
{
    public function show(Matkul $matkul, Request $request)
    {
        if (Auth::guard('mahasiswa')->user()) {
            $materis =  $matkul->materis()->where('kelas_id', Auth::user()->kelas->id)->latest()->paginate(5);
        } else {
            $materis = $matkul->materis()->latest()->paginate(5);
        }
        return view('frontend.materi.show', compact('materis'));
    }
}
