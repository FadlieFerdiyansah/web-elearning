<?php

namespace App\Http\Controllers\Elearning;


use App\Http\Controllers\Controller;
use App\Models\Matkul;
use Illuminate\Http\Request;

class MatkulController extends Controller
{
    public function table()
    {
        return view('datatable.matkuls.table',[
            'matkuls' => Matkul::latest()->paginate(10)
        ]);
    }

    public function search()
    {
        $query =  request('query');

        return view('datatable.matkuls.table', [
            'matkuls' => Matkul::where("nm_matkul", "like" , "%$query%")->latest()->paginate(10),
            'result' => Matkul::where('nm_matkul', 'like', "%".$query."%")->latest()->paginate()
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect(route('matkuls.table'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('form-control.matkuls.create',[
            'title' => 'Form Matkul'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'nm_matkul' => 'required',
            'sks' => 'required'
        ]);

        $nm_matkul = request('nm_matkul');

        $arr = explode(' ', $nm_matkul);
        $singkatan = '';

        foreach($arr as $kata)
        {
            $singkatan .= substr($kata, 0, 1);
        }

        Matkul::create([
            'kd_matkul' => strtoupper($singkatan),
            'nm_matkul' => $nm_matkul,
            'sks' => request('sks')
        ]);

        return back()->with('success', "Berhasil membuat matakuliah : {$nm_matkul}");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Matkul $matkul)
    {
        return view('form-control.matkuls.edit',compact('matkul'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Matkul $matkul)
    {
        request()->validate([
            'nm_matkul' => 'required',
            'sks' => 'required'
        ]);

        $nm_matkul = request('nm_matkul');

        $arr = explode(' ', $nm_matkul);
        $singkatan = '';

        foreach($arr as $kata)
        {
            $singkatan .= substr($kata, 0, 1);
        }

        $matkul->update([
            'kd_matkul' => strtoupper($singkatan),
            'nm_matkul' => $nm_matkul,
            'sks' => request('sks'),
        ]);

        return back()->with('success', 'Berhasil meng-update data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Matkul $matkul)
    {
        $matkul->delete();
        return back();
    }
}
