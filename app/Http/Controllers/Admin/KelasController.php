<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{Auth, Crypt};
use App\Models\{Kelas, Jadwal, Absen, Materi};
use Illuminate\Support\Facades\RateLimiter;

class KelasController extends Controller
{

    public function index()
    {
        if (request()->expectsJson()) {
            return Kelas::get();
        }

        $kelas = Kelas::get();
        return view('backend.kelas.index', compact('kelas'));
    }

    public function create()
    {
        return view('backend.kelas.create');
    }

    public function store()
    {
        request()->validate(['kelas' => 'required']);
        Kelas::create(['kd_kelas' => request('kelas')]);
        return back()->with('success', "Berhasil membuat kelas : ". request('kelas'));
    }

    public function edit(Kelas $kela)
    {
        return view('backend.kelas.edit', [
            'kela' => $kela
        ]);
    }

    public function update(Kelas $kela)
    {
        request()->validate(['kelas' => 'required']);
        $kela->update(['kd_kelas' => request('kelas')]);
        return back()->with('success', "Berhasil update data kelas : ". request('kelas'));
    }

    public function destroy(kelas $kela)
    {
        $kela->delete();
        return back()->with('success', "Berhasil menghapus data kelas : {$kela->kd_kelas}");
    }
}
