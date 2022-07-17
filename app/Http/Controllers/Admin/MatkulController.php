<?php

namespace App\Http\Controllers\Admin;


use App\Models\Matkul;
use App\Traits\Search;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MatkulRequest;

class MatkulController extends Controller
{
    use Search;

    public function index()
    {
        
        if(request('q')) {
            return $this->search(Matkul::class, 'backend.matkul.index', 'matkuls', 'nm_matkul');
        }

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
        $singkatan = '';

        foreach(explode(' ', $request->nm_matkul)as $kata)
        {
            $singkatan .= substr($kata, 0, 1);
        }

        $attr = $request->all();
        $attr['kd_matkul'] = strtoupper($singkatan);

        $matkul = Matkul::create($attr);

        return redirect(route('matkuls.index'))->with('success', "Berhasil membuat matakuliah : $matkul->nm_matkul");
    }

    public function edit(Matkul $matkul)
    {
        return view('backend.matkul.edit',compact('matkul'));
    }

    public function update(MatkulRequest $request, Matkul $matkul)
    {
        $singkatan = '';

        foreach(explode(' ', $request->nm_matkul) as $kata)
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
