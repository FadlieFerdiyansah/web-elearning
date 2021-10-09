<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Matkul;
use Illuminate\Http\Request;

class MatkulController extends Controller
{

    public function search()
    {
        $query =  request('query');

        return view('backend.matkul.index', [
            'matkuls' => Matkul::where("nm_matkul", "like" , "%$query%")->latest()->paginate(10),
            'result' => Matkul::where('nm_matkul', 'like', "%".$query."%")->latest()->paginate()
        ]);
    }
    
    public function index()
    {
        return view('backend.matkul.index',[
            'matkuls' => Matkul::latest()->paginate(10)
        ]);
    }

    public function create()
    {
        return view('backend.matkul.create',[
            'title' => 'Form Matkul'
        ]);
    }

    public function store()
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

    public function edit(Matkul $matkul)
    {
        return view('backend.matkul.edit',compact('matkul'));
    }

    public function update(Matkul $matkul)
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

    public function destroy(Matkul $matkul)
    {
        $matkul->delete();
        return back();
    }
}
