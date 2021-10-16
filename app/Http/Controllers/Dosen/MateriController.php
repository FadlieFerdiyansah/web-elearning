<?php

namespace App\Http\Controllers\Dosen;

use App\Models\Jadwal;
use App\Models\Matkul;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\MateriRequest;
use App\Models\Materi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{

    public function index(Request $request)
    {
        // return Str::between('12:00','11:00','12:00');
        // $j = $request->merge(['fadlie','ganteng',1]);
        if ($request->wantsJson()) {
            return DataTables::of(Auth::user()->materis()->orderByDesc('pertemuan'))
                ->addColumn('action', function ($materi) {
                    $button = '
                        <div class="dropdown d-inline">
                            <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item has-icon" href="' . route("materis.edit", $materi) . '"><i class="
                                fas fa-edit"></i> Edit</a>
                                <form action="' . route("materis.destroy", $materi) . '" method="post" style="font-size:13px">
                                    ' . csrf_field() . '
                                    ' . method_field('delete') . '
                                    <button type="submit" class="dropdown-item has-icon font-sm"><i class="fas fa-times"></i> Delete</button>
                                </form>
                                <a class="dropdown-item has-icon" href="' . route("materis.destroy", $materi) . '"><i class="
                                fas fa-list-alt"></i> Detail</a>
                            </div>
                        </div>
                ';
                    return $button;
                })
                ->make(true);
        }

        return view('frontend.dosen.materi.index');
    }

    public function create($id)
    {
        $jadwalId = Crypt::decrypt($id);
        $jadwal = Jadwal::where('id', $jadwalId)
            ->where('dosen_id', Auth::Id())
            ->first();

        // return $jadwalId;


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

        return back()->with('success', 'Berhasil membuat materi');
    }

    public function edit($materiId)
    {

        $materi = Materi::findOrFail(decrypt($materiId));
        // return $materi;
        return view('frontend.dosen.materi.edit', compact('materi'));
    }

    public function update($materiId, MateriRequest $request)
    {
        $materi = Materi::findOrFail(decrypt($materiId));

        // return $materi->file_or_link =;
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

        return back()->with('success', 'Berhasil meng edit materi');
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
