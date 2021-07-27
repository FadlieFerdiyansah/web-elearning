<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Materi;
use App\Models\Matkul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MateriController extends Controller
{
    public function materi(Materi $materi)
    {
        
        return view('materi.index',compact('materi'));
    }    

    public function upload()
    {
        //get name of current user
        $dosen = Auth::user();
        //prepare an array variable for accommodate the array value from kelas
        $kelas = [];
        //loop the kelas and then push to variable $kelas
        foreach ($dosen->kelas as $k) {
            array_push($kelas,$k);
        }

        //prepare an array variable for accommodate the array value from kelas
        $matkuls = [];
        //loop the matkuls and then push to variable $matkuls
        foreach ($dosen->matkuls as $matkul) {
            array_push($matkuls,$matkul);
        }


        return view('materi.upload',[
            'matkuls' => $matkuls,
            'kelas' => $kelas
        ]);
    }

    public function store()
    {
        if(request('kelas') > 1){
            for ($i=0; $i < count(request('kelas')); $i++) { 
                $kelas =  request('kelas')[$i] ;
                Auth::user()->materis()->create([
                    'kelas_id' => $kelas,
                    'matkul_id' => request('matkul'),
                    'judul' => request('judul'),
                    'pertemuan' => request('pertemuan'),
                    'tipe' => request('tipe'),
                    'file_or_link' => request('file_or_link'),
                    'deskripsi' => request('deskripsi'),
                ]);
            }
        }

        return back()->with('success','Berhasil membuat materi');
        
    }






}
