<?php

namespace App\Http\Controllers\Admin;

use App\Models\Fakultas;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FakultasRequest;

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

    public function store(FakultasRequest $request)
    {   
        
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

        return redirect(route('fakultas.index'))->with('success','Berhasil menyimpan data fakultas');
    }

    public function edit(Fakultas $fakulta)
    {
        return view('backend.fakultas.edit',compact('fakulta'));
    }

    public function update(FakultasRequest $request, Fakultas $fakulta)
    {

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

        return redirect(route('fakultas.index'))->with('success', 'Berhasil update data fakultas');
    }

    public function destroy(Fakultas $fakulta)
    {
        $fakulta->delete();
        return back()->with('success', 'Berhasil hapus data fakultas');
    }
}
