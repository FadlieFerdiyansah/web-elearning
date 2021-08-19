<?php

namespace App\Http\Controllers\Elearning;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use Illuminate\Http\Request;

class FakultasController extends Controller
{
    public function table()
    {
        $fakultas = Fakultas::get();
        return view('datatable.fakultas.table', compact('fakultas'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect(route('fakultas.table'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('form-control.fakultas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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

        return back()->with('success','Berhasil menyimpan data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Fakultas $fakulta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  Fakultas $fakulta
     * @return \Illuminate\Http\Response
     */
    public function edit(Fakultas $fakulta)
    {
        return view('form-control.fakultas.edit',compact('fakulta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  Fakultas $fakulta
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  Fakultas $fakulta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fakultas $fakulta)
    {
        $fakulta->delete();
        return back()->with('success', 'Berhasil meng-Hapus data');
    }
}
