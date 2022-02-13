<?php

namespace App\Http\Controllers\Dosen;

use Carbon\Carbon;
use App\Models\{Jadwal, Absen};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{Auth, Crypt};

class AbsenController extends Controller
{
    public function index()
    {
        $absensi = Absen::with('jadwal')->where([
            ['dosen_id', Auth::Id()],
            ['parent', 0]
        ])->whereDate('created_at', Carbon::today())->latest()->get(['id','dosen_id','jadwal_id','pertemuan','berita_acara','rangkuman']);

        return view('frontend.dosen.absensi.index',compact('absensi'));
    }

    public function create($jadwal_id)
    {
        $jadwal = Jadwal::findOrFail(decrypt($jadwal_id));
        
        $kelasActive = Auth::guard('dosen')->user()->jadwals()->where('hari',hariIndo())->get();
        $absen = Absen::where('dosen_id', Auth::Id())
                ->where('jadwal_id', $jadwal->id)
                ->whereDate('created_at', now())
                ->first();
        return view('frontend.dosen.absensi.create',compact('kelasActive','jadwal', 'absen'));
    }
    
    public function store()
    {
        $jadwal_id = decrypt(request('jadwal'));
        
        request()->validate([
            'pertemuan' => 'required'
        ]);
        
        Auth::user()->absens()->create([
            'jadwal_id' => $jadwal_id,
            'pertemuan' => request('pertemuan'),
            'rangkuman' => request('rangkuman'),
            'berita_acara' => request('berita_acara')
        ]);
        
        session()->flash('success', 'Berhasil membuat absen hari ini');
        return redirect(route('kelas.masuk',request('jadwal')));
    }

    public function edit($id)
    {
        $absensi = Absen::find(decrypt($id));

        return view('frontend.dosen.absensi.edit', compact('absensi'));
    }

    public function update($id)
    {
        $absen = Absen::find(decrypt($id));
        
        $absen->update([
            'pertemuan' => request('pertemuan'),
            'rangkuman' => request('rangkuman'),
            'berita_acara' => request('berita_acara')
        ]);

        return redirect(route('absensi.index'));
    }

    public function destroy($id)
    {
        $absen = Absen::findOrFail(decrypt($id));
        $absen->delete();
        
        Absen::whereNotNull('mahasiswa_id')->where('parent', $absen->id)->delete();
        return redirect(route('absensi.index'));
    }
}
