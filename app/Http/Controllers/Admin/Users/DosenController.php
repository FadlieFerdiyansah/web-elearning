<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\{Dosen, Kelas, Matkul};
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\DosenRequest;

class DosenController extends Controller
{
    public function index()
    {

        if (request()->wantsJson()) {
            $dosen = Dosen::latest()->with(['matkuls', 'kelas'])->get();
            return DataTables::of($dosen)
                ->addColumn('matkuls', function ($dosen) {
                    return implode(', ', $dosen->matkuls->pluck('kd_matkul')->toArray());
                })
                ->addColumn('kelas', function ($dosen) {
                    return implode(' ~ ', $dosen->kelas->pluck('kd_kelas')->toArray());
                })
                ->addColumn('action', function ($dosen) {
                    $button = '
                        <div class="dropdown d-inline">
                            <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item has-icon" href="' . route("dosens.edit", $dosen) . '"><i class="
                                fas fa-edit"></i> Edit</a>
                                <form action="' . route("dosens.destroy", $dosen) . '" method="post" style="font-size:13px">
                                    ' . csrf_field() . '
                                    ' . method_field('delete') . '
                                    <button type="submit" class="dropdown-item has-icon font-sm"><i class="fas fa-trash"></i> Delete</button>
                                </form>
                            </div>
                        </div>
                ';
                    return $button;
                })
                ->make(true);
        } else {
            $dosens = Dosen::count();
        }

        return view('backend.manajemen_user.dosen.index', compact('dosens'));
    }

    public function create()
    {
        return view('backend.manajemen_user.dosen.create', [
            'matkuls' => Matkul::get(),
            'kelas' => Kelas::get()
        ]);
    }

    public function store(DosenRequest $request)
    {
        // return request()->all();
        if (request('foto')) {
            $photo = $request->file('foto')->store('images/profile');
        } else {
            $photo = 'default.png';
        }

        $dosen = Dosen::create([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'foto' => $photo,
        ]);

        $dosen->assignRole('dosen');
        $dosen->kelas()->sync($request->kelas);
        $dosen->matkuls()->sync($request->matkul);
        return redirect(route('dosens.index'))->with('success', 'Berhasil membuat data dosen');
    }

    public function edit(Dosen $dosen)
    {

        return view('backend.manajemen_user.dosen.edit', [
            'dosen' => $dosen,
            'matkuls' => Matkul::get(),
            'kelas' => Kelas::get()
        ]);
    }

    public function update(DosenRequest $request, Dosen $dosen)
    {

        if ($request->foto) {
            Storage::delete($dosen->foto);
            $photo = $request->file('foto')->store('images/profile');
        } else {
            $photo = $dosen->foto;
        }

        $dosen->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'foto' => $photo,
        ]);

        $dosen->kelas()->sync($request->kelas);
        $dosen->matkuls()->sync($request->matkul);
        return redirect(route('dosens.index'))->with('success', 'Berhasil update data dosen');
    }

    //Delete 1 per 1 data
    public function destroy(Dosen $dosen)
    {
        $dosen->delete();
        Storage::delete($dosen->foto);
        $dosen->kelas()->detach();
        $dosen->matkuls()->detach();
        return back();
    }

    //Delete bisa sekaligus banyak data
    public function delete_checkbox()
    {
        $nips = request('nip');
        // dd($nims);
        foreach ($nips as $i => $nip) {
            $dosens[] = Dosen::where('nip', $nip)->get();
            foreach ($dosens[$i] as $dosen) {
                $dosen->delete();
                $dosen->kelas()->detach();
                $dosen->matkuls()->detach();
                if ($dosen->foto != 'default.png') {
                    Storage::delete($dosen->foto);
                }
            }
        }
    }
}
