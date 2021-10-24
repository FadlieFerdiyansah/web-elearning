<?php

namespace App\Http\Controllers\Admin\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Models\{Fakultas, Kelas, Mahasiswa};

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

        return view('backend.manajemen_user.mahasiswa.index',compact('mahasiswas'));
    }

    public function create()
    {
        $kelas = Kelas::get();
        $fakultas = Fakultas::get();
        return view('backend.manajemen_user.mahasiswa.create',compact('kelas','fakultas'));
    }

    public function store()
    {
        request()->validate([
            'nim' => 'required',
            'nama' => 'required',
            'email' => 'required',
            'fakultas' => 'required',
            'kelas' => 'required',
        ]);

        if(request('foto')) $img = request()->file('foto')->move('images/profile');
        
       $mahasiswa = Mahasiswa::create([
            'foto' => $img ?? 'default.png',
            'nim' => request('nim'),
            'nama' => request('nama'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
            'fakultas_id' => request('fakultas'),
            'kelas_id' => request('kelas'),
        ]);
        $mahasiswa->assignRole('mahasiswa');

        return back()->with('success','Berhasil membuat data mahasiswa');
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        return view('backend.manajemen_user.mahasiswa.edit', [
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
