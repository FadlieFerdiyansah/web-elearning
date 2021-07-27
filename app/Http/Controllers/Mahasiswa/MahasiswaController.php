<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class MahasiswaController extends Controller
{
    public function table(Request $request)
    {
        if($request->wantsJson()){
            return DataTables::of(Mahasiswa::query()->latest()->with('fakultas','kelas'))
            ->addColumn('action', function ($mahasiswa) {
                $button = '
                        <div class="dropdown d-inline">
                            <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item has-icon" href="'.route("mahasiswa.edit",$mahasiswa).'"><i class="
                                fas fa-edit"></i> Edit</a>
                                <form action="'.route("mahasiswa.delete",$mahasiswa).'" method="post" style="font-size:13px">
                                    '.csrf_field().'
                                    '.method_field('delete').'
                                    <button type="submit" class="dropdown-item has-icon font-sm"><i class="fas fa-times"></i> Delete</button>
                                </form>
                                <a class="dropdown-item has-icon" href="'.route("mahasiswa.delete",$mahasiswa).'"><i class="
                                fas fa-list-alt"></i> Detail</a>
                            </div>
                        </div>
                ';
                return $button;
            })
            ->make(true);
        }else{
            $mahasiswas = Mahasiswa::count();
        }

        return view('managementUser.mahasiswa.table',compact('mahasiswas'));
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        return view('form-control.mahasiswa.edit', [
            'mahasiswa' => $mahasiswa,
            'fakultas' => Fakultas::get(),
            'kelas' => Kelas::get()
        ]);
    }

    public function update(Mahasiswa $mahasiswa)
    {
        if(request('foto')){
            $img = request()->file('foto')->store('images/profile');
            Storage::delete($mahasiswa->foto);
        }else{
            $img = $mahasiswa->foto;
        }

        $mahasiswa->update([
            'foto' => $img,
            'nama' => request('nama'),
            'email' => request('email'),
            'fakultas_id' => request('fakultas'),
            'kelas_id' => request('kelas'),
        ]);
        return redirect()->route('mahasiswa.table')->with('success','Berhasil meng-update data');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        Storage::delete($mahasiswa->foto);
        return back();
    }

    public function delete_checkbox()
    {
        $nims = request('nim');
        // dd($nims);
        foreach($nims as $i => $nim){
            $mhs[] = Mahasiswa::where('nim',$nim)->get();
            foreach($mhs[$i] as $m){
                $m->delete();
                if($m->foto != 'default.png'){
                    Storage::delete($m->foto); 
                }
            }
        }

        // foreach($mhs as $m){
            //  dd($m);
            // $m[0]->delete();
            // if($m[0]->foto != 'default.png'){
            //     Storage::delete($m[0]->foto); 
            // }
        // }
        
    }
}
