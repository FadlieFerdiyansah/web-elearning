<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $user = Auth::guard('dosen')->user();

        // return $user;

        // return $user->hasPermissionTo('jadwal mengajar');
        return view('frontend.dosen.dashboard');
    }
}
