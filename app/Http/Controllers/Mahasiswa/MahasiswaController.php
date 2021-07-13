<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use DataTables;
class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        // dd($mahasiswas);
        // $jsonData = $this->jsonData();
        
        if($request->wantsJson()){
            return DataTables::of(Mahasiswa::query()->with('fakultas','kelas'))
            ->addColumn('action', function ($mahasiswa) {
                return '<a href="mahasiswa/'.$mahasiswa->nim.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })
            ->make(true);
        }else{
            $mahasiswas = Mahasiswa::count();
        }
        return view('managementUser.mahasiswa.index',compact('mahasiswas'));
    }
}
