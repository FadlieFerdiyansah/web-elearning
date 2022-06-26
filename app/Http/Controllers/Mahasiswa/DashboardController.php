<?php

namespace App\Http\Controllers\Mahasiswa;

use ZipArchive;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // $role = Role::find(3);
        // $role->givePermissionTo(['jadwal kuliahm']);
        // dd(new ZipArchive);
        // return Auth::user()->roles->name;
        // return $role->givePermissionTo(['']);
        // return $role->hasPermissionTo('management absensi');
        // return $role->hasPermissionTo('jadwal kuliah');

        // return $user;

        // return $user->hasPermissionTo('jadwal mengajar');
        return view('frontend.mahasiswa.dashboard');
    }
}
