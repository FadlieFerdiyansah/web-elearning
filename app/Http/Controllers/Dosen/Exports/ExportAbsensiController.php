<?php

namespace App\Http\Controllers\Dosen\Exports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExportAbsensiController extends Controller
{
    public function __invoke()
    {
        return 'hello export absensi';
    }
}
