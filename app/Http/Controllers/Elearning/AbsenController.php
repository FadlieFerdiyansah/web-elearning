<?php

namespace App\Http\Controllers\Elearning;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AbsenController extends Controller
{
    public function absen(Jadwal $jadwal)
    {
        Auth::user()->absens()->create([
            'jadwal_id' => $jadwal->id,
            'status' => true,
        ]);
        return back();
    }
}
