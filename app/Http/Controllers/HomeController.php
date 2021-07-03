<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $name;

    public function __construct()
    {
        $this->name = 'fadlie';
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('index');
    }

    public function aha()
    {
        return view('atta',[
            'name' => $this->name
        ]);
    }
}
