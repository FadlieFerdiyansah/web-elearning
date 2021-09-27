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

    public function some()
    {
        return 'some';
    }

    public function table(Request $request)
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
                                <a class="dropdown-item has-icon" href="' . route("materi.edit", $materi) . '"><i class="
                                fas fa-edit"></i> Edit</a>
                                <form action="' . route("materi.delete", $materi) . '" method="post" style="font-size:13px">
                                    ' . csrf_field() . '
                                    ' . method_field('delete') . '
                                    <button type="submit" class="dropdown-item has-icon font-sm"><i class="fas fa-times"></i> Delete</button>
                                </form>
                                <a class="dropdown-item has-icon" href="' . route("materi.delete", $materi) . '"><i class="
                                fas fa-list-alt"></i> Detail</a>
                            </div>
                        </div>
                ';
                    return $button;
                })
                ->make(true);
        }

        return view('frontend.dosen.materi.table');
    }

    public function show(Matkul $matkul, Request $request)
    {
        // return $matkul->materis;
        // dd(DataTables::of($matkul->materis)->make(true));
        // if($request->wantsJson()){
        //     return DataTables::of($matkul->materis()->with('kelas','matkul'))
        //     ->make(true);
        // }
        // return Auth::guard('dosen')->user();

        if (Auth::guard('mahasiswa')->user()) {
            $materis =  $matkul->materis()->where('kelas_id', Auth::user()->kelas->id)->latest()->paginate(5);
        } else {
            $materis = $matkul->materis()->latest()->paginate(5);
        }
        return view('frontend.materi.show', compact('materis'));
    }

    public function upload()
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


        return view('frontend.dosen.materi.upload', [
            'matkuls' => $matkuls,
            'kelas' => $kelas
        ]);
    }

    public function store(MateriRequest $request)
    {
        // Membuat sekaligus materi untuk kelas yang berbeda dikarenakan jadwal,materi,petermuan nya sama
        // Bisa juga membuat hanya 1 jadwal,materi,petermuan
        
        if (request('kelas') > 1) {
            for ($i = 0; $i < count(request('kelas')); $i++) {
                $materi = $request->all();
                $materi['kelas_id'] = $request->kelas[$i];
                $materi['matkul_id'] = $request->matkul;

                if($request->tipe == 'pdf'){
                    $fileName = time() .'.'.$request->file('file_or_link')->extension();
                    $materi['file_or_link'] = $request->file('file_or_link')->storeAs("materials",$fileName);
                }
                Auth::user()->materis()->create($materi);
            }
        }
        return back()->with('success', 'Berhasil membuat materi');
    }
}
