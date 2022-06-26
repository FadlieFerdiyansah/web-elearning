<?php

namespace App\Http\Controllers\Dosen;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\{Jadwal, Materi};
use App\Http\Controllers\Controller;
use App\Http\Requests\MateriRequest;
use Illuminate\Support\Facades\{Auth, Storage};

class MateriController extends Controller
{

    public function create($id)
    {
        $jadwalId = decrypt($id);
        $jadwal = Jadwal::where('id', $jadwalId)
            ->where('dosen_id', Auth::Id())
            ->first();

        return view('frontend.dosen.materi.create', compact('jadwal'));
    }

    public function store(MateriRequest $request)
    {
        $materi = $request->all();
        
        if ($request->tipe == 'pdf') {
            $fileName = time() . '.' . $request->file('file_or_link')->extension();
            $materi['file_or_link'] = $request->file('file_or_link')->storeAs("materials", $fileName);
        }

        Auth::user()->materis()->create($materi);

        return redirect(route('kelas.materi', $materi['jadwal']))->with('success', 'Berhasil membuat materi');
    }

    public function edit($materiId)
    {
        $materi = Materi::findOrFail(decrypt($materiId));
        
        return view('frontend.dosen.materi.edit', compact('materi'));
    }

    public function update($materiId, MateriRequest $request)
    {
        $materi = Materi::findOrFail(decrypt($materiId));

        $attr = $request->all();
        if ($request->tipe == 'pdf' && $request->file_or_link) {
            Storage::delete($materi->file_or_link);
            $fileName = time() . '.' . $request->file('file_or_link')->extension();
            $file = $request->file('file_or_link')->storeAs("materials", $fileName);
        }else{
            $file = $materi->file_or_link;
        }

        if ($request->tipe == 'youtube') {
            Storage::delete($materi->file_or_link);
            $attr['file_or_link'] = $request->file_or_link;
        }else{
            $attr['file_or_link'] = $file;
        }
        
        $materi->update($attr);

        return back()->with('success', 'Berhasil mengedit materi');
    }

    public function destroy($materiId)
    {
        $materi = Materi::findOrFail($materiId);

        if ($materi->tipe == 'pdf') {
            Storage::delete($materi->file_or_link);
        }
        $materi->delete();

        return back()->with('success', 'Berhasil menghapus materi');
    }
}
