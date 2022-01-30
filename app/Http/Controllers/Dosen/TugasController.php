<?php

namespace App\Http\Controllers\Dosen;

use App\Models\Tugas;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\Dosen\TugasRequest;

class TugasController extends Controller
{
    public function index($jadwalId)
    {
        $jadwal = Jadwal::whereId(decrypt($jadwalId))->first();
        $tugas = Tugas::where('jadwal_id', $jadwal->id)->latest()->paginate(10);
        $newtsPertemuan = $jadwal->absens()->where('parent', 0)->whereDate('created_at', now('Asia/Jakarta'))->latest()->select('pertemuan')->first();
        return view('frontend.dosen.tugas.index', compact('jadwal', 'tugas', 'newtsPertemuan'));
    }

    public function create($jadwalId)
    {
        $jadwal = Jadwal::whereId(decrypt($jadwalId))->first();

        $newtsPertemuan = $jadwal->absens()->where('parent', 0)->whereDate('created_at', now('Asia/Jakarta'))->latest()->select('pertemuan')->first();
        return view('frontend.dosen.tugas.create', compact('jadwal', 'newtsPertemuan'));
    }

    public function store(TugasRequest $request)
    {
        $jadwalId = Crypt::decrypt(request('jadwal'));
        $jadwal = Jadwal::with('kelas')->where('id', $jadwalId)->first();
        $attr = $request->validated();
        $attr['file_or_link'] = request('file_or_link');
        $attr['jadwal_id'] = $jadwalId;

        Auth::user()->tugas()->create($attr);

        return back()->with('success', "Berhasil membuat tugas untuk kelas {$jadwal->kelas->kd_kelas}");
    }
}
