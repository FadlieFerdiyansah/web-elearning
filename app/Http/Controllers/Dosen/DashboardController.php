<?php

namespace App\Http\Controllers\Dosen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dosen\UpdateProfile;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('frontend.dosen.dashboard');
    }

    public function updateProfile(UpdateProfile $request)
    {
        $dosen = auth()->user();

        if (Hash::check($request->password, $dosen->password)) {
            return redirect()->back()->with('error', 'Password baru tidak boleh sama dengan password saat ini');
        }
        if($dosen->email == 'dosen@gmail.com'){
            return back()->with('error', 'Tidak bisa merubah password pada akun demo');
        }
        $dosen->password = bcrypt($request->password);
        $dosen->save();

        return redirect()->back()->with('success', 'Berhasil mengubah data profile');
    }
}
