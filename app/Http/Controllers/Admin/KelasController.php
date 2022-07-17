<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kelas;
use App\Traits\Search;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\KelasRequest;

class KelasController extends Controller
{
    use Search;

    public function index()
    {
        if(request('q')) {
            return $this->search(Kelas::class, 'backend.kelas.index', 'kelas', 'kd_kelas');
        }

        $kelas = Kelas::get();
        
        if (request()->expectsJson()) {
            return $kelas;
        }

        return view('backend.kelas.index', compact('kelas'));
    }

    public function create()
    {
        return view('backend.kelas.create');
    }

    public function store(KelasRequest $request)
    {
        Kelas::create(['kd_kelas' => $request->kelas]);
        return redirect(route('kelas.index'))->with('success', "Berhasil membuat kelas : ". request('kelas'));
    }

    public function edit(Kelas $kela)
    {
        return view('backend.kelas.edit', [
            'kela' => $kela
        ]);
    }

    public function update(KelasRequest $request, Kelas $kela)
    {
        $kela->update(['kd_kelas' => $request->kelas]);
        return redirect(route('kelas.index'))->with('success', "Berhasil update data kelas : ". request('kelas'));
    }

    public function destroy(Kelas $kela)
    {
        $kela->delete();
        return back()->with('success', "Berhasil menghapus data kelas : {$kela->kd_kelas}");
    }
}
