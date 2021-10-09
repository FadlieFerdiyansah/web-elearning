<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use Illuminate\Http\Request;

class FakultasController extends Controller
{
    public function index()
    {
        $fakultas = Fakultas::get();
        return view('backend.fakultas.index', compact('fakultas'));
    }

    public function create()
    {
        return view('backend.fakultas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required'
        ]);
        
        $nm_fk = $request->nama;
        $arr = explode(' ', $nm_fk);
        $singkatan = '';

        foreach($arr as $kata)
        {
            $singkatan .= substr($kata, 0, 1);
        }

        Fakultas::create([
            'kd_fk' => strtoupper($singkatan),
            'nama' => $nm_fk
        ]);

        return back()->with('success','Berhasil menyimpan data');
    }

    public function edit(Fakultas $fakulta)
    {
        return view('backend.fakultas.edit',compact('fakulta'));
    }

    public function update(Request $request, Fakultas $fakulta)
    {
        $request->validate([
            'nama' => 'required|unique:fakultas'
        ]);
        $nm_fk = $request->nama;
        $arr = explode(' ', $nm_fk);
        $singkatan = '';

        foreach($arr as $kata)
        {
            $singkatan .= substr($kata, 0, 1);
        }

        $fakulta->update([
            'kd_fk' => strtoupper($singkatan),
            'nama' => $nm_fk
        ]);

        return back()->with('success', 'Berhasil meng-Update data');
    }

    public function destroy(Fakultas $fakulta)
    {
        $fakulta->delete();
        return back()->with('success', 'Berhasil meng-Hapus data');
    }
}
