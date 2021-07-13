<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MatkulController extends Controller
{
    public function create()
    {
        return view('form-control.matkuls.create',[
            'title' => 'Form Matkul'
        ]);
    }
}
