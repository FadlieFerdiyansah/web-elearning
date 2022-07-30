<?php

namespace App\Http\Controllers\Admin;

use ZipArchive;
use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Jadwal;
use App\Models\Matkul;
use App\Models\Fakultas;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        // $role = Role::find(2);
        // $role->givePermissionTo(['jadwal kuliahm']);
        // dd(new ZipArchive);
        // $user =  Auth::user()->roles;
        // return $role->givePermissionTo(['']);
        // return $role->hasPermissionTo('management absensi');

        // return $user;

        // return $user->hasPermissionTo('jadwal mengajar');
        $dosens = Dosen::count();
        $mahasiswas = Mahasiswa::count();
        $kelas = Kelas::count();
        $matkuls = Matkul::count();
        $fakultas = Fakultas::count();
        $jadwals = Jadwal::count();
        return view('backend.dashboard', compact('dosens', 'mahasiswas', 'matkuls', 'kelas', 'fakultas', 'jadwals'));
    }
}
