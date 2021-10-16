<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MatkulRequest;
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

    public function store(MatkulRequest $request)
    {
        $nm_matkul = $request->nm_matkul;

        $arr = explode(' ', $nm_matkul);
        $singkatan = '';

        foreach($arr as $kata)
        {
            $singkatan .= substr($kata, 0, 1);
        }

        $attr = $request->all();
        $attr['kd_matkul'] = strtoupper($singkatan);

        Matkul::create($attr);

        return redirect(route('matkuls.index'))->with('success', "Berhasil membuat matakuliah : $nm_matkul");
    }

    public function edit(Matkul $matkul)
    {
        return view('backend.matkul.edit',compact('matkul'));
    }

    public function update(MatkulRequest $request, Matkul $matkul)
    {
        $nm_matkul = $request->nm_matkul;

        $arr = explode(' ', $nm_matkul);
        $singkatan = '';

        foreach($arr as $kata)
        {
            $singkatan .= substr($kata, 0, 1);
        }

        $attr = $request->all();
        $attr['kd_matkul'] = strtoupper($singkatan);
        
        $matkul->update($attr);

        return redirect(route('matkuls.index'))->with('success', "Berhasil update matkul : $matkul->nm_matkul");
    }

    public function destroy(Matkul $matkul)
    {
        $matkul->delete();

        return back()->with('success', "Berhasil delete matakuliah : $matkul->nm_matkul");
    }
}
