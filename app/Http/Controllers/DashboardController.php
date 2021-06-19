<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

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
        // dd($request->path() == 'dashboard');
        // $user = Auth::user();
        // $cekRole = $user->hasRole('dosen');
        // $role = Role::findByName('dosen');
        // $give = $role->givePermissionTo('management nilai');
        // dd($give);
        // $cekRole = $role->hasPermissionTo('management nilai');
        // dd($cekRole);
        // $role = $user->getRoleNames();
        // dd($role);
        // $per = $role->has
        return view('dashboard.index');
    }
}
