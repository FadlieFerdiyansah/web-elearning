<?php

namespace App\Http\Controllers\Dosen;

use App\Models\Tugas;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\Dosen\TugasRequest;
use Illuminate\Support\Facades\Storage;

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
        $attr['jadwal_id'] = $jadwalId;

        if ($request->tipe == 'file') {
            $file = $request->file('file_or_link')->store('bahan_ajar');
            $attr['file_or_link'] = $file;
        }else{
            $attr['file_or_link'] = request('file_or_link');
        }

        Auth::user()->tugas()->create($attr);

        return back()->with('success', "Berhasil membuat tugas untuk kelas {$jadwal->kelas->kd_kelas}");
    }

    public function edit(Tugas $tugas)
    {
        // $tugas->pengumpulan = date('d/m/Y H:s', strtotime($tugas->pengumpulan));
        // return $tugas;
        return view('frontend.dosen.tugas.edit', compact('tugas'));
    }

    public function update(Tugas $tugas, TugasRequest $request)
    {

        // return request()->all();
        $attr = $request->validated();

        if ($request->tipe == 'file') {
            Storage::delete($tugas->file_or_link);
            $file = $request->file('file_or_link')->store('bahan_ajar');
            $attr['file_or_link'] = $file;
        }else{
            $attr['file_or_link'] = request('file_or_link');
            Storage::delete($tugas->file_or_link);
        }

        $tugas->update($attr);

        return back()->with('success', 'Berhasil merubah tugas');
    }

    public function destroy(Tugas $tugas)
    {
        if($tugas->tipe == "file"){
            Storage::delete($tugas->file_or_link);
        }
        $tugas->delete();
        return back()->with('success', 'Berhasil menghapus tugas');
    }
}