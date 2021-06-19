<?php

namespace App\Http\Controllers\Jadwal;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class JadwalController extends Controller
{
    public function jadwalKuliah()
    {
       
        return view('jadwal.jadwal-kuliah');
    }

    public function jadwalPengganti()
    {
        return view('jadwal.jadwal-pengganti');
    }
}
