<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use ZipArchive;

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
        // $role = Role::find(2);
        // $role->givePermissionTo(['jadwal kuliahm']);
        // dd(new ZipArchive);
        // $user =  Auth::user()->roles;
        // return $role->givePermissionTo(['']);
        // return $role->hasPermissionTo('management absensi');

        // return $user;

        // return $user->hasPermissionTo('jadwal mengajar');
        return view('frontend.mahasiswa.dashboard');
    }
}
