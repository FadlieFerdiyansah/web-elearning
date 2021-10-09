<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Matkul;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\MateriRequest;
use Illuminate\Support\Facades\Auth;

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

    public function create()
    {
        //get name of current user
        $dosen = Auth::user();
        //prepare an array variable for accommodate the array value from kelas
        $kelas = [];
        //loop the kelas and then push to variable $kelas
        foreach ($dosen->kelas as $k) {
            array_push($kelas, $k);
        }

        //prepare an array variable for accommodate the array value from kelas
        $matkuls = [];
        //loop the matkuls and then push to variable $matkuls
        foreach ($dosen->matkuls as $matkul) {
            array_push($matkuls, $matkul);
        }


        return view('frontend.dosen.materi.create', [
            'matkuls' => $matkuls,
            'kelas' => $kelas
        ]);
    }

    public function store(MateriRequest $request)
    {
        // Membuat sekaligus materi untuk kelas yang berbeda dikarenakan jadwal,materi,petermuan nya sama

        if (request('kelas') > 1) {
            for ($i = 0; $i < count(request('kelas')); $i++) {
                $materi = $request->all();
                $materi['kelas_id'] = $request->kelas[$i];
                $materi['matkul_id'] = $request->matkul;

                if ($request->tipe == 'pdf') {
                    $fileName = time() . '.' . $request->file('file_or_link')->extension();
                    $materi['file_or_link'] = $request->file('file_or_link')->storeAs("materials", $fileName);
                }
                Auth::user()->materis()->create($materi);
            }
        }
        return back()->with('success', 'Berhasil membuat materi');
    }


}
