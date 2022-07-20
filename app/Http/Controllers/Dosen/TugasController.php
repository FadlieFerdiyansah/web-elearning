<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dosen\TugasRequest;
use App\Models\{Tugas, Jadwal, Mahasiswa};
use Illuminate\Support\Facades\{Auth, Storage};

class TugasController extends Controller
{
    public function index($jadwalId)
    {
        $jadwal = Jadwal::whereId(decrypt($jadwalId))->first();
        $tugas = Tugas::whereJadwalId($jadwal->id)->whereParent(0)->latest()->paginate(10);
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
        $jadwalId = decrypt(request('jadwal'));
        $jadwal = Jadwal::with('kelas')->where('id', $jadwalId)->first();
        $attr = $request->validated();
        $attr['jadwal_id'] = $jadwalId;
        $attr['matkul_id'] = $jadwal->matkul_id;
        
        if ($request->tipe == 'file') {
            $file = $request->file('file_or_link')->store('bahan_ajar');
            $attr['file_or_link'] = $file;
        } else {
            $attr['file_or_link'] = request('file_or_link');
        }

        Auth::user()->tugas()->create($attr);

        return back()->with('success', "Berhasil membuat tugas untuk kelas {$jadwal->kelas->kd_kelas}");
    }

    public function edit(Tugas $tugas)
    {
        return view('frontend.dosen.tugas.edit', compact('tugas'));
    }

    public function update(Tugas $tugas, TugasRequest $request)
    {
        $attr = $request->validated();

        if ($request->tipe == 'file') {
            Storage::delete($tugas->file_or_link);
            $file = $request->file('file_or_link')->store('bahan_ajar');
            $attr['file_or_link'] = $file;
        } else {
            $attr['file_or_link'] = request('file_or_link');
            Storage::delete($tugas->file_or_link);
        }

        $tugas->update($attr);

        return back()->with('success', 'Berhasil merubah tugas');
    }

    public function show(Tugas $tugas)
    {
        $tugasMahasiswa = Tugas::with('mahasiswa')->where('parent', '!=', 0)->whereParent($tugas->id)->latest()->paginate(10);
        $mahasiswa = Mahasiswa::where('kelas_id', $tugas->kelas->id)->get();
        return view('frontend.dosen.tugas.show', compact('tugas', 'tugasMahasiswa','mahasiswa'));
    }

    public function destroy(Tugas $tugas)
    {
        $tugasMahasiswa = Tugas::whereParent($tugas->id)->get();
        
        if ($tugas->tipe == "file") {
            Storage::delete($tugas->file_or_link);
        }

        foreach ($tugasMahasiswa as $tgsMhs) {
            $tgsMhs->delete();
            $tgsMhs->nilai()->delete();
        }

        $tugas->delete();
        return back()->with('success', 'Berhasil menghapus tugas');
    }
}
