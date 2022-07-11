<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dosen\UpdateProfile;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('frontend.mahasiswa.dashboard');
    }

    public function updateProfile(UpdateProfile $request)
    {
        $mahasiswa = auth()->user();

        if (Hash::check($request->password, $mahasiswa->password)) {
            return redirect()->back()->with('error', 'Password baru tidak boleh sama dengan password saat ini');
        }

        $mahasiswa->password = bcrypt($request->password);
        $mahasiswa->save();

        return redirect()->back()->with('success', 'Berhasil mengubah data profile');
    }
}
