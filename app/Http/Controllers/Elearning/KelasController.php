<?php

namespace App\Http\Controllers\Elearning;

use App\Models\kelas;
use App\Models\Jadwal;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Absen;
use App\Models\Dosen;
use App\Models\Matkul;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class KelasController extends Controller
{
    public function masuk($id)
    {
        $jadwal_id = Crypt::decryptString($id);

        $kelas_mhs = Jadwal::where('id', $jadwal_id)->first();
        // $matkul = Matkul::find($kelas_mhs->matkul_id);
        // $materis = $matkul->materis()->where('kelas_id',Auth::user()->kelas->id)->get();
        // $kelas_mhs = Jadwal::where('id', $jadwal_id)
        // ->addSelect([
        //     'nama_dosen' => Dosen::select('nama')
        //     ->whereColumn('id', 'jadwals.dosen_id')
        //     ->limit(1),
        //     'kelas' => Kelas::select('kd_kelas')
        //     ->whereColumn('id', 'jadwals.kelas_id')
        //     ->limit(1),
        //     'sks' => Matkul::select('sks')
        //     ->whereColumn('id', 'jadwals.matkul_id')
        //     ->limit(1),
        //     'nm_matkul' => Matkul::select('nm_matkul')
        //     ->whereColumn('id', 'jadwals.matkul_id')
        //     ->limit(1),
        // ])
        // ->first();
        if(Auth::guard('admin') && Auth::guard('dosen')){
            $absens = Absen::where('jadwal_id', $jadwal_id)->latest()->paginate(5);
        }else{
            $absens = Auth::user()->absens()->where('jadwal_id', $jadwal_id)->paginate(5);
        }
        // return $kelas_mhs;
        // return $absens;
        return view('frontend.kelas.masuk', [
            'kelas_mhs' => $kelas_mhs,
            'absens' => $absens
        ]);
    }

    public function table()
    {
        if (request()->expectsJson()) {
            return Kelas::get();
        }
        $kelas = Kelas::get();
        return view('datatable.kelas.table', compact('kelas'));
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
        return view('form-control.kelas.create');
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
        return view('form-control.kelas.edit', [
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
