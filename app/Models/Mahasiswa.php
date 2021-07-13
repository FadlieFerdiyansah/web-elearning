<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mahasiswa extends Authenticatable
{

    use HasFactory, HasRoles;

    public function getPictureAttribute()
    {
        return asset('/storage/'.$this->foto);
    }

    public function getPictureDefaultAttribute()
    {
        return asset('/assets/images/default.png');
    }

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->translatedFormat('l, d F Y');
    }

    public function table()
    {
        $mahasiswas = Mahasiswa::get();
        return view('managementUser.mahasiswa.index',compact('mahasiswas'));
    }
}
