<?php

namespace App\Http\Controllers\Elearning;

use App\Models\kelas;
use App\Models\Jadwal;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Absen;
use App\Models\Admin;
use App\Models\Dosen;
use App\Models\Matkul;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class KelasController extends Controller
{
    public function waktuSekarang()
    {
        return Carbon::now('Asia/Jakarta')->format('H:i');
    }

    public function masuk($id)
    {
        $jadwal_id = Crypt::decryptString($id);

        $jadwal = Jadwal::whereId($jadwal_id)->first();
        $waktuAbsen = (bool) $this->waktuSekarang() >= $jadwal->jam_masuk && $this->waktuSekarang() <= $jadwal->jam_keluar;
        // $today = Carbon::now('Asia/Jakarta')->format('H:i');
        // return $today;
        // return Jadwal::whereBetween('jam_masuk',[$jadwal->jam_masuk,$jadwal->jam_keluar])->first();
        if(Auth::guard('admin')->user() || Auth::guard('dosen')->user()){
            $absens = Absen::whereJadwalId($jadwal_id)->latest()->paginate(5);
        }elseif(Auth::guard('mahasiswa')->user()){
            $absens = Auth::user()->absens()->whereJadwalId($jadwal_id)->paginate(5);
        }
        // return $kelas_mhs;
        // return $absens;
        return view('frontend.kelas.masuk', [
            'jadwal' => $jadwal,
            'absens' => $absens,
            'waktuAbsen' => $waktuAbsen
        ]);
    }

    public function table()
    {
        if (request()->expectsJson()) {
            return Kelas::get();
        }
        $kelas = Kelas::get();
        return view('backend.datatable.kelas.table', compact('kelas'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.form-control.kelas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['kelas' => 'required']);
        Kelas::create(['kd_kelas' => $request->kelas]);
        return back()->with('success', "Berhasil membuat kelas : {$request->kelas}");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show(kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelas $kela)
    {
        return view('backend.form-control.kelas.edit', [
            'kela' => $kela
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kelas $kela)
    {
        $request->validate(['kelas' => 'required']);
        $kela->update(['kd_kelas' => $request->kelas]);
        return back()->with('success', "Berhasil update data kelas : {$request->kelas}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy(kelas $kela)
    {
        $kela->delete();
        return back()->with('success', "Berhasil menghapus data kelas : {$kela->kd_kelas}");
    }
}
